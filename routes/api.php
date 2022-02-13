<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\HelperAPIController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//used this route in auth middleware to redirect it when no user is authenticated
Route::get('/401', function () {
    return response(['message' => 'Unauthenticated'], 401);
})->name('api.Unauthenticated');


Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::prefix('v1')->group(function () {

        //admin
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::post('create', [AdminController::class, 'create'])->name('create');
            Route::post('login', [AdminController::class, 'login'])->name('login');
            //middleware auth
            Route::group(['middleware' => ['auth:api']], function () {
                Route::get('logout', [HelperAPIController::class, 'logout'])->name('logout');
                Route::get('user-listing', [AdminController::class, 'getAllUsers'])->name('user-listing');
            }); //auth
        }); //prefix admin

        //user
        Route::prefix('user')->name('user.')->group(function () {
            Route::post('create', [UserController::class, 'create'])->name('create');
            Route::post('login', [UserController::class, 'login'])->name('login');
            Route::post('forgot-password', [UserController::class, 'forgotPassword'])->name('forgot-password');
            Route::post('reset-password-token', [UserController::class, 'resetPasswordToken'])->name('reset-password-token');

            //middleware auth
            Route::group(['middleware' => ['auth:api']], function () {
                Route::get('/', [UserController::class, 'user'])->name('user');
                Route::delete('/', [UserController::class, 'delete'])->name('delete');
                Route::put('edit', [UserController::class, 'edit'])->name('edit');
                Route::get('logout', [HelperAPIController::class, 'logout'])->name('logout');
            }); //auth
        }); //prefix user

        //main
        Route::prefix('main')->name('main.')->group(function () {
            //middleware auth
            Route::group(['middleware' => ['auth:api']], function () {
                Route::get('/blog/{uuid}', [PostController::class, 'getPost'])->name('get-post');
            }); //auth
        }); //prefix main


        //------------------------------------------------------
    }); //prefix v1

});