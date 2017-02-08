<?
namespace App\Helper;

use Exception;

class GithubData {

	private $api;
	public function __construct() {
		var_dump("construct nadeem");
		$this->api = new ExternalApi();
	 }

	 public function test () {
	 	echo "test running";
	 }
	public function getRepos($username, $repo) {
		$url = "https://api.github.com/repos/".$username."/".$repo."/commits";
	    
	    $this->api->getRequest($url);
	}
		
}

?>