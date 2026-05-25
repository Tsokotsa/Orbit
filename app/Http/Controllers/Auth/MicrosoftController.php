<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function callback()
    {
        $microsoftUser = Socialite::driver('microsoft')->user();

        $user = User::where('microsoft_id', $microsoftUser->getId())->first();

        if (!$user) {
            $user = User::where('email', $microsoftUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'microsoft_id' => $microsoftUser->getId(),
                ]);
            } else {
                $user = User::create([
                    'name' => $microsoftUser->getName(),
                    'email' => $microsoftUser->getEmail(),
                    'microsoft_id' => $microsoftUser->getId(),
                    'password' => bcrypt(Str::random(16)),
                ]);
            }
        }

        auth()->login($user);

        return redirect()->route('dashboard');
        //return redirect()->route('dashboard.view');
    }
}
