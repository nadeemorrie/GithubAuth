<?php
namespace App\Classes\Api;

// system classes
use Exception;
use GuzzleHttp\Client;

class HttpClient {

	private $client;

	public function __construct () {
		// instanctiate a new GuzzleHttp Client object
		$this->client = new Client();
	}

	public function getRequest($url) {
		try 
		{	
			// fetch data from api		
			$response = $this->client->request('GET', $url);
			
			// get data only from response body
			return json_decode($response->getBody()->getContents(), true);
		}
		catch (Exception $e)
		{
			return "Get request failed: ".$e->getMessage();;
		}		
	}

}
?>