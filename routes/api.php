<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function(){

Route::group(['middleware' => ['web']], function(){
    // Google login route
    // socialite register
    // Route::get('/{provider}/register/redirect', function($provider){
    //     return Socialite::driver($provider)->redirect();
    // })->name('social.register');

    // Route::get('/{provider}/register/callback', function($provider){
    //     try {
    //         $user = Socialite::driver($provider)->user();
    //         dd($user);
    //     } catch (\Exception $er) {
    //         dd($er);
    //     };
    // });
});

});