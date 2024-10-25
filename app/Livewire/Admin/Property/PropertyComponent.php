<?php

namespace App\Livewire\Admin\Property;

use App\Models\Feature;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PropertyComponent extends Component
{
    public function render()
    {
        $properties = Property::whereHas('user', function ($query) {
            return $query->where('role_id', 2)->orWhere('role_id', 1);
        })->latest()->paginate(10)->withQueryString();
        $features = Feature::latest()->get();
        $propertyAgent = Property::where('user_id', Auth::user()->id)->latest()->paginate(10);
        return view('livewire.admin.property.property-component', compact('properties', 'features', 'propertyAgent'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
