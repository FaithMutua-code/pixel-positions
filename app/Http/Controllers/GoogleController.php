<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

public function callback()
{
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::updateOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            //'avatar' => $googleUser->getAvatar(),
            'password' => bcrypt('random_password'),
        ]
    );
    if (!$user->employer) {
    $user->employer()->create([
        'name' => $user->name . "'s Company",
        'logo' => 'logos/default.png',
    ]);
    }

    Auth::login($user);

    return redirect('/');
}
}
