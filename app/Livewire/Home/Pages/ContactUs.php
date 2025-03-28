<?php

namespace App\Livewire\Home\Pages;

use Livewire\Component;

class ContactUs extends Component
{
    public function render()
    {
        return view('livewire.home.pages.contact-us')->extends('livewire.home.layout.HomeLayout');
    }
}
