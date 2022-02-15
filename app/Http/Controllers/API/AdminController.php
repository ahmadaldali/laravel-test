<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Filter\FilterBuilder;
use App\Http\Requests\ListRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\Order;
use App\Models\User;
use App\Traits\ListsResult;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    use ListsResult;

    /**
     * @todo: login using the email and the pass
     *
     * @param LoginUserRequest $request
     * @return void
     */
    public function login(LoginUserRequest $request)
    {
        // get validated form data
        $validatedData = $request->validated();
        //try to login
        $response = User::login($validatedData);
        //check if the token isn't "", so everything is ok.
        return ($response[1] == 200)
            ? response(['message' => 'You have been successfully logged in', 'access_token' => $response[0]], $response[1])
            : response(['message' => $response[0]], $response[1]); //error -> 422 or 500
    } //login

    /**
     * @todo: create a new admin
     *
     * @param CreateUserRequest $request
     * @return void
     */
    public function create(UserRequest $request)
    {
        // get validated form data
        $validatedData = $request->validated();
        //make the pass hashed
        $validatedData['password'] = Hash::make($request->password);
        //try to create a new admin
        $accessToken = User::register($validatedData);
        //check if the token isn't "", so everything is ok.
        return ($accessToken != "")
            ? response(['message' => 'You have been successfully created user', 'access_token' => $accessToken], 200)
            : response([], 500);
    } //create

    /**
     * @todo: get all users
     *
     * @param ListRequest $request
     */
    public function getAllNonAdmin(ListRequest $request)
    {
        //first get all users
        $model = User::all()->toQuery();
        //to fetch non admins only
        $addedParams = ['is_admin' => 0];
        //fetch the results
        return $this->getTheResult($model, $request, $addedParams);
    } //getAllUsers - non admin

}//class
