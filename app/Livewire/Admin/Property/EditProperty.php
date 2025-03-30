<?php

namespace App\Livewire\Admin\Property;

use App\Models\Feature;
use App\Models\Property;
use Livewire\Component;
use App\Livewire\Forms\CreatPropertyForm;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditProperty extends Component
{
    use WithFileUploads;

    public CreatPropertyForm $form;
    public Property $property;

    #[On('imageUpdated')]
    public function refreshImage()
    {
        $this->property = $this->property->fresh();
    }

    public function mount(Property $property)
    {
        if (Gate::allows('is_agent')) {
            if (Auth::user()->id !== $property->user_id) {
                flash()->error('شما اجازه دسترسی به این صفحه را ندارید.');
                return $this->redirect('/admin/properties', navigate: true);
            }
        }

        $this->form->currentStep = 1;
        $this->form->setProperty($property);
        $this->form->states = Get_States();
    }
    public function delete_temp_image($id): void
    {
        if (array_key_exists($id, $this->form->otherimg)) {
            unset($this->form->otherimg[$id]);
        }
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
        $this->property = $this->property->fresh();

        $this->form->floorsell = json_decode($this->property->floorsell, true);

        flash()->success('ملک با موفقیت ,ویرایش شد');
    }

    public function delete(PropertyImage $image)
    {
        if (Storage::exists('storage/otherpreview/' . $image->name)) {
            Storage::delete('storage/otherpreview/'  . $image->name);
        }
        $image->delete();
        flash()->success('تصویر با موفقیت حذف گردید');
    }

    public function render()
    {
        $property = $this->property;
        $features = Feature::latest()->get();
        return view('livewire.admin.pages.property.edit-property', compact('features', 'property'))->extends('livewire.admin.layout.MasterAdmin')->section('Content');
    }
}
