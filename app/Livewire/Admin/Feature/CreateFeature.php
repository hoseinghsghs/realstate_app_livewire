<?php

namespace App\Livewire\Admin\Feature;

use Livewire\Component;

use App\Livewire\Forms\CreatFeatureForm;

class CreateFeature extends Component
{
    public CreatFeatureForm $form;

    public function save()
    {
        $this->form->slug = $this->form->name;
        $this->form->store();
    }

    public function render()
    {
        return view('livewire.admin.feature.create-feature')->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
