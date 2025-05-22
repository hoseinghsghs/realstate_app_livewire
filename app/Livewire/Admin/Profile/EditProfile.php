<?php

namespace App\Livewire\Admin\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class EditProfile extends Component
{

    use WithFileUploads;

    public $numberOfPaginatorsRendered = [];

    public User $user;
    public $name, $phone, $about, $email, $image;

    protected $rules = [
        'name'  => 'required|string|max:255',
        'phone' => 'nullable|string|max:11',
        'email' => 'required|email',
        'image' => 'nullable|image|mimes:jpg,png|max:1024',
        'about' => 'nullable|string|max:255',
    ];

    public function mount($user)
    {
        if (Gate::allows('is_agent')) {
            if (Auth::user()->id !== $user->id) {
                flash()->error('شما اجازه دسترسی به این صفحه را ندارید.');
                return $this->redirect('/admin/properties', navigate: true);
            }
        }
        $this->user = $user;
        $this->fill($user->only(['name', 'email', 'phone', 'about']));
    }


    public function updateProfile()
    {
        $this->validate();
        $slug = Str::slug($this->name);
        $image_url = $this->user->image;

        if ($this->image) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $this->image->extension();
            $filesystem = config('filesystems.default');

            $pach = config('filesystems.disks.' . $filesystem)['root'];
            if (!Storage::exists('profile')) {
                Storage::makeDirectory('profile');
            }
            if ($this->user->image && Storage::exists($this->user->image)) {
                Storage::delete($this->user->image);
            }
            $img = Image::make($this->image)->resize(512, 512);

            $img->save($pach . '/profile/' . $imagename);
            $image_url = "/profile/" . $imagename;
        }

        $this->user->update([
            'name'  => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'about' => $this->about,
            'image' => $image_url,
        ]);
        flash()->success('اطلاعات پروفایل ویرایش شد');
        if (Gate::allows('is_user')) {
            return $this->redirect(route('user.home'), navigate: true);
        } else {
            return $this->redirect(route('admin.edit-profile', $this->user), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.profile.edit-profile')->extends('livewire.admin.layout.MasterAdmin')
            ->section('Content');
    }
}
