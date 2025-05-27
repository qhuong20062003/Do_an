<?php

namespace App\Traits;
use Storage;
use Illuminate\Support\Str;

trait StorageImageTrait{
    public function storageTraitUpload($request,$fileName, $foderName)  {
        if($request->hasFile($fileName)){
            $file = $request->file($fileName);
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fileName)->storeAs($foderName . '/' . auth()->id(),$fileNameHash, 'public');
            $dataUploadTrait =[
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        return $dataUploadTrait;

        }
        return null;
    }

    public function storageTraitUploadMultiple($file, $foderName)  {
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs($foderName . '/' . auth()->id(),$fileNameHash, 'public');
            $dataUploadTrait =[
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        return $dataUploadTrait;

        
    }
}