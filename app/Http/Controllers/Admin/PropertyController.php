<?php
namespace App\Http\Controllers\Admin;
use App\Models\Property;
use App\Models\User;
use App\Models\Service;
use App\Models\Feature;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\PropertyImageController;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Verta;
use Image;
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
       
        if ($request->type_property=="advertise") {
            
            $features = Feature::latest()->get();
            // $property= User::all();
            $property=Property::whereHas('user', function ($query) {
                return $query->where('role_id', '=', 3);
            })->latest()->paginate(10)->withQueryString();
            return view('admin.page.property.index',compact('property','features'));
        }else{
            $property=Property::whereHas('user', function ($query) {
                return $query->where('role_id', 2)->orWhere('role_id', 1);
            })->latest()->paginate(10)->withQueryString();

            $features = Feature::latest()->get();
            $propertyAgent = Property::where('user_id',Auth::user()->id)->latest()->paginate(10);
            return view('admin.page.property.index',compact('property','features','propertyAgent'));

        }
       
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { $services = Service::latest()->get();
        $features = Feature::latest()->get();
        return view ('admin.page.property.create',compact('services','features'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,ToastrFactory $flasher)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Property $property)
    {
        if ($request->ajax()) {
            return response()->json(view('admin.partial.propertyDetail', compact('property'))->render());
        } else {
            return view('admin.page.property.show', compact('property'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(property $property)
    
    {
        
        $features = Feature::latest()->get();
        return view('admin.page.property.edit', compact('property','features'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, property $property ,ToastrFactory $flasher)
    {
        
        $PropertyImageController=new PropertyImageController();
      $imageName=$PropertyImageController->editupload($request->img);
      $imageOtherName=$PropertyImageController->uploadOtherImage($request->otherimg);
   
     
     

       $request->validate(
            [   
                "province" => "required",
                "city" => "required",
                "district" => "required",
                "title" => "required",
                "tr_type" => "required",
                "type" => "required",
                "bedroom" =>  "required",
                "floorsell" =>  "required",
               // "phone" =>  "required|numeric",
                "rent" =>  ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"] ,
                "rahn" =>  ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                "bidprice" =>  ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                "ugprice" =>  ["regex:/^\ ?[+-]?[0-9]{1,3}(?:,?[0-9])*(?:\.[0-9]{1,2})?$/"],
                "img"=> "image|mimes:jpeg,jpg,png|max:2044",
                'code' => 'unique:properties,code,'.$property->id
            ]
            );
                //new
                $property->description=$request->description;
                $property->agent_description=$request->agent_description;
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
 
              
                //
                if(isset($request->featured)){
                    $property->featured = true;
                }else{
                    $property->featured = false;
                }
                $property->features()->sync($request->features);
                //  
                if (isset($request->isactive)) {
                    $property->isactive=true;
                }else {
                    $property->isactive=false;};
                //
                if (isset($request->ischenge)) {
                        $property->ischenge=true;
                 }else {
                        $property->ischenge=false;};
                //
                if (isset($imageName)) {
                    if (Storage::exists('preview/' . $property->img) && $property->img!=='default.png') {
                Storage::delete('preview/' . $property->img);
            }
                    $property->img=$imageName;
                }
                else {
                    $imagename2 = $property->img;
                    $property->img=$imagename2;
                }
                
                $property->save();

                if (isset ($imageOtherName)) {
                    // PropertyImage::where('property_id', $property->id)->delete();
                    foreach($imageOtherName as $ame){
                        PropertyImage::create([
                      'property_id'=> $property->id,
                       'name'=> $ame
                    ]);
                    }}
                    else {
                        foreach($property->images() as $ame){
                            PropertyImage::create([
                          'property_id'=> $ame->id,
                           'name'=> $ame
                        ]);
                        
                    };
                }
                    
              
        $flasher->addSuccess( 'ملک با موفقیت تغییر کرد');
       
        if (Gate::allows('is_admin')) {
            return redirect()->route('admin.properties.index');
        } 
        else if(Gate::allows('is_agent')) {
            return redirect()->route('agent.properties.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(property $property,ToastrFactory $flasher)
    {
        if (Storage::exists('preview/' . $property->img && $property->img!=='default.png')) {
            Storage::delete('preview/' . $property->img);
        }
        $images = $property->images;
        if (count($images) > 0) {
            foreach ($images as $image) {
                Storage::delete('otherpreview/' . $image->name);
            }
            $property->images()->delete();
        }
        $property->delete();
        $flasher->addSuccess('ملک با موفقیت حذف شد');
        return back();
    }
  public function search(Request $request)
    {
        $user_id = $request->query('user_id');
        $tr_type = $request->query('tr_type');
        $usertype = $request->query('usertype');
        $type = $request->query('type');
        $search = $request->query('search');
        $district = $request->query('district');
        $price_range = $request->query('price-range');
        $rent_range = $request->query('rent-range');
        $rahn_range = $request->query('rahn-range');
        $meter_range = $request->query('meter-range');
        $bedroom = $request->query('bedroom');
        $floorsell = $request->query('floorsell');
        $code = $request->query('code');
        $doc = $request->query('doc');
        $features = $request->query('features');

        $properties = Property::with('user')->when($user_id, function ($query, $user_id) {
            return $query->where('user_id', $user_id);
        })->when($tr_type, function ($query, $tr_type) {
            return $query->where('tr_type', $tr_type);
        })->when($usertype, function ($query, $usertype) {
            return $query->where('usertype', $usertype);
        })->when($type, function ($query, $type) {
            return $query->where('type', $type);
        })->when($district, function ($query, $district) {
            return $query->where('district', $district);
        })->when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%')->orWhere('address', 'like', '%' . $search . '%');
        })->when($tr_type === 'فروش' && $price_range, function ($query) use ($price_range) {
            $price_range = array_map('intval', explode(';', $price_range));
            return $query->whereBetween('bidprice', $price_range);
        })->when($tr_type === 'رهن و اجاره' && $rahn_range, function ($query) use ($rahn_range) {
            $rahn_range = array_map('intval', explode(';', $rahn_range));
            return $query->whereBetween('rahn', $rahn_range);
        })->when($tr_type === 'رهن و اجاره' && $rent_range, function ($query) use ($rent_range) {
            $rent_range = array_map('intval', explode(';', $rent_range));
            return $query->whereBetween('rent', $rent_range);
        })->when($meter_range, function ($query, $meter_range) {
            $meter_range = array_map(function ($value) {
                return (int) $value;
            }, explode(';', $meter_range));
            return $query->whereBetween('meter', $meter_range);
        })->when($bedroom, function ($query, $bedroom) {
            return $query->where('bedroom', $bedroom);
        })->when($floorsell, function ($query, $floorsell) {
            return $query->where('floorsell', $floorsell);
        })->when($code, function ($query, $code) {
            return $query->where('code', $code);
        })->when($doc, function ($query, $doc) {
            return $query->where('doc', $doc);
        })->when($features, function ($query, $features) {
            return $query->whereHas('features', function ($query) use ($features) {
                $query->whereIn('features.id', $features);
            });
        })->withCount('images')->latest()->paginate(6)->withQueryString();
        //  check if request is json
        if ($request->ajax()) {
            return response()->json(view('admin.partial.search-results', compact('properties'))->render());
        }
        /// if not api
        $features = Feature::all();
        $districts = Property::all()->unique('district')->pluck('district');
        return view('admin.page.property.estate-search', compact('properties', 'features', 'districts'));
    }
}