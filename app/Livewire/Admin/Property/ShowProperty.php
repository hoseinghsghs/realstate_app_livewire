<?php

namespace App\Livewire\Admin\Property;

use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class ShowProperty extends Component
{
    public Property $property;
    public function mount()
    {
        if (Gate::allows('is_agent')) {
            if (Auth::user()->id !== $this->property->user_id) {
                flash()->error('شما اجازه دسترسی به این صفحه را ندارید.');
                return $this->redirect('/admin/properties', navigate: true);
            }
        }
    }
    public function render()
    {
        $property = $this->property->get();
        return view('livewire.admin.pages.property.show-property', compact('property'))->extends('livewire.admin.layout.MasterAdmin')->section('Content');
    }
}
