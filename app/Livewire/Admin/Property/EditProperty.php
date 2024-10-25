<?php

namespace App\Livewire\Admin\Property;

use App\Models\Feature;
use App\Models\Property;
use Livewire\Component;
use App\Livewire\Forms\CreatPropertyForm;
use Livewire\WithFileUploads;

class EditProperty extends Component
{
    use WithFileUploads;

    public CreatPropertyForm $form;
    public Property $property;

    public function mount()
    {
        $this->form->currentStep = 1;
    }

    public function increaseStep()
    {
        $this->form->resetErrorBag();
        $this->form->validateData();
        $this->form->currentStep++;
        if ($this->form->currentStep > $this->form->totalSteps) {
            $this->form->currentStep = $this->form->totalSteps;
        }
        if ($this->form->currentStep == 2) {
            $this->form->color_step_1 = '#009b32';
        } elseif ($this->form->currentStep == 3) {
            $this->form->color_step_1 = '#009b32';
            $this->form->color_step_2 = '#009b32';
        } elseif ($this->form->currentStep == 4) {
            $this->form->color_step_1 = '#009b32';
            $this->form->color_step_2 = '#009b32';
            $this->form->color_step_3 = '#009b32';
        }
    }

    public function decreaseStep()
    {
        $this->form->resetErrorBag();
        $this->form->currentStep--;
        if ($this->form->currentStep < 1) {
            $this->form->currentStep = 1;
        }
        if ($this->form->currentStep == 2) {
            $this->form->color_step_1 = '#009b32';
        } elseif ($this->form->currentStep == 3) {
            $this->form->color_step_1 = '#009b32';
            $this->form->color_step_2 = '#009b32';
        } elseif ($this->form->currentStep == 4) {
            $this->form->color_step_1 = '#009b32';
            $this->form->color_step_2 = '#009b32';
            $this->form->color_step_3 = '#009b32';
        }
    }

    public function render()
    {
        $property = $this->property;
        $features = Feature::latest()->get();
        return view('livewire.admin.property.edit-property', compact('features', 'property'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
