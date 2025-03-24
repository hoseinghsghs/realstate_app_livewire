<?php

namespace App\Livewire\Forms;

use App\Http\Controllers\Admin\PropertyImageController;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
    public $floorsell = [];
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
    public $img;
    public $is_edit = true;
    public $states;

    public $otherimg = [];
    public $features = [];
    public $totalSteps = 4;
    public $currentStep;

    public $bcolor_step_1, $bcolor_step_2, $bcolor_step_3, $bcolor_step_4 = '#e9ecef';
    public $color_step_1, $color_step_2, $color_step_3, $color_step_4   = '#000000';
    public ?Property $property;

    public function validateData()
    {

        if ($this->currentStep == 1) {
            $validate = [
                'title' => 'required|string',
                'code' => ['required', isset($this->property) ? Rule::unique('properties', 'code')->ignore($this->property) : Rule::unique('properties', 'code')],
                'lable' => 'nullable|string',
                'tr_type' => 'required|string',
                'usertype' => 'required|string',
                'type' => 'required|string',
                'bedroom' => 'required|numeric',
                'floorsell' => 'required|array',
                'floor' => 'nullable|numeric',
                'year' => 'nullable|numeric',
                'area' => 'nullable|numeric',
                'meter' => 'required|numeric',
                'province' => 'required|string',
                'city' => 'required|string',
                'lon' => 'nullable|numeric',
                'lat' => 'nullable|numeric',
                'address' => 'required|string',
                'rent' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'rahn' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'people_number' =>  'nullable|numeric',
                'bidprice' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'ugprice' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'loan' => 'nullable|string',
                'loanamount' => 'nullable',
                'meter_price' => 'nullable',
                'district' => 'required',
            ];
            if ($this->tr_type == 'رهن و اجاره') {
                unset($validate['loanamount'], $validate['loan'], $validate['bidprice'], $validate['ugprice']);
            } elseif ($this->tr_type == 'فروش' || $this->tr_type == 'پیش فروش') {
                unset($validate['rahn'], $validate['rent'], $validate['people_number']);
            }
        } elseif ($this->currentStep == 2) {
            $validate = [
                "phone" =>  "required|ir_mobile",
                'name_family' => 'required|string',
                'telephone' => "required|numeric",
            ];
        } elseif ($this->currentStep == 3) {
            $validate = [
                'screen' => 'nullable|string',
            ];
        } elseif ($this->currentStep == 4) {
            $validate = [
                "otherimg" =>  "image|mimes:jpeg,jpg,png|max:2044",
                "img" => "image|mimes:jpeg,jpg,png|max:2044",
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
        // $this->validateData();

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
        $this->bidprice = Str::replace(',', '', $this->bidprice);
        $this->ugprice = Str::replace(',', '', $this->ugprice);
        $this->loanamount = Str::replace(',', '', $this->loanamount);
        $this->meter_price = Str::replace(',', '', $this->meter_price);
        $this->rent = Str::replace(',', '', $this->rent);
        $this->rahn = Str::replace(',', '', $this->rahn);
        $this->user_id = auth()->user()->id;
        $this->floorsell  = json_encode($this->floorsell);

        $PropertyImageController = new PropertyImageController();
        if (isset($this->img)) {
            $imageName = $PropertyImageController->upload($this->img);
            $this->img = $imageName;
        }


        $imageOtherName = $PropertyImageController->uploadOtherImage($this->otherimg);


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
        if ($this->tr_type == 'رهن و اجاره') {
            $this->loanamount = $this->loan = $this->bidprice = $this->ugprice = $this->meter_price = $this->loan = null;
        } elseif ($this->tr_type == 'فروش' || $this->tr_type == 'پیش فروش') {
            $this->rahn = $this->rent = $this->people_number = null;
        }
        $property = Property::create($this->except(['is_edit', 'property', 'states', 'features', 'otherimg', 'bcolor_step_1', 'bcolor_step_2', 'bcolor_step_3', 'bcolor_step_4', 'color_step_1', 'color_step_2', 'color_step_3', 'color_step_4', 'totalSteps', 'currentStep']));
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

    public function update()
    {
        if ($this->currentStep == 1) {
            $validate = [
                'title' => 'required|string',
                'code' => ['required', isset($this->property) ? Rule::unique('properties', 'code')->ignore($this->property) : Rule::unique('properties', 'code')],
                'lable' => 'nullable|string',
                'tr_type' => 'required|string',
                'usertype' => 'required|string',
                'type' => 'required|string',
                'bedroom' => 'required|numeric',
                'floorsell' => 'required|array',
                'floor' => 'nullable|numeric',
                'year' => 'nullable|numeric',
                'area' => 'nullable|numeric',
                'meter' => 'required|numeric',
                'province' => 'required|string',
                'city' => 'required|string',
                'lon' => 'nullable|numeric',
                'lat' => 'nullable|numeric',
                'address' => 'required|string',
                'rent' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'rahn' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'people_number' =>  'nullable|numeric',
                'bidprice' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'ugprice' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                'loan' => 'nullable|string',
                'loanamount' => 'nullable',
                'meter_price' => 'nullable',
                'district' => 'required',
            ];
            if ($this->tr_type == 'رهن و اجاره') {
                unset($validate['loanamount'], $validate['loan'], $validate['bidprice'], $validate['ugprice']);
            } elseif ($this->tr_type == 'فروش' || $this->tr_type == 'پیش فروش') {
                unset($validate['rahn'], $validate['rent'], $validate['people_number']);
            }
            $this->validate($validate);
        } elseif ($this->currentStep == 2) {
            $validate = [
                "phone" =>  "required|ir_mobile",
                'name_family' => 'required|string',
                'telephone' => "required|numeric",
            ];
            $this->validate($validate);
        } elseif ($this->currentStep == 3) {
            $validate = [
                'screen' => 'nullable|string',
            ];
            $this->validate($validate);
        } elseif ($this->currentStep == 4) {
            $validate = [
                "otherimg" =>  "image|mimes:jpeg,jpg,png|max:2044",
                "img" => "image|mimes:jpeg,jpg,png|max:2044",
            ];
        }



        if ($this->img) {
            $this->is_edit = true;
            $PropertyImageController = new PropertyImageController();
            $imageName = $PropertyImageController->upload($this->img);
            if (Storage::exists('preview/' . $this->img) && $this->img !== 'default.png') {
                Storage::delete('preview/' . $this->img);
            }

            $this->img = $imageName;
        } else {
            $this->is_edit = false;
            $this->img = $this->property->img;
        }
        if (isset($this->property->featured)) {
            $this->featured = true;
        } else {
            $this->featured = false;
        }
        if ($this->isactive) {
            $this->isactive = true;
        } else {
            $this->isactive = false;
        };

        if ($this->ischange) {
            $this->ischange = true;
        } else {
            $this->ischange = false;
        }
        $this->bidprice = Str::replace(',', '', $this->bidprice);
        $this->ugprice = Str::replace(',', '', $this->ugprice);
        $this->loanamount = Str::replace(',', '', $this->loanamount);
        $this->meter_price = Str::replace(',', '', $this->meter_price);
        $this->rent = Str::replace(',', '', $this->rent);
        $this->rahn = Str::replace(',', '', $this->rahn);
        $this->user_id = auth()->user()->id;
        $this->floorsell  = json_encode($this->floorsell);
        // $this->property->features()->sync($this->features);
        if ($this->tr_type == 'رهن و اجاره') {
            $this->loanamount = $this->loan = $this->bidprice = $this->ugprice = $this->meter_price = $this->loan = null;
        } elseif ($this->tr_type == 'فروش' || $this->tr_type == 'پیش فروش') {
            $this->rahn = $this->rent = $this->people_number = null;
        }
        $this->property->update(
            $this->except(['is_edit', 'property', 'states', 'features', 'otherimg', 'bcolor_step_1', 'bcolor_step_2', 'bcolor_step_3', 'bcolor_step_4', 'color_step_1', 'color_step_2', 'color_step_3', 'color_step_4', 'totalSteps', 'currentStep'])
        );
        $this->reset("img");
    }

    public function add_images()
    {
        $PropertyImageController = new PropertyImageController();
        $imageOtherName = $PropertyImageController->uploadOtherImage($this->otherimg);
        if (isset($imageOtherName)) {
            foreach ($imageOtherName as $name) {
                PropertyImage::create([
                    'property_id' => $this->property->id,
                    'name' => $name,
                ]);
            }
        }
        $this->reset("otherimg");
    }

    public function setProperty(Property $property)
    {
        $this->property = $property;
        $this->description = $property->description;
        $this->province = $property->province;
        $this->city = $property->city;
        $this->district = $property->district;
        $this->title = $property->title;
        $this->lable = $property->lable;
        $this->tr_type = $property->tr_type;
        $this->type = $property->type;
        $this->code = $property->code;
        $this->usertype = $property->usertype;
        $this->bedroom = $property->bedroom;
        $this->floorsell = json_decode($property->floorsell, true);
        $this->floor = $property->floor;
        $this->year = $property->year;
        $this->area = $property->area;
        $this->meter = $property->meter;
        $this->bidprice = Str::replace(",", "", $property->bidprice);
        $this->ugprice =  Str::replace(',', '', $property->ugprice);
        $this->lon = $property->lon;
        $this->lat = $property->lat;
        $this->address = $property->address;
        $this->loan = $property->loan;
        $this->loanamount =  Str::replace(',', '', $property->loanamount);
        $this->meter_price = Str::replace(',', '', $property->meter_price);
        $this->people_number = $property->people_number;
        $this->door = $property->door;
        $this->rent = Str::replace(',', '', $property->rent);
        $this->rahn = Str::replace(',', '', $property->rahn);
        $this->name_family = $property->name_family;
        $this->telephone = $property->telephone;
        $this->phone = $property->phone;
        $this->doc = $property->doc;
        $this->dimension = $property->dimension;
        $this->view = $property->view;
        $this->phone_line = $property->phone_line;
        $this->screen = $property->screen;
        $this->cover = $property->cover;
        $this->cool = $property->cool;
        $this->heat = $property->heat;
        $this->cabinet = $property->cabinet;
        $this->collection = $property->collection;
        $this->ambed = $property->ambed;
        $this->user_id = $property->user_id;
        $this->agent_description = $property->agent_description;

        // $this->property = $this->property->features->pluck('id')->toArray();
        // dd($this->property);

        // $this->features = $this->property->features;
        // if (isset($this->property->featured)) {
        //     $this->featured = true;
        // } else {
        //     $this->featured = false;
        // }
        // dd($this->features);

        if ($this->property->isactive) {
            $this->isactive = true;
        } else {
            $this->isactive = false;
        };

        if ($this->property->ischange) {
            $this->ischange = true;
        } else {
            $this->ischange = false;
        }
    }

    public function userStore()
    {
        $validate = [
            'name_family' => 'required|string',
            'telephone' => "required|numeric",
            'title' => 'required|string',
            'tr_type' => 'required|string',
            'usertype' => 'required|string',
            'type' => 'required|string',
            'bedroom' => 'required|numeric',
            'floorsell' => 'required|array',
            'floor' => 'nullable|numeric',
            'year' => 'nullable|numeric',
            'area' => 'nullable|numeric',
            'meter' => 'required|numeric',
            'province' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'rent' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
            'rahn' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
            'bidprice' => ['required', "regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
            'district' => 'required',
            "otherimg.*" =>  "image|max:2044",
        ];
        if ($this->tr_type == 'رهن و اجاره') {
            unset($validate['loanamount'], $validate['loan'], $validate['bidprice'], $validate['ugprice']);
        } elseif ($this->tr_type == 'فروش' || $this->tr_type == 'پیش فروش') {
            unset($validate['rahn'], $validate['rent'], $validate['people_number']);
        }
        $this->validate($validate);


        $this->bidprice = Str::replace(',', '', $this->bidprice);
        $this->ugprice = Str::replace(',', '', $this->ugprice);
        $this->loanamount = Str::replace(',', '', $this->loanamount);
        $this->meter_price = Str::replace(',', '', $this->meter_price);
        $this->rent = Str::replace(',', '', $this->rent);
        $this->rahn = Str::replace(',', '', $this->rahn);
        $this->user_id = auth()->user()->id;
        $this->floorsell  = json_encode($this->floorsell);
        $PropertyImageController = new PropertyImageController();
        if (isset($this->img)) {
            $imageName = $PropertyImageController->upload($this->img);
            $this->img = $imageName;
        }

        $imageOtherName = $PropertyImageController->uploadOtherImage($this->otherimg);

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
        if ($this->tr_type == 'رهن و اجاره') {
            $this->loanamount = $this->loan = $this->bidprice = $this->ugprice = $this->meter_price = $this->loan = null;
        } elseif ($this->tr_type == 'فروش' || $this->tr_type == 'پیش فروش') {
            $this->rahn = $this->rent = $this->people_number = null;
        }
        $property = Property::create($this->except(['is_edit', 'property', 'states', 'features', 'otherimg', 'bcolor_step_1', 'bcolor_step_2', 'bcolor_step_3', 'bcolor_step_4', 'color_step_1', 'color_step_2', 'color_step_3', 'color_step_4', 'totalSteps', 'currentStep']));
        // $property->features()->sync($this->features);
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
