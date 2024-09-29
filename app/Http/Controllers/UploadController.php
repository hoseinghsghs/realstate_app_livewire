<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyImage;
use App\Http\Controllers\Admin\PropertyImageController;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request){
       
        $PropertyImageController=new PropertyImageController();
        $imageName=$PropertyImageController->upload($request->file);
       
        
                PropertyImage::create([
              'property_id'=> "1050",
               'name'=> $imageName
            ]);
            return response()->json(['success' =>$imageName]);
     }

    public function delete(Request $request){   
        $filename =  $request->get('filename');
    dd($request->file('filename'));
    PropertyImage::where('name',$name)->delete();
    Storage::delete('preview/' .$name);
    return response()->json(['success' =>"تصویر حذف شد"]);
    }
   


}