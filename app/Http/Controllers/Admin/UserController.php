<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Flasher\Toastr\Prime\ToastrFactory;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('role_id', 2)->latest()->paginate(10);
        return view('admin.page.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ToastrFactory $flasher)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => [
                'required', 'string', 'min:8', 'confirmed'
            ],
           'image' => 'image|mimes:jpeg,jpg,png|max:1024|required'
        ]);
          if (isset($request->isactive)) {
            $request->isactive=true;
          }else {
            $request->isactive=false;
          }    
          
          $image = $request->file('image');
          $slug  = Str::slug($request->name);

          if (isset($image)) {
  
              // گرفتن تاریخ
              $currentDate = Carbon::now()->toDateString();
              // نام عکس
              $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->extension();
              // آیا این پوشه وجود دارد
              if (!Storage::exists('profile')) {
                  // این پوشه را بساز
                  Storage::makeDirectory('profile');
              }
  
              $img = Image::make($image)->resize(800, 533);
              $img->save(Storage::getAdapter()->getPathPrefix() . 'profile/' . $imagename);
          } else {
              $imagename = 'default.png';
          }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,      
            'phone' => $request->phone,   
            'image'=> $imagename,
            'isactive' => $request->isactive,       
        ]);
        $flasher->addSuccess( 'مشاور جدید ثبت گردید');
        return redirect()->route('agent.home');
        
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
    public function edit($id)
    {
        $user = user::find($id);
        return view('admin.page.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, ToastrFactory $flasher)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
                
            ],
            'image' => 'image|mimes:jpeg,jpg,png|max:1024|required'
        ]);

        if (isset($request->isactive)) {
            $request->isactive=true;
          }else {
            $request->isactive=false;
          } 

          $image = $request->file('image');
          $slug  = Str::slug($request->title);
          if (isset($image)) {
              $currentDate = Carbon::now()->toDateString();
              $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->extension();
              if (!Storage::exists('profile')) {
                  Storage::makeDirectory('profile');
              }
              if (Storage::exists('profile/' . $request->image)) {
                  Storage::delete('profile/' . $request->image);
              }
              Image::make($image)->resize(800, 533)->save(Storage::getAdapter()->getPathPrefix() . 'profile/' . $imagename);
          } else {
              $imagename = User::find($id)->image;
          }


          User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,      
            'phone' => $request->phone,   
            'image'=> $imagename,
            'isactive' => $request->isactive,       
        ]);
        $flasher->addSuccess( 'مشاور ویرایش شد');
        return redirect()->route('admin.users.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,ToastrFactory $flasher)
    {
        //asign all posts and properties to the admin when delete user
        $admin=User::where('role_id',1)->first();
        $user = user::find($id);
        $user->properties()->update(['user_id'=>$admin->id]);
        $user->delete();

        if (Storage::exists('profile/' . $user->image)) {
            Storage::delete('profile/' . $user->image);
        }

        $flasher->addSuccess('کاربر با موفقیت حذف شد');
        return back();
  
    }
}