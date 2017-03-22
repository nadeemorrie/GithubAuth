<?php

namespace App\Classes\Github;

// system classes
use Illuminate\Support\Collection;
use Exception;

// custom interface
use App\Classes\Interfaces;

class GithubProfile {

	private $client;	

	public function __construct($client) {				
		$this->client = $client;
	}

	public function getRepoData($username) {
		$url = "https://api.github.com/users/".$username."/repos";

		// fetch raw data from api
		$repoRawData = $this->client->getRequest($url);

		// filter out the repo name from the api response
	    $repoInfo = $this->getRepoInfo($repoRawData);

	    return $this->getRepoCommitInfo($repoInfo, $username);
	}

	private function getRepoCommitInfo($repoInfoArray, $username) {
		// store repo and its commits info in a collection for the view
		$allRepoInfo = new collection();
		$repoName="";

		foreach ($repoInfoArray as $value) {
			$repoName = array_get($value, "repo_info.name");
			$repoUrl = array_get($value, "repo_info.html_url");		

			$url = "https://api.github.com/repos/".$username."/".$repoName."/commits";

			// fetch raw commit info from api
			$data = $this->client->getRequest($url);
			
			// filter commit messages from api response and store in 
			// commitInfoTemp array
			$commitInfoTemp = $this->prepareCommitMessages($data);
			
			// repo info
			$repoInfoTemp = ['name'=>$repoName, 'html_url'=>$repoUrl];

			$allInfo = ['repo_info'=>$repoInfoTemp, 'commit_info'=>$commitInfoTemp];

			// store all data in new collection
			$allRepoInfo->push($allInfo);
			
	   }

	   // return data for the view
	   return $allRepoInfo;
	}

	private function getArrayDataByKey($array, $key) {
		if (array_has($array, $key))
			return $array[$key];

		return $key." not found";	
	}

	private function getRepoInfo($array) {
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
		
		// return top 3 items in collection
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