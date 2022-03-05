<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\HelperAPIController;
use App\Http\Controllers\API\OrderController;
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
    return response([], 401);
})->name('api.401');

Route::group(['middleware' => ['cors', 'json.response', 'throttle:60,1']], function () {
    Route::prefix('v1')->group(function () {
        //admin can delete a user
        Route::delete('user-delete/{uuid}', [AdminController::class, 'deleteUser'])->name('user-delete')->middleware(
            ['auth:api', 'admin']
        );
        //admin
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::post('create', [AdminController::class, 'create'])->name('create');
            Route::post('login', [AdminController::class, 'login'])->name('login');
            Route::get('logout', [HelperAPIController::class, 'logout'])->name('logout');
            //middleware auth
            Route::group(['middleware' => ['auth:api', 'admin']], function () {
                Route::get('user-listing', [AdminController::class, 'getAllNonAdmin'])->name('user-listing');
            }); //auth
        }); //prefix admin
        //user
        Route::prefix('user')->name('user.')->group(function () {
            Route::post('create', [UserController::class, 'create'])->name('create');
            Route::post('login', [UserController::class, 'login'])->name('login');
            Route::get('logout', [HelperAPIController::class, 'logout'])->name('logout');
            Route::post('forgot-password', [UserController::class, 'forgotPassword'])->name('forgot-password');
            Route::post('reset-password-token', [UserController::class, 'resetPasswordToken'])->name(
                'reset-password-token'
            );
            //middleware auth
            Route::group(['middleware' => ['auth:api', 'user']], function () {
                Route::get('/', [UserController::class, 'user'])->name('user');
                Route::delete('/', [UserController::class, 'delete'])->name('delete');
                Route::put('edit', [UserController::class, 'edit'])->name('edit');
            }); //auth - user
            //middleware auth
            Route::group(['middleware' => ['auth:api']], function () {
                //user and admin can get theirs orders
                Route::get('/orders', [UserController::class, 'orders'])->name('orders');
            }); //auth
        }); //prefix user
        //main
        Route::prefix('main')->name('main.')->group(function () {
            Route::get('/blog', [PostController::class, 'getAll'])->name('all');
            Route::get('/blog/{uuid}', [PostController::class, 'getPost'])->name('get-post');
        }); //prefix main
        //order
        Route::prefix('order')->name('order.')->group(function () {
            //middleware auth
            Route::group(['middleware' => ['auth:api']], function () {
                Route::post('/create', [OrderController::class, 'create'])->name('create');
                Route::get('/{uuid}/download', [OrderController::class, 'downloadInvoice'])->name('download');
            }); //auth
        }); //prefix order
        //orders
        Route::prefix('orders')->name('orders.')->group(function () {
            //middleware auth
            Route::group(['middleware' => ['auth:api', 'admin']], function () {
                Route::get('/', [OrderController::class, 'getAll'])->name('all');
                Route::get('/shipment-locater', [OrderController::class, 'getAllShipment'])->name('all-shipment');
                Route::get('/dashboard', [OrderController::class, 'getAll'])->name('dashboard');
            }); //auth
        }); //prefix orders
        //file
        Route::prefix('file')->name('file.')->group(function () {
            //middleware auth
            Route::group(['middleware' => ['auth:api']], function () {
                Route::post('/upload', [FileController::class, 'upload'])->name('upload');
            }); //auth
            Route::get('/{uuid}', [FileController::class, 'getFile'])->name('get-file');
        }); //prefix file
        //------------------------------------------------------
    }); //prefix v1
});
