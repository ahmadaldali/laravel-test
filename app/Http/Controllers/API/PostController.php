<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    /**
     * @todo: get a specific post using its uuid
     *
     * @param $uuid
     */
    public function getPost($uuid)
    {
        //simply: findOrFail($uuid);
        //but I will discuss it deeply to return the best response when failed, 500 or 404 with my message
        try {
            $post = Post::find($uuid);
            if ($post == null) {
                return response(['message' => 'Not Found'], 404);
            }
            return response(['message' => $post], 404);
        } catch (\Exception $e) {
            return response([], 500);
        } //catch
    } //function

}