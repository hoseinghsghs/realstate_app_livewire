<?php

namespace App\Livewire\Admin\Property;

use App\Http\Controllers\Admin\PropertyImageController;
use App\Models\Property;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Create extends Component
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
                
    
      public function CreateProperty() {
                $PropertyImageController=new PropertyImageController();
                        $imageName=$PropertyImageController->upload($request->img);

      $imageOtherName=$PropertyImageController->uploadOtherImage($request->otherimg);
       $request->validate(
        
            [
                "province" => "required",
                "city" => "required",
                "district" => "required",
                "title" => "required",
                "tr_type" => "required",
                "type" => "required",
                'code' => 'unique:properties,code',
                "bedroom" =>  "required",
                "floorsell" =>  "required",
                // "phone" =>  "required|numeric",
                "rent" =>  ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"] ,
                "rahn" =>  ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                "bidprice" =>  ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                "ugprice" =>  ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                "img"=> "image|mimes:jpeg,jpg,png|max:2044",
            ]
            );
           

    $property = new Property();
    
                //new
                $property->description=$request->description;
                $property->province=$request->province;
                $property->city=$request->city;
                $property->district=$request->district;
                $property->title=$request->title;
                $property->lable=$request->lable;
                $property->tr_type=$request->tr_type;
                //new
                $property->type= $request->type;
                $property->code=$request->code;
                $property->usertype=$request->usertype;
                $property->bedroom=$request->bedroom;
                $property->floorsell=$request->floorsell;
                $property->floor=$request->floor;
                $property->year=$request->year;
                $property->area=$request->area;
                $property->meter=$request->meter;
                $property->bidprice=Str::replace(",", "",$request->bidprice);
                $property->ugprice=Str::replace(",", "",$request->ugprice);
                $property->lon=$request->lon;
                $property->lat =$request->lat;
                $property->address=$request->address;
                $property->loan=$request->loan;
                
                $property->loanamount = Str::replace(",", "",$request->loanamount);
                $property->meter_price =Str::replace(",", "",$request->meter_price);
                $property->people_number =$request->people_number;
                $property->door =$request->door;
                $property->rent =Str::replace(",", "",$request->rent);
                $property->rahn=Str::replace(",", "",$request->rahn);
                $property->name_family =$request->name_family;
                $property->telephone=$request->telephone;
                $property->phone=$request->phone;
                $property->doc =$request->doc;
                $property->dimension =$request->dimension;
                $property->view=$request->view;
                $property->phone_line=$request->phone_line;
                $property->screen=$request->screen;
                $property->cover =$request->cover;
                $property->cool=$request->cool;
                $property->heat=$request->heat;
                $property->cabinet=$request->cabinet;
                $property->collection=$request->collection;
    
      //ویدیو
      			$property->ambed=$request->ambed;
                $property->img=$imageName;
                $property->user_id=Auth::user()->id;
                
                //
                 if (isset($request->ischenge)) {
                    $property->ischenge=true;
             }else {
                    $property->ischenge=false;};
                //

                if(isset($request->featured)){
                    $property->featured = true;
                }
                //
               
                if (isset($request->isactive)) {
                    $property->isactive=true;
                }else {
                    $property->isactive=false;};

                //
               
                $property->save();
               
                if (isset($imageOtherName)) {
                    foreach($imageOtherName as $name){
                        PropertyImage::create([
                      'property_id'=> $property->id,
                       'name'=> $name
                    ]);
                    }
                }
               
                $property->features()->sync($request->features);

        if (Gate::allows('is_admin')) {
            $flasher->addSuccess( 'ملک با موفقیت ثبت شد');
            return redirect()->route('admin.properties.index');
        } 
        else if(Gate::allows('is_agent')) {
            $flasher->addSuccess( 'ملک با موفقیت ثبت شد');
            return redirect()->route('agent.properties.index');
        }

        else if(Gate::allows('is_user')) {
            return redirect()->route('user.home')->with('msg','کاربر گرامی ملک شما با موفقیت ثبت گردید .');
        }
        
    }
    public function render()
    {
        return view('livewire.admin.property.create');
    }
}
