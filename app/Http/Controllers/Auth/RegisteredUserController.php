<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required_without:mobile', 'nullable', 'string', 'email', 'max:255', 'unique:' . User::class],
            'mobile' => ['required_without:email', 'nullable', 'string', 'numeric', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Send the appropriate verification notification
        if ($request->email && $request->mobile) {
            return redirect()->intended('/dashboard');
        } elseif (!$request->email && $request->mobile) {
            return redirect()->route('mobile.verification.notice');
        } elseif ($request->email && !$request->mobile) {
            return redirect()->route('verification.notice');
        } else {
            return redirect()->route('dashboard');
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
