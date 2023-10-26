<?php

use App\Http\Controllers\Auth\oAuthController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Chat;
use App\Livewire\Component\Chatbox;
use Illuminate\Support\Facades\Route;
use Stephenjude\PaymentGateway\Facades\PaymentGateway;
use Stephenjude\PaymentGateway\Providers\Pay4meProvider;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// ## AUTHENTICATION ROUTES 

// Social auth register/login 
Route::controller(oAuthController::class)->group(function () {
    // o-Auth redirect
    Route::get('/o-auth/redirect/{provider}', 'oauthRedirect')->name('auth.social.call')->where('provider', 'google|github');
    // o-auth callback
    Route::get('/o-auth/callback/{provider}', 'handleCallback')->name('auth.social.callback');
});

// breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ## Live wire live chat
Route::prefix('/live-wire-chat')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        // liveWire chat home
        Route::get('/', function () {
            return view('chat.livewire-chat.chat');
        })->name('wire.chat.home');

        // chat with user
        // Route::get('/{id}', Chat::class)->name('wire.chat.box');
        Route::get('/{id}', function ($id) {
            return view('chat.livewire-chat.chat', compact('id'));
        })->name('wire.chat.box');

    });

// ## payment gateway
Route::prefix('/payment')->group(function () {
    // Laravel payment gateway 
    Route::get('/multi-pay', function () {
        PaymentGateway::make('stripe');
    });
});











require __DIR__ . '/auth.php';
