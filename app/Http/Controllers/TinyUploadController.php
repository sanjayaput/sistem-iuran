<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinyUploadController extends Controller{
    
    public function uploadImage(Request $request){
        $destinationPathImage = 'upload/images';
        $file = $request->file('file');
        // Get file extension
        $extension = $file->getClientOriginalExtension();
        $filename = $file->getClientOriginalName();

        // Get file extension
        $extension = $file->getClientOriginalExtension();
        $filename = $file->getClientOriginalName();

        // return $filename;
        $original_name = pathinfo($filename, PATHINFO_FILENAME);


        // Valid extensions
        $validextensions = array("jpeg","jpg","png");

        if(in_array(strtolower($extension), $validextensions)){
            // Rename file 
            $fileNameImages = str_replace(' ', '_', $original_name) .'.' . $extension;
            // Uploading file to given path
            $file->move($destinationPathImage, $fileNameImages);
            return response()->json(['location' => asset('/upload/images/'.$fileNameImages)]);
        }else{
            return response(["Gagal mengupload gambar"]);
        }
    }

}