<?php

use App\Models\Category;
use App\Models\Order;
use App\Models\Order_Statuse;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    dd(Order::find("9967f302-8bf6-11ec-91c4-4e8ee0b7f29o")->user);
});