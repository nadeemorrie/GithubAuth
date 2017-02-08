<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Classes\ExternalApi;


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
        $response = Socialite::driver('github')->user();
        // dd('nickname', $user->getNickname(), 'name', $user->getName());
        $username = $response->getNickname();
           
        $api = new ExternalApi();
        $repoNames = $api->getRepoNames($username);
        $data = $api->getCommits($repoNames, $username);
       
        return view ('pages.commit_list.view')->with(compact('user', $data));
    }
}
