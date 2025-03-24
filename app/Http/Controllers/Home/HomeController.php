<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Feature;
use App\Models\Post;
use App\Models\Property;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\User;
use Flasher\Toastr\Prime\ToastrFactory;
use App\Models\WishList;

class HomeController extends Controller
{


    public function index()
    {
        $slider = Slider::where('position', 'اسلایدر')->get();
//        $baner = Slider::where('position', 'بنر')->get();
        $service_image = Slider::where('position', 'تصویرسرویس')->get();
        $baner = Slider::where('position', 'بنر')->get();
        $property_rent = Property::active()->latest()->where('tr_type', 'رهن و اجاره')->take(6)->get();
        $property_sell = Property::active()->latest()->where('tr_type', 'فروش')->take(6)->get();

        $property_type_ap = Property::active()->latest()->where('type', 'آپارتمان')->get();
        $property_sell_ho = Property::active()->latest()->where('type', 'خانه ویلایی')->get();
        $property_sell_ma = Property::active()->latest()->where('type', 'مغازه')->get();
        $property_sell_la = Property::active()->latest()->where('type', 'زمین و کلنگی')->get();



        $property = Property::active()->latest()->get();
        $service = Service::all();
        $user_agent = User::where([['role_id', 2], ['isactive', 1]])->get();
        $wishlist = Wishlist::where('user_id', auth()->id())->get();
        $districts = Property::all()->unique('district')->pluck('district');
        $acount = User::where([['role_id', 2], ['isactive', 1]])->count();
        $rcount = $property_rent->count();
        $scount = $property_sell->count();

        $apcount = $property_type_ap->count();
        $hocount = $property_sell_ho->count();
        $macount = $property_sell_ma->count();
        $lacount = $property_sell_la->count();

        $ucount = User::count();
        $specials = Property::latest()->where('lable', 'ویژه ها')->get();
        $posts = Post::with('image')->latest()->take(3)->get();
        $articles = Article::with('image')->latest()->take(3)->get();
        return view('home.pages.home', compact(
            'user_agent',
            'slider',
            'service',
            'baner',
            'service_image',
            'property_sell',
            'property_rent',
            'property',
            'wishlist',
            'districts',
            'rcount',
            'scount',
            'acount',
            'apcount',
            'hocount',
            'macount',
            'lacount',
            'ucount',
            'posts',
            'articles',
            'specials'
        ));
    }

    //--------------------------------------------------------------------------------------------

    public function show_property(Property $property)
    {
        // check if property active or not
        if ($property->isactive == false) {
            abort(404);
        }

        $property->loadCount(['comments' => function ($query) {
            $query->where('approved', true);
        }])->load(['images', 'comments' => function ($query) {
            $query->where('approved', true);
        }, 'comments.user']);
        // get the property owner and count of it's properties
        $user = $property->user;
        $user->loadCount('properties');
        //similar properties
        $similar_properties = Property::active()->with('user')->latest()->where('tr_type', $property->tr_type)->take(5)->get();
        $similar_properties = $similar_properties->except([$property->id]);
        if (!auth()->check()) {
            $wishlist = false;
        } else {
            $wishlist = WishList::where("user_id", '=', auth()->id())->where("property_id", '=', $property->id)->first();
        }
//        $setting = Setting::firstOrNew();
        return view('home.pages.single-estate', compact('property', 'similar_properties', 'user', 'wishlist'));
    }
    //register comments in single property
    public function register_comment(Request $request, Property $property)
    {
        $data = $request->validate([
            'rating' => 'nullable|numeric|between:1,5',
            'body' => 'required|string'
        ]);

        $data['user_id'] = auth()->id();
        $property->comments()->create($data);
        return back()->with('msg', 'نظر شما با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد');
    }
    // search along the properties
    public function properties_list(Request $request)
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

        $properties = Property::with('user')->active()->when($user_id, function ($query, $user_id) {
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
        /// chech if request is json
        if ($request->ajax()) {
            return response()->json(view('home.partials.listing', compact('properties'))->render());
        }
        /// if not api
        $features = Feature::all();
        $districts = Property::all()->unique('district')->pluck('district');

        return view('home.pages.estate-list', compact('properties', 'features', 'districts'));
    }
}
