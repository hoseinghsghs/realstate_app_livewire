<?php

namespace App\Livewire\Forms;

use App\Models\Feature;
use Livewire\Form;

class CreatFeatureForm extends Form
{
    public $name;
    public $slug;


    public function rules()
    {
        return
            [
                'name' => 'required|unique:features|max:3'

            ];
    }
    public function store()
    {
        $this->validate();
        Feature::create($this->all());
        $flasher->addSuccess('امکانات جدید ثبت گردید');
        return redirect()->route('admin.features.index');
    }
}
