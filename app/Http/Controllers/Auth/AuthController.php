<?php

namespace App\Http\Controllers\Auth;

// System Classes
use Socialite;
use App\Http\Controllers\Controller;

// Custom Classes
use App\Classes\Api\HttpClient;
use App\Classes\Github\GithubProfile;

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
        
        // instantiate a new guzzle http client to handle all api calls
        $client = new HttpClient();

        // get api call data
        $gitUserInfo  = (new GithubProfile($client))->getRepoData($username);        

        return view ('pages.commit_list.view')
                ->with(compact('gitUserInfo', 'username'));                
    }
}
