<?php

namespace App\Livewire\Admin\Feature;

use App\Models\Feature;
use Livewire\Component;
use Livewire\WithPagination;

class FeatureComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name;
    public Feature $feature;
    public $is_edit = false;
    public $display;

    public function ref()
    {

        $this->is_edit = false;
        $this->reset("name");
        $this->reset("display");
        $this->resetValidation();
    }

    public function add_feature()
    {
        if ($this->is_edit) {

            $this->validate([
                'name' => 'required|unique:features,name,' . $this->feature->id,
            ]);

            $this->feature->update([
                'name' => $this->name,
                'slug' => $this->name,
            ]);

            $this->is_edit = false;
            $this->reset("name");
            $this->reset("display");
            flash()->success('تغییرات با موفقیت ذخیره شد.');
        } else {

            $this->validate([
                'name' => 'required|unique:features,name',
            ]);
            Feature::create([
                "name" => $this->name,
                'slug' => $this->name,
            ]);
            $this->reset("name");
            flash()->success('با موفقیت ذخیره شد.');
        }
    }

    public function edit_feature(Feature $feature)
    {

        $this->is_edit = true;
        $this->name = $feature->name;
        $this->feature = $feature;
        $this->display = "disabled";
    }

    public function del_feature(Feature $feature)
    {

        if ($feature->properties()->exists()) {
            flash()->error('به علت الحاق ملک امکان حذف آن وجود ندارد');
        } else {
            $feature->delete();
            flash()->success('با موفقیت ذخیره شد.');
        }
    }

    public function render()
    {
        $features = Feature::latest()->paginate(10);
        return view('livewire.admin.feature.feature-component', compact('features'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
