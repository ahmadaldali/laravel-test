<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use App\Traits\ListsResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class UserController extends Controller
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
        //try to login - false that mean is not admin
        $response = User::login($validatedData, false);
        //check if the token isn't "", so everything is ok.
        return ($response[1] == 200)
            ? response(['message' => 'You have been successfully logged in', 'access_token' => $response[0]], $response[1])
            : response(['message' => $response[0]], $response[1]); //error -> 422 or 500
    } //login

    /**
     * @todo: create a new user
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
        //try to create a new user - false mean is not admin
        $accessToken = User::register($validatedData, false);
        //check if the token isn't "", so everything is ok.
        return ($accessToken != "")
            ? response(['message' => 'You have been successfully created user', 'access_token' => $accessToken], 200)
            : response([], 500);
    } //create

    /**
     * return the logged user
     *
     * @return void
     */
    public function user()
    {
        try {
            $user = User::getLoggedUser();
            return response($user, 200);
        } catch (\Exception $e) {
            Log::info('get current user: ' . $e->getMessage());
            return response([], 500);
        } //catch
    } //user

    /**
     * delete the logged user
     *
     * @return void
     */
    public function delete()
    {
        try {
            $user = User::getLoggedUser();
            $user->token()->revoke();
            $user->delete();
            return response(['message' => 'Deleted Successfully'], 200);
        } catch (\Exception $e) {
            Log::info('delete user: ' . $e->getMessage());
            return response([], 500);
        } //catch
    } //user

    /**
     * @todo: update the user
     *
     * @param CreateUserRequest $request
     * @return void
     */
    public function edit(UserRequest $request)
    {
        // get validated form data
        $validatedData = $request->validated();
        //make the pass hashed
        $validatedData['password'] = Hash::make($request->password);
        //update the user record
        $response = User::edit($validatedData);
        //return the response, 200/401, or 500
        return response(['message' => $response[0]], $response[1]);
    } //edit

    /**
     * @todo: request a token to reset its password
     *
     * @param Request $request
     * @return void
     */
    public function forgotPassword(Request $request)
    {
        //validate the email
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        //check if that email has a token before or not
        //cuz the DB will truncated every day so, the user can request only one token in one day
        $record = DB::table('password_resets')
            ->where([
                'email' => $request->email,
            ])->first();
        if ($record) {
            return response(['message' => 'You have requested a token before, Please wait until tomorrow'], 200);
        }
        //generate a random token
        $token = Str::random(64);
        //insert this email with the token to the DB
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        return response(['token' => $token], 200);
    } //forget-password

    /**
     * @todo: try to update user's password based on the token and his email.
     */
    public function resetPasswordToken(Request $request)
    {
        //validate the email and the password
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:3|confirmed',
            'password_confirmation' => 'required'
        ]);
        //check if that email/token exist
        $record = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();

        if (!$record) {
            //error token or email
            return response(['message' => 'Invalid email/token'], 200);
        }
        //if we reached here, then that email request a token before and has it,
        //so now we should update his password.
        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        //delete that record from reset table
        DB::table('password_resets')->where(['email' => $request->email])->delete();
        //return response
        return response(['message' => 'Password reset successfully'], 200);
    } //reset-pass


    /**
     *
     * @return void
     */
    public function orders(ListRequest $request)
    {
        try {
            //get the user's orders through the model's relationship
            $user = User::getLoggedUser();
            $orders = $user->orders->toQuery();
            //fetch the results
            return $this->getTheResult($orders, $request);
        } catch (\Exception $e) {
            Log::info('get user orders: ' . $e->getMessage());
            return response([], 500);
        } //catch
    } //orders

}//class
