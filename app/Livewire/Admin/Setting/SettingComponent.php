<?php

namespace App\Livewire\Admin\Setting;

use App\Http\Controllers\Admin\PropertyImageController;
use App\Models\Setting as ModelsSetting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingComponent extends Component
{

    use WithFileUploads;

    public $title;
    public $email;
    public $emails;
    public $phone;
    public $phones;
    public $links;
    public $address;
    public $work_days;
    public $telegram;
    public $latitude;
    public $longitude;
    public $description;
    public $apiKey;
    public $workday;
    public $group_name;
    public $whatsapp;
    public $instagram;
    public $seo_description;
    public $logo;
    public $uploaded_logo;

    public $icon;

    protected $listeners = ['privacyChanged', 'rulesChanged', 'keywordsChanged'];
    protected $rules = [
        'title'                    => 'nullable|string|max:250|min:3',
        'emails'                   => 'nullable|array',
        'emails.*'                 => 'nullable|email',
        'phones'                   => 'nullable|array',
        'phones.*'                 => 'nullable|numeric',
        'links'                    => 'nullable|array',
        'links.*.name'             => 'required|string|distinct',
        'links.*.children.*.title' => 'required|string|distinct',
        'links.*.children.*.url'   => 'required|url',
        'whatsapp'                 => 'nullable|string|max:250',
        'instagram'                => 'nullable|string|max:250',
        'address'                  => 'nullable|string|max:250',
        'work_days'                => 'nullable|string|max:250',
        'apiKey'                   => 'nullable|string|max:250',
        'longitude'                => 'nullable|numeric|max:250',
        'latitude'                 => 'nullable|numeric|max:250',
        'telegram'                 => 'nullable|string|max:250',
        'description'              => 'nullable|string|max:250',
        'seo_description'          => 'nullable|string|max:250|min:3',
        'logo'                     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    protected $validationAttributes = [
        'group_name'               => 'عنوان دسته ',
        'links.*.name'             => 'عنوان دسته',
        'links.*.children.*.title' => 'عنوان لینک',
        'links.*.children.*.url'   => 'آدرس لینک',
        'seo_description'          => 'توضیحات سئو',
        'apiKey'                   => "کلید دسترسی"
    ];

    public function mount()
    {
        $this->links = [];
        $settings = ModelsSetting::findOrNew(1);
        $this->title = $settings->title;
        $this->emails = json_decode($settings->emails, true);
        $this->phones = json_decode($settings->phones, true);
        $this->links = json_decode($settings->links, true) ?? [];
        $this->whatsapp = $settings->whatsapp;
        $this->instagram = $settings->instagram;
        $this->telegram = $settings->telegram;
        $this->address = $settings->address;
        $this->description = $settings->description;
        $this->seo_description = $settings->seo_description;
        $this->work_days = $settings->work_days;
        $this->apiKey = $settings->apiKey;
        $this->latitude = $settings->latitude;
        $this->longitude = $settings->longitude;
        $this->uploaded_logo = $settings->logo;
    }


    public function addEmail()
    {
        $this->validate([
            'email' => 'required|email',
        ]);
        $this->emails[] = $this->email;
        $this->reset('email');
    }

    public function removeEmail($index)
    {
        array_splice($this->emails, $index, 1);
    }

    public function addPhone()
    {
        $this->validate([
            'phone' => 'required|numeric',
        ]);
        $this->phones[] = $this->phone;
        $this->reset('phone');
    }

    public function removePhone($index)
    {
        array_splice($this->phones, $index, 1);
    }

    public function addGroupName()
    {
        $this->validate([
            'group_name' => ['required', 'string', Rule::notIn(Arr::pluck($this->links, 'name'))],
        ]);

        $this->links[] = ['name' => $this->group_name, 'children' => []];
        $this->reset('group_name');
    }

    public function removeGroupName($index)
    {
        array_splice($this->links, $index, 1);
    }

    public function addLink($index)
    {
        $this->links[$index]['children'][] = ['title' => '', 'url' => ''];
    }

    public function removeLink($index, $child_index)
    {
        $cLinks = $this->links[$index]['children'];
        array_splice($cLinks, $child_index, 1);
        $this->links[$index]['children'] = $cLinks;
    }

    public function deleteLogo()
    {
        if ($this->logo)
            unset($this->logo);
        if ($this->uploaded_logo) {
            Storage::deleteDirectory('website-logo');
            ModelsSetting::where('id', 1)->update(['logo' => null]); // This updates the database
            $this->uploaded_logo = null;
        }
    }

    public function save()
    {
        $data = $this->validate();
        $data['emails'] = json_encode($data['emails']);
        $data['phones'] = json_encode($data['phones']);
        $data['links'] = json_encode($data['links']);
        if ($this->logo) {
            Storage::deleteDirectory('website-logo');
            $path = $this->logo->store(path: 'website-logo');
            $data['logo'] = $path;
        } elseif ($this->uploaded_logo === null) {
            $data['logo'] = null; // This will set logo to null in database if it was removed
        } else {
            unset($data['logo']);
        }
        ModelsSetting::updateOrCreate(['id' => 1], $data);
        flash()->success('تغییرات با موفقیت ذخیره شد');
    }

    public function render()
    {
        return view('livewire.admin.pages.setting.setting-component')->extends('livewire.admin.layout.MasterAdmin')
            ->section('Content');
    }
}
