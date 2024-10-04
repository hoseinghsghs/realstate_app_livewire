<?php

namespace App\Livewire\Forms;

use App\Models\Feature;
use Livewire\Form;

class CreatFeatureForm extends Form
{
    public $name;

    public function rules()
    {
        return
            [
                'name' => 'required|unique:features|max:255'

            ];
    }
    public function store()
    {
        // $this->validate();

        Feature::create($this->all());
        $tag = new Feature();
        // $tag->name = $request->name;
        // $tag->slug = $request->name;
        $tag->save();

        $flasher->addSuccess('امکانات جدید ثبت گردید');
        return redirect()->route('admin.features.index');
    }
}
