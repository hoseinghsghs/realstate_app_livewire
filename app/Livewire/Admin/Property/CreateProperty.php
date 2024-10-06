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


    public function save()
    {

        dd($this->form->all());

        if (Gate::allows('is_admin')) {
            $flasher->addSuccess('ملک با موفقیت ثبت شد');
            return redirect()->route('admin.properties.index');
        } elseif (Gate::allows('is_agent')) {
            $flasher->addSuccess('ملک با موفقیت ثبت شد');
            return redirect()->route('agent.properties.index');
        } elseif (Gate::allows('is_user')) {
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
