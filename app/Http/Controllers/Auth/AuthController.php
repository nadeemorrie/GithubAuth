<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Classes\GithubApi;


use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function redirectToProvider () {
        // redirect to github login page.
       return  Socialite::driver('github')->redirect();        
    }

    // once successfully logged in, github will call this function.
    // via the Authorization callback URL.
    public function handleProviderCallback () {
        
        // get github user credentials.
        $response = Socialite::driver('github')->user();
        
        $username = $response->getNickname();        
        
        // prepare api calls
        $github = new GithubApi($username);

        $gitUserInfo = $github->getUserInfo();

        return view ('pages.commit_list.view')
                ->with(compact('gitUserInfo', 'username'));                
    }
}
