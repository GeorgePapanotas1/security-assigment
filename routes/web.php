<?php

use Illuminate\Http\Request;
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
    return view('welcome');
});

Route::group([
    'prefix' => '/auth',
    'middleware' => 'web',
], function () {

    Route::get('/login', function (){
       return view('auth.login');
    })->name('login');

//    Route::post('login', [AuthController::class, 'login']);
//    Route::post('logout', [AuthController::class, 'logout']);
//    Route::post('refresh', [AuthController::class, 'refresh']);
//    Route::get('me', [AuthController::class, 'me']);

});

Route::group([
    'prefix' => 'app',
    'middleware' => ['web'],
], function () {
    Route::get('/helloworld', function (Request $request){
        return view('protected.helloworld');
    });
});


