<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Flasher\Toastr\Prime\ToastrFactory;
use Toastr;

class FeatureController extends Controller
{

    public function index()
    {
        $features = Feature::latest()->get();

        return view('admin.page.features.index',compact('features'));
    }


    public function create()
    {
        return view('admin.page.features.create');
    

    }
    public function store(Request $request,ToastrFactory $flasher)
    {
        $request->validate([
            'name' => 'required|unique:features|max:255'
        ]);

        $tag = new Feature();
        $tag->name = $request->name;
        $tag->slug = $request->name;
        $tag->save();

        $flasher->addSuccess( 'امکانات جدید ثبت گردید');
        return redirect()->route('admin.features.index');
    }


    public function edit($id)
    {
        $feature = Feature::find($id);

        return view('admin.page.features.edit',compact('feature'));
    }


    public function update(Request $request, Feature $feature ,ToastrFactory $flasher)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);
 
        $feature->name = $request->name;
        $feature->slug = $request->name;
        $feature->save();

        $flasher->addSuccess( 'امکانات ویرایش شد');
        return redirect()->route('admin.features.index');
      
    }


    public function destroy($id,ToastrFactory $flasher)
    {
        $feature = Feature::find($id);
        $feature->delete();
        $flasher->addSuccess('سرویس با موفقیت حذف شد');
        return back();
  
    }
}