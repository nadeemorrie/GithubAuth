<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use GuzzleHttp\Client as HttpClient;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function redirectToProvider () {
        // redirect to github login page.
       return  Socialite::driver('github')->redirect();        
    }

    // once successfully logged in github returns the user back to this uri and 
    // the following function is called
    public function handleProviderCallback () {
        // get user credentials.
        $user = Socialite::driver('github')->user();

        $client = new HttpClient();
        $res = $client->request('GET', 'https://api.github.com/repos/nadeemorrie/JunkInTheTrunk/commits/1fc3af9d43dd800312dde4d140424b22d8a0f57e');
        dd('status code',$res);

        dd($user);
        return view ('pages.commit_list.view')->with(compact('user', $user));
    }
}
