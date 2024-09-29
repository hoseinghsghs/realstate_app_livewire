<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use App\Models\Property;
use App\Models\WishList;
use Image;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
     {
         $user=auth::user();
         $property = Property::latest()->where('isactive', 1)->get();
         $wishlist = Wishlist::where('user_id' , auth()->id())->get();  
         return view('admin.page.profile.edit' ,compact('user','property','wishlist'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request , ToastrFactory $flasher)
    { 
        
        $user=auth::user();
        $request->validate([
            'about' => 'nullable',
            'name' => 'required|max:255',
            'email' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|max:1024'
        ]);
        

        $image = $request->file('image');
        $slug  = Str::slug($request->title);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->extension();
            if (!Storage::exists('profile')) {
                Storage::makeDirectory('profile');
            }
            if (Storage::exists('profile/' . $user->image) && $user->image!=='default.png') {
                Storage::delete('profile/' . $user->image);
            }
            Image::make($image)->resize(800, 800)->save(Storage::getAdapter()->getPathPrefix() . 'profile/' . $imagename);
        } else {
            $imagename = $user->image;
        }
        
        if (isset($request->about)) {
            $user->about = $request->about;
        }
        if (isset($request->email)) {
            $user->email = $request->email;
        }
        $user->name = $request->name;
        $user->about = $request->about;
        $user->phone = $request->phone;
        $user->image = $imagename;
        $user->save();       
       
         $flasher->addSuccess('پروفایل با موفقیت بروزرسانی شد');
        if (Gate::allows('is_user')) {
            return redirect()->route('user.home');
        }
        if (Gate::allows('is_admin')) {
            return redirect()->route('admin.home');
        } 
        else if(Gate::allows('is_agent')) {
            return redirect()->route('agent.home');
        }
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}