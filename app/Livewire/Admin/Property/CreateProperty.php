<?php

namespace App\Livewire\Admin\Property;

use Livewire\Component;
use App\Http\Controllers\Admin\PropertyImageController;
use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Forms\CreatPropertyForm;
use Livewire\WithFileUploads;



class CreateProperty extends Component
{
    use WithFileUploads;

    public CreatPropertyForm $form;

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
        }
    }


    public function save()
    {

        dd($this->form->all());

        if (Gate::allows('is_admin')) {
            // $flasher->addSuccess('ملک با موفقیت ثبت شد');
            return redirect()->route('admin.properties.index');
        } elseif (Gate::allows('is_agent')) {
            // $flasher->addSuccess('ملک با موفقیت ثبت شد');
            return redirect()->route('agent.properties.index');
        } elseif (Gate::allows('is_user')) {
            // return redirect()->route('user.home')->with('msg', 'کاربر گرامی ملک شما با موفقیت ثبت گردید .');
        }
    }
    public function render()
    {
        $services = Service::latest()->get();
        $features = Feature::latest()->get();
        return view('livewire.admin.property.create-property', compact('services', 'features'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
