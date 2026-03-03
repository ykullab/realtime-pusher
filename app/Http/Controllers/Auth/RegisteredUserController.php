<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewUserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\NewUseRegisteredNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Notifications\Notification;

class RegisteredUserController extends Notification
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
         $admin = User::find(1);

     
         $admin->notify(new NewUseRegisteredNotification($user));
        return redirect(RouteServiceProvider::HOME);

        //Brodcast Event
         

        //  NewUserRegisteredEvent::dispatch();
           Broadcast(new NewUserRegisteredEvent());
    }
}
