<?php

namespace App\Classes;


use Illuminate\Support\Collection;

use Exception;
use GuzzleHttp\Client as HttpClient;

class ExternalApi {

	private $client;

	public function __construct() {
		$this->client = new HttpClient();
	}

	private function getRequest($url) {
		try 
		{			
			$response = $this->client->request('GET', $url);
	
			return json_decode($response->getBody()->getContents(), true);
		}
		catch (Exception $e)
		{
			// TODO: handle error display
			echo "Get request failed.".$e->getMessage();
			return [];
		}		
	}

	public function getRepoNames($username) {
		$url = "https://api.github.com/users/".$username."/repos";

		$data = $this->getRequest($url);

	    return $this->getRepoNamesArray($data);
	}

	public function getCommits($repoArray, $username) {
		$repo = $repoArray[0];

		$url = "https://api.github.com/repos/".$username."/".$repo."/commits";

		$data = $this->getRequest($url);

	   	return $this->getCommitsCollection($data);
	}

	private function getArrayDataByKey($array, $key) {
		if (array_has($array, $key))
			return $array[$key];

		return $key." not found";	
	}

	private function getRepoNamesArray($array) {
		if (!is_array($array))
			return [];

		$repoNames = [];

		foreach ($array as $data) {
			$repoNames[] = $this->getArrayDataByKey($data, "name");
		}

		return $repoNames;
	}

	private function getCommitsCollection($commitsArray) {

		
		$collection = new collection($commitsArray);
		

		$collection->splice(3);
		$plucked = $collection->pluck('commit.message');
		dd('collection plucked', $plucked);
		// if (!is_array($repoArray))
		// 	return [];

		// $repoNames = new collection([]);

		// foreach ($repoArray as $data) {
		// 	$repoNames->put('repoName',$this->getArrayDataByKey($data, "name"));
		// }

		// return $repoNames->all();
	}
}
?>