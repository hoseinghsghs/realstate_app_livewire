<?php

namespace App\Livewire\Home\Pages\UserProfile;

use App\Livewire\Forms\CreatPropertyForm;
use App\Models\WishList;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProperty extends Component
{
    use WithFileUploads;

    public CreatPropertyForm $form;
    public function save()
    {
        if (Gate::allows('is_user')) {
            $this->form->userStore();
            $this->form->reset();
            // return redirect()->route('user.home')->with('msg', 'کاربر گرامی ملک شما با موفقیت ثبت گردید .');
        }
    }
    public function render()
    {
        $wishlist = WishList::where('user_id', auth()->id())->get();
        return view('livewire.home.pages.user-profile.create-property', compact('wishlist'))->extends('home.layout.HomeLayout')->section('content');
    }
}
