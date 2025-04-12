<?php

namespace App\Livewire\Home\Pages\UserProfile;

use App\Models\Property;
use App\Models\User;
use App\Models\WishList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Image;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public User $user;
    public $about;
    public $name;
    public $email;
    public $phone;
    public $image;

    public function mount()
    {
        $user = Auth::user();
        $this->user = $user;
        $this->about = $user->about;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;

        // $this->image = $user->image;
    }

    public function update()
    {
        $this->validate([
            'about' => 'nullable',
            'name' => 'required|max:255',
            'email' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:1024'
        ]);
        $slug  = Str::slug($this->user->title);
        if (isset($this->image)) {
            $filesystem = config('filesystems.default');
            $pach = config('filesystems.disks.' . $filesystem)['root'];
            $extension = $this->image->extension();

            $currentDate = Carbon::now()->toDateString();

            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $extension;
            if (!Storage::exists('profile')) {
                Storage::makeDirectory('profile');
            }
            if (Storage::exists('profile/' . $this->user->image) && $this->user->image !== 'default.png') {
                Storage::delete('profile/' . $this->user->image);
            }
            Image::make($this->image)->resize(800, 800)->save($pach . '/' .  'profile/' . $imagename);
        } else {
            $imagename = $this->user->image;
        }

        $this->user->update([
            'name' => $this->name,
            'about' => $this->about,
            'phone' => $this->phone,
            'email' => $this->email,
            'image' => $imagename,
        ]);
        flash()->success('پروفایل با موفقیت بروزرسانی شد');

        // $flasher->addSuccess('پروفایل با موفقیت بروزرسانی شد');
        // if (Gate::allows('is_user')) {
        //     return redirect()->route('user.home');
        // }
        // if (Gate::allows('is_admin')) {
        //     return redirect()->route('admin.home');
        // } else if (Gate::allows('is_agent')) {
        //     return redirect()->route('agent.home');
        // }
    }

    public function render()
    {
        $user = Auth::user();
        $property = Property::latest()->where('isactive', 1)->get();
        $wishlist = WishList::where('user_id', auth()->id())->get();
        return view('livewire.home.pages.user-profile.index', compact('user', 'property', 'wishlist'))->extends('livewire.home.layout.HomeLayout')->section('content');
    }
}
