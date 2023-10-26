<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class oAuthController extends Controller
{
    /**
     * O-auth redirect
     */
    public function oauthRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * O-auth callback handle
     */
    public function handleCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            // dd($socialUser);

            // if (User::where('email', $socialUser->email)->exists()) {
            //     return redirect()->back()->withErrors(['email' => 'This user have different method to log in.']);
            // }

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $socialUser->id
            ])->exists();

            // Create new user
            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'avatar' => $socialUser->avatar,
                    'username' => User::generateUsername($socialUser->nickname),
                    'email_verified_at' => now(),
                    'provider' => $provider,
                    'provider_id' => $socialUser->id,
                    'provider_token' => $socialUser->token,
                ]);
            }else{
                $user =User::where([
                    'provider' => $provider,
                    'provider_id' => $socialUser->id
                ])->first();
            }

            Auth::login($user);
            return redirect('/dashboard');
        } catch (\Exception $er) {
            return $er;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        //
    }
}
