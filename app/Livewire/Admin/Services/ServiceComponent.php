<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceComponent extends Component
{


    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title;
    public $description;
    public $icon;
    public $service_order;
    public Service $service;
    public $is_edit = false;
    public $display;

    public function ref()
    {
        $this->is_edit = false;
        $this->reset("title");
        $this->reset("display");
        $this->reset("description");
        $this->reset("icon");
        $this->reset("service_order");
        $this->resetValidation();
    }

    public function add_services()
    {
        if ($this->is_edit) {

            $this->validate([
                'title'         => 'required',
                'description'   => 'required|max:200',
                'icon'          => 'required',
                'service_order' => 'required',
            ]);

            $this->service->update([
                "title" => $this->title,
                "description" => $this->description,
                "icon" => $this->icon,
                "service_order" => $this->service_order,
            ]);

            $this->ref();
            flash()->success('تغییرات با موفقیت ذخیره شد');
        } else {

            $this->validate([
                'title'         => 'required',
                'description'   => 'required|max:200',
                'icon'          => 'required',
                'service_order' => 'required',

            ]);
            Service::create([
                "title" => $this->title,
                "description" => $this->description,
                "icon" => $this->icon,
                "service_order" => $this->service_order,
            ]);
            $this->ref();
            flash()->success('سرویس با موفقیت ذخیره شد');
        }
    }

    public function edit_service(Service $service)
    {
        $this->is_edit = true;
        $this->title = $service->title;
        $this->description = $service->description;
        $this->service_order = $service->service_order;
        $this->icon = $service->icon;
        $this->service = $service;
        $this->display = "disabled";
    }

    public function destroy(Service $service)
    {
        $service->delete();
        flash()->success('سرویس با موفقیت حذف شد');
        return back();
    }

    public function render()
    {
        $services = Service::latest()->paginate(10);

        return view('livewire.admin.services.service-component', compact('services'))->extends('livewire.admin-layout.layout.MasterAdmin')->section('Content');
    }
}
