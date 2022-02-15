<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Support\Facades\Log;


class FileController extends Controller
{
    use FileUpload; //to call the upload function

    public function upload(FileRequest $request)
    {
        try {
            // get validated form data
            $validatedData = $request->validated();
            $file = $request->file('file');
            //try to upload the image
            [$status, $origin_name, $path, $type, $size] = $this->fileUpload($file);
            if (!$status) throw new Exception('error upload');
            //save in DB
            $file = File::saveNewFile($origin_name, $path, $size, $type);
            if ($file == null) throw new Exception('error save'); //maybe here we should delete the image from the server also
            //return response to the user
            return response(['message' => 'Upload successfully', 'file' => $file], 200);
        } catch (Exception $e) {
            Log::info('error in upload/file controller: ' . $e->getMessage());
            return response([], 500);
        } //catch

    } //function


    /**
     * @todo: get a specific file using its uuid
     *
     * @param $uuid
     */
    public function getFile($uuid)
    {
        try {
            $file = File::find($uuid);
            if ($file == null) {
                return response(['message' => 'Not Found'], 404);
            }
            return response(['message' => $file], 404);
        } catch (\Exception $e) {
            Log::info('error in file/ file controller');
            return response([], 500);
        } //catch

    } //file


}