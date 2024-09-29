<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class PropertyImageController extends Controller
{ 
    public function upload($imageUpload){
        if (isset($imageUpload)) {
            
            
            $image=PertiongenerateImageName($imageUpload->getClientOriginalName());
            
            if (!Storage::exists('preview')) {
                // این پوشه را بساز
                Storage::makeDirectory('preview');
            }
            
            $img = Image::make($imageUpload)->resize(1200, 800);
            $img->save(Storage::getAdapter()->getPathPrefix() . 'preview/' . $image);
            
            
         return $image;
        }
        else {
            $image="default.png";
            return $image;
            
        }
        
    }


public function uploadOtherImage($otherimageUpload)
{
    if (isset($otherimageUpload)) {
        $fileNameImages=[];
        if (!Storage::exists('otherpreview')) {
            // این پوشه را بساز
            Storage::makeDirectory('otherpreview');
        }
        foreach( $otherimageUpload as $img){
           

            $image=PertiongenerateImageName($img->getClientOriginalName());

            $imge = Image::make($img)->resize(1200, 800);
            array_push($fileNameImages,$image);
            $imge->save(Storage::getAdapter()->getPathPrefix() . 'otherpreview/' . $image);
            // $img->move(public_path('assets/images/property/preview'), $image);
        }
        return $fileNameImages;
    }
     
}

public function editupload($imageUpload){
    if (isset($imageUpload)) {
        
        
        $image=PertiongenerateImageName($imageUpload->getClientOriginalName());
        
        if (!Storage::exists('preview')) {
            // این پوشه را بساز
            Storage::makeDirectory('preview');
        }
        
        $img = Image::make($imageUpload)->resize(1200, 800);
        $img->save(Storage::getAdapter()->getPathPrefix() . 'preview/' . $image);
        
        // $img->move(public_path('assets/images/property/preview'), $image);
     return $image;
    }
   
    
}

}