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
use RealRashid\SweetAlert\Facades\Alert;



class CreateProperty extends Component
{
    use WithFileUploads;

    public CreatPropertyForm $form;

    public function mount()
    {
        $this->form->currentStep = 1;
    }

    public function decStep()
    {
        $this->form->decreaseStep();
    }
    public function incStep()
    {
        $this->form->increaseStep();
    }



    public function save()
    {
        if (Gate::allows('is_admin')) {
            $this->form->store();
            alert()->success('', 'ملک با موفقیت ثبت شد');
            // $flasher->addSuccess();
            return $this->redirect('/admin/properties', navigate: true);

            return redirect()->route('admin.properties.index');
        } elseif (Gate::allows('is_agent')) {
            // $flasher->addSuccess('ملک با موفقیت ثبت شد');
            $this->form->store();
            return redirect()->route('agent.properties.index');
        } elseif (Gate::allows('is_user')) {
            $this->form->store();
            return redirect()->route('user.home')->with('msg', 'کاربر گرامی ملک شما با موفقیت ثبت گردید .');
        }
    }
    public function render()
    {
        $services = Service::latest()->get();
        $features = Feature::latest()->get();
        return view('livewire.admin.property.create-property', compact('services', 'features'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
