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

    public $name, $phone, $email, $password, $password_confirmation, $isactive = false, $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:11',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'image' => 'nullable|image|mimes:jpg,png|max:1024', // اندازه 1 مگابایت
    ];

    public function submit()
    {
        $this->validate();
        $slug  = Str::slug($this->name);
        if (isset($this->image)) {

            // گرفتن تاریخ
            $currentDate = Carbon::now()->toDateString();
            $filesystem = config('filesystems.default');
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $this->image->extension();

            $filesystem = config('filesystems.default');
            $pach = config('filesystems.disks.' . $filesystem)['root'];
            // نام عکس
            // آیا این پوشه وجود دارد
            if (!Storage::exists('profile')) {
                // این پوشه را بساز
                Storage::makeDirectory('profile');
            }
            // Image::make($this->image)->resize(2000, 1228)->save($pach . '/' . 'profile/' . $imagename);

            $img = Image::make($this->image)->resize(800, 533);
            $img->save($pach . '/profile/' . $imagename);
        } else {
            $imagename = 'default.png';
        }


        User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => 2,
            'isactive' => $this->isactive,
            'image' => $imagename,
        ]);

        session()->flash('message', 'کاربر با موفقیت ایجاد شد!');
        $this->reset();
        flash()->success('مشاور جدید ایجاد شد');
        return $this->redirect(route('admin.cearte-user'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.user.create')->extends('livewire.admin-layout.layout.MasterAdmin')->section('Content');
    }
}
