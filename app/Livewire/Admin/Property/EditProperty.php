<?php

namespace App\Livewire\Admin\Property;

use App\Models\Feature;
use App\Models\Property;
use Livewire\Component;
use App\Livewire\Forms\CreatPropertyForm;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditProperty extends Component
{
    use WithFileUploads;

    public CreatPropertyForm $form;
    public Property $property;

    public function mount(Property $property)
    {
        $this->form->currentStep = 1;
        $this->form->setProperty($property);
    }

    public function decStep()
    {
        $this->form->decreaseStep();
    }
    public function incStep()
    {
        $this->form->increaseStep();
    }
    public function add_image()
    {
        $this->form->add_images();
    }
    public function userSubscribed($isChecked, $features)
    {

        if ($isChecked) {
            $this->property->features()->attach($features);
        } else {
            $this->property->features()->detach($features);
        }
    }
    public function update()
    {
        $this->form->update();
        alert()->success('', 'ملک با موفقیت ,ویرایش شد');
        return $this->redirect('/admin/properties', navigate: true);
    }

    public function delete(PropertyImage $image)
    {
        if (Storage::exists('storage/otherpreview/' . $image->name)) {
            Storage::delete('storage/otherpreview/'  . $image->name);
        }
        $image->delete();
        alert()->success('', 'تصویر با موفقیت حذف گردید');
    }

    public function render()
    {
        $property = $this->property;
        $features = Feature::latest()->get();
        return view('livewire.admin.property.edit-property', compact('features', 'property'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
