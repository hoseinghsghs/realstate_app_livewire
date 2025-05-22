<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;


class Create extends Component
{

    use WithFileUploads;

    public $name, $phone, $email, $password, $password_confirmation, $isactive = true, $image;

    protected $rules = [
        'name'     => 'required|string|max:255',
        'phone'    => 'nullable|string|max:11',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'image'    => 'nullable|image|mimes:jpg,png|max:1024', // اندازه 1 مگابایت
    ];

    public function submit()
    {
        $this->validate();
        $slug = Str::slug($this->name);
        $image_url = null;

        if (isset($this->image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $this->image->extension();

            $filesystem = config('filesystems.default');
            $pach = config('filesystems.disks.' . $filesystem)['root'];
            if (!Storage::exists('profile')) {
                Storage::makeDirectory('profile');
            }

            $img = Image::make($this->image)->resize(512, 512);
            $img->save($pach . '/profile/' . $imagename);
            $image_url = "/profile/" . $imagename;
        }

        User::create([
            'name'     => $this->name,
            'phone'    => $this->phone,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'role_id'  => 2,
            'isactive' => $this->isactive,
            'image'    => $image_url,
        ]);

        $this->reset();
        flash()->success('مشاور جدید ایجاد شد');
        return $this->redirect(route('admin.list-user'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.pages.user.create')->extends('livewire.admin.layout.MasterAdmin')
            ->section('Content');
    }
}
