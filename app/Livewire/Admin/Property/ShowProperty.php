<?php

namespace App\Livewire\Admin\Property;

use App\Models\Property;
use Livewire\Component;

class ShowProperty extends Component
{
    public Property $property;
    public function render()
    {
        $property = $this->property->get();
        return view('livewire.admin.property.show-property', compact('property'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
