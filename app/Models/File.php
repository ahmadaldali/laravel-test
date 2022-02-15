<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class File extends Model
{
    //primary key
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'name',
        'path',
        'size',
        'type',
    ];


    /**
     * @todo: add a new record in the DB
     *
     * @param $name
     * @param $path
     * @param $size
     * @param $type
     * @return void
     */
    public static function saveNewFile($name, $path, $size, $type)
    {
        try {
            $file = new File();
            $file->uuid = Str::uuid()->toString(); //to return it with the file object
            $file->name = $name;
            $file->path = $path;
            $file->size = $size;
            $file->type = $type;
            $file->save();

            return $file;
        } catch (Exception $e) {
            Log::info('error in save file/file model: ' . $e->getMessage());
            return null;
        }
    } //save

}