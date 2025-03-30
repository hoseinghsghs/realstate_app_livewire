<?php

namespace App\Livewire\Admin\Agreement;

use App\Models\Agreement;
use Livewire\Component;

class ShowAgreement extends Component
{
    public Agreement $agreement;

    public function mount(Agreement $agreement): void
    {
        $this->agreement = $agreement;
    }
    public function render()
    {
        $photos = $this->agreement->images;
        return view('livewire.admin.pages.agreement.show-agreement', compact(['photos']))->extends('livewire.admin.layout.MasterAdmin')->section('Content');
    }
}
