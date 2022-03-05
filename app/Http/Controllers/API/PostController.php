<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Models\Post;
use App\Traits\ListsResult;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    use ListsResult;

    /**
     * @param $uuid
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @todo: get a specific post using its uuid
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
            return response(['message' => $post], 200);
        } catch (\Exception $e) {
            Log::info('error in get post: ' . $e->getMessage());
            return response([], 500);
        } //catch
    } //function

    /**
     * @param ListRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @todo: get all posts
     */
    public function getAll(ListRequest $request)
    {
        //first get all posts
        $model = Post::all();
        //fetch the results
        return $this->getTheResult($model, $request);
    } //getAll

}//class
