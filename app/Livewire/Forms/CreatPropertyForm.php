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
    public $ischenge;
    public $featured;
    public $isactive;

    public $bcolor_step_1, $bcolor_step_2, $bcolor_step_3, $bcolor_step_4 = '#e9ecef';

    public $color_step_1, $color_step_2, $color_step_3, $color_step_4   = '#000000';


    public $otherimg = [];
    public $features = [];
    public $totalSteps = 4;
    public $currentStep = 4;

    public $img;

    public function validateData()
    {

        if ($this->currentStep == 1) {

            $this->validate([
                // 'province' => 'required',
                // 'city' => 'required',
                // 'district' => 'required',
                'title' => 'required',
                // // 'tr_type' => 'required',
                // 'type' => 'required',
                // 'code' => 'unique:properties,code',
                // // 'bedroom' => 'required',
                // 'floorsell' => 'required',
                // // "phone" =>  "required|numeric",
                // 'rent' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                // 'rahn' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                // 'bidprice' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                // 'ugprice' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                // 'img' => 'image|mimes:jpeg,jpg,png|max:2044',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->color_step_1 = '#009b32';
            $this->color_step_1 = '#ffffff';
            // $this->validate([]);
        } elseif ($this->currentStep == 3) {
            $this->color_step_1 = '#009b32';
            $this->color_step_2 = '#009b32';
            $this->color_step_1 = '#ffffff';
            $this->color_step_2 = '#ffffff';
            // $this->validate([]);
        } elseif ($this->currentStep == 4) {
            $this->color_step_1 = '#009b32';
            $this->color_step_2 = '#009b32';
            $this->color_step_3 = '#009b32';
            $this->color_step_1 = '#ffffff';
            $this->color_step_2 = '#ffffff';
            $this->color_step_3 = '#ffffff';
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

        if (isset($this->ischenge)) {
            $this->ischenge = true;
        } else {
            $this->ischenge = false;
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

        $property = Property::create($this->except(['features', 'otherimg', 'bcolor_step_1', 'bcolor_step_2', 'bcolor_step_3', 'bcolor_step_4', 'color_step_1', 'color_step_2', 'color_step_3', 'color_step_4', 'totalSteps', 'currentStep']));
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
