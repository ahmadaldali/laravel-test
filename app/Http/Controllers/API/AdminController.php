<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

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
        Log:
        info($validatedData);
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


    public function getAllUsers()
    {
        $sortby = 'email';
        //Page, limit, sort by, desc
        $users = User::orderBy($sortby, 'desc')->paginate(2)->take(100);
        return response($users, 200);
    } //getAllUsers

}