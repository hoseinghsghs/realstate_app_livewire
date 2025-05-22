<?php

namespace App\Livewire\Admin\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

class Edit extends Component
{

    use WithFileUploads;

    public User $user;
    public $name, $phone, $email, $isactive = false, $image, $role_id, $roles = [];

    protected $rules = [
        'name'    => 'required|string|max:255',
        'role_id' => 'required|exists:roles,id',
        'phone'   => 'nullable|string|max:11',
        'email'   => 'required|email',
        'image'   => 'nullable|image|mimes:jpg,png|max:1024', // اندازه 1 مگابایت
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->fill($user->only(['name', 'email', 'phone', 'role_id', 'isactive']));
        $this->roles = Role::all();
    }

    public function update()
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
            $img = Image::make($this->image)->resize(800, 533);

            $img->save($pach . '/profile/' . $imagename);
            $image_url = "/profile/" . $imagename;
        }

        $this->user->update([
            'name'     => $this->name,
            'phone'    => $this->phone,
            'email'    => $this->email,
            'role_id'  => $this->role_id,
            'isactive' => $this->isactive,
            'image'    => $image_url,
        ]);
        flash()->success('تغییرات با موفقیت ذخیره شد');
        return $this->redirect(route('admin.edit-user', $this->user), navigate: true);
    }


    public function render()
    {
        return view('livewire.admin.pages.user.edit')->extends('livewire.admin.layout.MasterAdmin')->section('Content');
    }
}
