<?php

namespace App\Livewire\Forms;

use App\Http\Controllers\Admin\PropertyImageController;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Container\Attributes\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;
use Verta;
use Image;


class CreatPropertyForm extends Form
{
    public $description;
    public $province;
    public $city;
    public $district;
    public $title;
    public $lable;
    public $tr_type;
    public $type;
    public $code;
    public $usertype;
    public $bedroom;
    public $floorsell;
    public $floor;
    public $year;
    public $area;
    public $meter;
    public $bidprice;
    public $ugprice;
    public $lon;
    public $lat;
    public $address;
    public $loan;
    public $loanamount;
    public $meter_price;
    public $people_number;
    public $door;
    public $rent;
    public $rahn;
    public $name_family;
    public $telephone;
    public $phone;
    public $doc;
    public $dimension;
    public $view;
    public $phone_line;
    public $screen;
    public $cover;
    public $cool;
    public $heat;
    public $cabinet;
    public $collection;
    public $ambed;
    public $user_id;
    public $ischange;
    public $featured;
    public $isactive;
    public $agent_description;
    public $bcolor_step_1, $bcolor_step_2, $bcolor_step_3, $bcolor_step_4 = '#e9ecef';

    public $color_step_1, $color_step_2, $color_step_3, $color_step_4   = '#000000';


    public $otherimg = [];
    public $features = [];
    public $validate_step1 = [];
    public $validate_step2 = [];
    public $validate_step3 = [];
    public $validate_step4 = [];


    public $totalSteps = 4;
    public $currentStep;

    public $img;

    public function validateData()
    {

        if ($this->currentStep == 1) {
            $validate = [
                'title' => 'required|string',
                'code' => 'required|unique:properties,code',
                'lable' => 'nullable|string',
                'tr_type' => 'required|string',
                'usertype' => 'required|string',
                'type' => 'required|string',
                'bedroom' => 'required|numeric',
                'floorsell' => 'required|string',
                'floor' => 'nullable|numeric',
                'year' => 'nullable|numeric',
                'area' => 'nullable|numeric',
                'meter' => 'required|numeric',
                'province' => 'required|string',
                'city' => 'required|string',
                'lon' => 'required|numeric',
                'lat' => 'required|numeric',
                'address' => 'required|string',
                'rent' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'rahn' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'people_number' =>  'nullable|numeric',
                'bidprice' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'ugprice' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'loan' => 'nullable|string',
                'loanamount' => 'nullable',
                'meter_price' => 'nullable',
                'district' => 'required',
            ];
            if ($this->tr_type == 'رهن و اجاره') {
                unset($this->validate_step1['loanamount'], $this->validate_step1['loan'], $this->validate_step1['bidprice'], $this->validate_step1['ugprice']);
            } elseif ($this->tr_type == 'فروش' || $this->tr_type == 'پیش فروش') {
                unset($this->validate_step1['rahn'], $this->validate_step1['rent'], $this->validate_step1['people_number']);
            }
        } elseif ($this->currentStep == 2) {
            $validate = [
                "phone" =>  "required|numeric",
                'name_family' => 'required|string',
                'telephone' => "required|numeric",
            ];
        } elseif ($this->currentStep == 3) {
        } elseif ($this->currentStep == 4) {
            $validate = [
                "otherimg" =>  "image|mimes:jpeg,jpg,png|max:2044'",
                'img' => 'requ|image|mimes:jpeg,jpg,png|max:2044',
            ];
        }

        $this->validate($validate);
    }


    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();

        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
        if ($this->currentStep == 2) {
            $this->color_step_1 = '#009b32';
        } elseif ($this->currentStep == 3) {
            $this->color_step_1 = '#009b32';
            $this->color_step_2 = '#009b32';
        } elseif ($this->currentStep == 4) {
            $this->color_step_1 = '#009b32';
            $this->color_step_2 = '#009b32';
            $this->color_step_3 = '#009b32';
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();

        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
        if ($this->currentStep == 2) {
            $this->color_step_1 = '#009b32';
        } elseif ($this->currentStep == 3) {
            $this->color_step_1 = '#009b32';
            $this->color_step_2 = '#009b32';
        } elseif ($this->currentStep == 4) {
            $this->color_step_1 = '#009b32';
            $this->color_step_2 = '#009b32';
            $this->color_step_3 = '#009b32';
        }
    }

    public function store()
    {
        // $this->validate();
        $this->bidprice = Str::replace(',', '', $this->bidprice);
        $this->ugprice = Str::replace(',', '', $this->ugprice);
        $this->loanamount = Str::replace(',', '', $this->loanamount);
        $this->meter_price = Str::replace(',', '', $this->meter_price);
        $this->rent = Str::replace(',', '', $this->rent);
        $this->rahn = Str::replace(',', '', $this->rahn);
        $this->user_id = auth()->user()->id;

        $PropertyImageController = new PropertyImageController();
        $imageName = $PropertyImageController->upload($this->img);
        $imageOtherName = $PropertyImageController->uploadOtherImage($this->otherimg);
        $this->img = $imageName;


        if (isset($this->ischange)) {
            $this->ischange = true;
        } else {
            $this->ischange = false;
        }
        //

        if (isset($this->featured)) {
            $this->featured = true;
        } else {
            $this->featured = false;
        }

        //
        if (isset($this->isactive)) {
            $this->isactive = true;
        } else {
            $this->isactive = false;
        }

        $property = Property::create($this->except(['features', 'otherimg', 'bcolor_step_1', 'bcolor_step_2', 'bcolor_step_3', 'bcolor_step_4', 'color_step_1', 'color_step_2', 'color_step_3', 'color_step_4', 'totalSteps', 'currentStep', 'validate_step1', 'validate_step2', 'validate_step3', 'validate_step4']));
        $property->features()->sync($this->features);
        if (isset($imageOtherName)) {
            foreach ($imageOtherName as $name) {
                PropertyImage::create([
                    'property_id' => $property->id,
                    'name' => $name,
                ]);
            }
        }
    }
}
