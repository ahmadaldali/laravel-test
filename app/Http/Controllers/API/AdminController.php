<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use App\Traits\ListsResult;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
     * @todo: admin delete a user
     */
    public function deleteUser($uuid)
    {
        try {
            //get that user
            $user = User::find($uuid);
            //admin can remove only the users
            if (!$user || $user->is_admin) return response([], 404);
            //in my opinion, I think we shouldn't delete a user if he is logged in
            //so we should add something to the DB to explain that,
            //e.g: status column, or last log out at, from that we can check
            $user->delete();
            return response(['message' => 'Deleted Successfully'], 200);
        } catch (Exception $e) {
            Log::info('error in delete user: ' . $e->getMessage());
            return response([], 500);
        } //catch
    } //delete user

    /**
     * @todo: get all users
     *
     * @param ListRequest $request
     */
    public function getAllNonAdmin(ListRequest $request)
    {
        //first get all users
        $model = User::all();
        //to fetch non admins only
        $addedParams = ['is_admin' => 0];
        //fetch the results
        return $this->getTheResult($model, $request, $addedParams);
    } //getAllUsers - non admin

}//class
