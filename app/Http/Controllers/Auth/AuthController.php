<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function redirectToProvider () {

       return  Socialite::driver('github')->redirect();        
    }

    public function handleProviderCallback () {
        $user = Socialite::driver('github')->user();
    }
}
