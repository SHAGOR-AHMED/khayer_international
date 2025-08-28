<?php

namespace App\Http\Controllers\Common;
use Image;
use Illuminate\Support\Str;

trait ImageUpload {

    // Image Uplpoad By name 
    public function imageUplaodByName($currentImage, $oldImage=null, $imagePath, $imgFor){

        // Delete Image
        if(!empty($oldImage)){
            //Delete Old File
            if (file_exists($oldImage)){
                unlink($oldImage);
            }
        }

        // Random srting
        $randomName = Str::random(5);
        // Final Name
        $name = $imgFor . $randomName . time().'.' . $currentImage->getClientOriginalExtension();
        // Original Image Save
        \Image::read($currentImage)
        ->save($imagePath.$name);
        
        // Resized image save
        // \Image::read($currentImage)
        // ->resize(300, 200)
        // ->save($imagePathSm.$name);

        return $imagePath.$name;
        
    }

    // Upload Documents
    public function documentUpload($document,  $old_file=null, $uploadDocPath){

        // Delete Old file
        if(!empty($old_file)){
            if (file_exists($old_file)){
                unlink($old_file );
            }
        }

        $document_full_name = '';
        if($document){
            $document_name      = time().Str::random(15);
            $ext                = strtolower($document->getClientOriginalExtension());
            $document_full_name = $document_name . '.' . $ext;
            $successImg         = $document->move($uploadDocPath, $document_full_name);
        }
       
        return $uploadDocPath.$document_full_name;

    }


}
