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

    public User $user;
    public $name, $phone, $about, $email, $isactive = false, $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:11',
        'email' => 'required|email',
        'image' => 'nullable|image|mimes:jpg,png|max:1024', // اندازه 1 مگابایت
        'about' => 'nullable|string|max:120',


    ];

    public function mount($user)
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->about = $user->about;
        $this->isactive = $user->isactive;
    }

    public function updateProfile()
    {
        $this->validate();

        $image = $this->image;

        $slug  = Str::slug($this->name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->extension();
            $filesystem = config('filesystems.default');

            $pach = config('filesystems.disks.' . $filesystem)['root'];
            if (!Storage::exists('profile')) {
                Storage::makeDirectory('profile');
            }
            if (Storage::exists('profile/' . $this->image)) {
                Storage::delete('profile/' . $this->image);
            }
            $img = Image::make($image)->resize(800, 533);

            $img->save($pach  . '/profile/' . $imagename);
        } else {
            $imagename = $this->user->image;
        }

        if ($this->isactive) {
            $this->isactive = true;
        } else {
            $this->isactive = false;
        }

        $this->user->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'about' => $this->about,
            'image' => $imagename,
        ]);
        flash()->success('اطلاعات پروفایل ویرایش شد');
        if (Gate::allows('is_user')) {
            return $this->redirect(route('user.home'), navigate: true);
        }
        if (Gate::allows('is_admin')) {
            return $this->redirect(route('admin.home'), navigate: true);
        } else if (Gate::allows('is_agent')) {
            return $this->redirect(route('admin.agent.home'), navigate: true);
        }
        return $this->redirect(route('admin.edit-user', $this->user), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.profile.edit-profile')->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
