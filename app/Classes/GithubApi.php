<?php

namespace App\Classes;


use Illuminate\Support\Collection;

use Exception;
use GuzzleHttp\Client as HttpClient;

class GithubApi {

	private $client;
	private $username;
	private $repoInfo;	

	public function __construct($username) {
		$this->client = new HttpClient();
		$this->username = $username;
	}

	public function getUserInfo() {
		$this->repoInfo = $this->getRepoInfo();

        return $this->getCommitMessagesPerRepo($this->repoInfo);
	}



	private function getRequest($url) {
		try 
		{	
			// fetch data from api		
			$response = $this->client->request('GET', $url);
			
			// get data only from response body
			return json_decode($response->getBody()->getContents(), true);
		}
		catch (Exception $e)
		{
			// TODO: handle error display
			echo "Get request failed.".$e->getMessage();
			return [];
		}		
	}

	private function getRepoInfo() {
		$url = "https://api.github.com/users/".$this->username."/repos";

		// fetch raw data from api
		$repoData = $this->getRequest($url);

		// filter out the repo name from the api response
	    return $this->prepareRepoInfo($repoData);
	}

	private function getCommitMessagesPerRepo($repoInfoArray) {
		// store repo and its commits info in a collection for the view
		$repoInfo = new collection();
		$repoName="";

		foreach ($repoInfoArray as $value) {
			$repoName = array_get($value, "repo_info.name");
			$repoUrl = array_get($value, "repo_info.html_url");		

			$url = "https://api.github.com/repos/".$this->username."/".$repoName."/commits";

			// fetch raw commit info from api
			$data = $this->getRequest($url);
			
			// filter commit messages from api response and store in 
			// commitInfoTemp array
			$commitInfoTemp = $this->prepareCommitMessages($data);
			
			// repo info
			$repoInfoTemp = ['name'=>$repoName, 'html_url'=>$repoUrl];

			$allInfo = ['repo_info'=>$repoInfoTemp, 'commit_info'=>$commitInfoTemp];

			// store all data in new collection
			$repoInfo->push($allInfo);
			
	   }

	   // return data for the view
	   return $repoInfo;
	}

	private function getArrayDataByKey($array, $key) {
		if (array_has($array, $key))
			return $array[$key];

		return $key." not found";	
	}

	private function prepareRepoInfo($array) {
		if (!is_array($array))
			return [];

		$repoInfo = [];

		foreach ($array as $data) {
			$tempRepoInfo="";
			$tempRepoInfo = [
				'name'=>$this->getArrayDataByKey($data, "name"),
				'html_url'=>$this->getArrayDataByKey($data, "html_url")
				];
			$repoInfo[] = ['repo_info'=>$tempRepoInfo];
		}

		return $repoInfo;
	}

	private function prepareCommitMessages($commitMessagesArray) {
		// temporary variable to store commits array
		$tempCommitMessages = new collection($commitMessagesArray);
		
		// retun top 3 items in collection
		$tempCommitMessages->splice(3);		

		// reconstruct the commits collection with the commit message and its html url.
		$commitMessages = $tempCommitMessages->map(function($item, $key) {

			$url = $item["html_url"];
			$message = $item["commit"]["message"];			

			return ['html_url'=>$url,'commit_message'=>$message];
		});

		// convert the collection to an array and return.
		return $commitMessages->all();
	}
}
?>