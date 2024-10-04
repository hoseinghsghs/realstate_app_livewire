<?php

namespace App\Livewire\Forms;

use App\Http\Controllers\Admin\PropertyImageController;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Container\Attributes\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

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
    public $img;
    public $otherimg;

    public function rules(): array
    {
        return [
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'title' => 'required',
            'tr_type' => 'required',
            'type' => 'required',
            'code' => 'unique:properties,code',
            'bedroom' => 'required',
            'floorsell' => 'required',
            // "phone" =>  "required|numeric",
            'rent' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
            'rahn' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
            'bidprice' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
            'ugprice' => ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
            'img' => 'image|mimes:jpeg,jpg,png|max:2044',
        ];
    }
    public function store()
    {
        $this->validate();

        $PropertyImageController = new PropertyImageController();
        $imageName = $PropertyImageController->upload($this->img);
        $imageOtherName = $PropertyImageController->uploadOtherImage($this->otherimg);

        Property::create($this->all());
        $property = new Property();

        //new
        $property->description = $this->description;
        $property->province = $this->province;
        $property->city = $this->city;
        $property->district = $this->district;
        $property->title = $this->title;
        $property->lable = $this->lable;
        $property->tr_type = $this->tr_type;
        //new
        $property->type = $this->type;
        $property->code = $this->code;
        $property->usertype = $this->usertype;
        $property->bedroom = $this->bedroom;
        $property->floorsell = $this->floorsell;
        $property->floor = $this->floor;
        $property->year = $this->year;
        $property->area = $this->area;
        $property->meter = $this->meter;
        $property->bidprice = Str::replace(',', '', $this->bidprice);
        $property->ugprice = Str::replace(',', '', $this->ugprice);
        $property->lon = $this->lon;
        $property->lat = $this->lat;
        $property->address = $this->address;
        $property->loan = $this->loan;

        $property->loanamount = Str::replace(',', '', $this->loanamount);
        $property->meter_price = Str::replace(',', '', $this->meter_price);
        $property->people_number = $this->people_number;
        $property->door = $this->door;
        $property->rent = Str::replace(',', '', $this->rent);
        $property->rahn = Str::replace(',', '', $this->rahn);
        $property->name_family = $this->name_family;
        $property->telephone = $this->telephone;
        $property->phone = $this->phone;
        $property->doc = $this->doc;
        $property->dimension = $this->dimension;
        $property->view = $this->view;
        $property->phone_line = $this->phone_line;
        $property->screen = $this->screen;
        $property->cover = $this->cover;
        $property->cool = $this->cool;
        $property->heat = $this->heat;
        $property->cabinet = $this->cabinet;
        $property->collection = $this->collection;

        //ویدیو
        $property->ambed = $this->ambed;
        $property->img = $imageName;
        $property->user_id = Auth::user()->id;

        //
        if (isset($this->ischenge)) {
            $property->ischenge = true;
        } else {
            $property->ischenge = false;
        }
        //

        if (isset($this->featured)) {
            $property->featured = true;
        }
        //

        if (isset($this->isactive)) {
            $property->isactive = true;
        } else {
            $property->isactive = false;
        }

        //

        $property->save();

        if (isset($imageOtherName)) {
            foreach ($imageOtherName as $name) {
                PropertyImage::create([
                    'property_id' => $property->id,
                    'name' => $name,
                ]);
            }
        }

        $property->features()->sync($this->features);
    }
}
