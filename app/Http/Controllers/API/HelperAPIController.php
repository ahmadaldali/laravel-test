<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class HelperAPIController extends Controller
{

    /**
     * @todo: logout the current user
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        try {
            //check if the user is logged in already and then revoke the token
            $user = Auth::guard('api')->user();
            $token = $user->token();
            $token->revoke();
            $response = ['message' => 'You have been successfully logged out!'];
            return response($response, 200);
        } catch (Exception $e) {
            Log::info('error in logout/AdminController: ' . $e->getMessage());
            return response([], 500);
        } //catch
    } //logout

}