<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasFactory;

    //primary key
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'first_name', 'last_name', 'address', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    //relationship section

    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_uuid', 'uuid');
    }

    //my helper functions section
    /**
     * @return User|null
     */
    public static function getLoggedUser()
    {
        //get the logged user
        return Auth::guard('api')->user();
    }

    /**
     * @todo: try to login(admin or normal)
     * so we call this function from AdminController@login and UserController@login

     * @param $data
     * @param $is_admin
     */
    public static function login($data, $is_admin = true)
    {
        DB::beginTransaction();
        try {
            //get the user using the email only
            $user = User::where('email', $data['email'])
                ->where('is_admin', $is_admin)->first();
            /**
             * check if that email already exists or not
             * And,we will check from the password
             * cuz, it is hashed, then we should hash the entered pass and compare with user's hashed pass
             */
            if ($user && Hash::check($data['password'], $user->password)) {
                //if we reach here, that email exists, and  //the same password, so create a token based on uuid and return it
                $token = $user->createToken($user->uuid)->accessToken;

                //set the last login time
                $user->last_login_at = Carbon::now();
                $user->save();
                Log::info($user);
                DB::commit();
                return [$token, 200];
            }
            //invalid credentials
            return ["Invalid Credentials", 422];
        } catch (\Exception $e) {
            DB::rollback();
            Log::info('error in login/User Model: ' . $e->getMessage());
            //something error happened
            return ["", 500];
        } //catch
    } //login


    /**
     * @todo: try to create a new user (admin or normal)
     * so we call this function from AdminController@create and UserController@create
     *
     * @param $data
     * @param $is_admin
     */
    public static function register($data, $is_admin = true)
    {
        DB::beginTransaction();
        try {
            //create a new user
            //$user = User::create($data);
            $user = new User();
            //add the columns
            foreach ($data as $field => $value) {
                $user->$field = $value;
            }
            //check if admin or a normal user
            if ($is_admin) {
                $user->is_admin = 1;
            }
            $user->save();
            //create a token
            $accessToken = $user->createToken($user->uuid)->accessToken;
            DB::commit();
            return $accessToken;
        } catch (\Exception $e) {
            Log::info('error in register/User Model: ' . $e->getMessage());
            DB::rollBack();
            return "";
        } //catch
    } //register


    /**
     * @todo: update the current information of the logged user
     *
     * @param $data
     */
    public static function edit($data)
    {
        DB::beginTransaction();
        try {
            //get the logged user
            $user = self::getLoggedUser();
            //not logged / not necessary this condition cuz there is a middleware
            if ($user == null) return ["", 401];
            //get the user record as a model
            //$user = User::find($user->uuid);
            //update the columns
            foreach ($data as $field => $value) {
                $user->$field = $value;
            }
            $user->save();
            //commit the changes
            DB::commit();
            return ["Updated successfully", 200];
        } catch (\Exception $e) {
            Log::info('error in update/User Model: ' . $e->getMessage());
            DB::rollBack();
            return ["", 500];
        } //catch
    } //register

}//class