<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;




class Edit extends Component
{

    use WithFileUploads;

    public User $user;
    public $name, $phone, $email, $isactive = false, $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:11',
        'email' => 'required|email',
        'image' => 'nullable|image|mimes:jpg,png|max:1024', // اندازه 1 مگابایت
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->name = $user->name;
        // $this->image = $user->image;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->isactive = $user->isactive;
    }

    public function update()
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
            'role_id' => 2,
            'isactive' => $this->isactive,
            'image' => $imagename,
        ]);
        flash()->success('اطلاعات مشاور ویرایش شد');
        return $this->redirect(route('admin.edit-user', $this->user), navigate: true);
    }



    public function render()
    {
        $user = User::find($this->user);
        return view('livewire.admin.user.edit')->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
