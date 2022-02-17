<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUpload
{
    /**
     * @todo: save the uploaded file in the server and get information about the file
     *
     * @param $file
     */
    public function fileUpload($file)
    {
        try {
            //generate a random name
            $file_name = Str::random(10);
            //get the extension
            $ext = strtolower($file->getClientOriginalExtension());
            //generated name + ext
            $full_file_name = $file_name . '.' . $ext;
            //path the folder + generated name + extension
            $full_path = 'pet-shop/' . $full_file_name;
            //save in app/storage/public/pet-shop folder
            $image = Storage::disk('public')->put($full_path, File::get($file));
            //get the size file
            $size = Storage::disk('public')->size($full_path);
            //get the name/ name of uploaded image
            $origin_name = $file->getClientOriginalName();
            //return result
            return [true, $origin_name, 'storage/app/public/' . $full_path, $ext, $size];
        } catch (\Exception $e) {
            Log::info('error upload file/fileUploadTrait: ' . $e->getMessage());
            return [false, null, null, null, null];
        } //catch
    } //method

}//trait