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

    // once successfully logged in github returns the user back to this uri and 
    // the following function is called
    public function handleProviderCallback () {

        /*$array = array([            
                'repo'=>'nadeem',
                'repolink'=>'orrie'  ,          
                'commits' => [
                    'html_message'=>'hello nadeem',
                    'html_link'=>'<a>href</a>'
                    ]
                ], [            
                'repo'=>'anwar',
                'repolink'=>'adamse' ,           
                'commits' => [
                    'html_message'=>'hello anwar',
                    'html_link'=>'<a>anwar link</a>'
                    ]
                ]
            );
        $i=0;
        foreach ($array as $repo) {
            $i++;
            echo "$i repo name". $repo["repo"] . "<br><br>";
            echo "repo link". $repo["repolink"] . "<br><br>";
            echo array_get($repo,'commits.html_link');
            // foreach ($repo["commits"] as $commits) {
            //     echo "message". $commits["html_message"] . "<br><br>";
            //     echo "message". $commits["html_link"] . "<br><br>";
            // }
        }
        $repoCommitMessages = $array;*/
// dd($array);
//         dd($array);
        
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
