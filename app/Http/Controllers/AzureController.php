<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;


use Illuminate\Http\Request;

class AzureController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('azure')->redirect();
    }
}
