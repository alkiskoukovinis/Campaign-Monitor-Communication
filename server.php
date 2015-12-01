<?php 
//require all the API classes thta server needs
require_once "campaignmonitor-createsend-php/csrest_general.php";
require_once "campaignmonitor-createsend-php/csrest_clients.php";
require_once "campaignmonitor-createsend-php/csrest_lists.php";
require_once "campaignmonitor-createsend-php/csrest_subscribers.php";

//redirect_to and __autoload functions
require_once "functions.php";

//define api_key and cliend_id that I get by my subscription to the API
define("API_KEY", "f955097a9e86fcab60f3bbbdcf97e6b9");
define("CLIENT_ID", "df0a4e647a3d6d224f4a1cb95ed406be");


//Check if there are parameters in the server url
//If the parameter req(request) isset, we have a request from the client
//Mainly Ajax requests
$req = isset($_GET["req"]) ? $_GET["req"] : "" ;
$auth = array('api_key' => API_KEY);

//An if statement checks which action has server to perform
//according to the parameters of the url

if ($req == "viewLists") {
	//View available client's Lists
	
	//Get the appropriate wrapper to check
	//if there is the given CLIENT_ID
	$wrap_general = new CS_REST_General($auth);
	$clients = $wrap_general->get_clients();
	foreach ($clients->response as $client) {
		if (CLIENT_ID == $client->ClientID){
			$client_id = CLIENT_ID;
			break;			
		} else {
			echo "There is not such a client id!";
		}
	}
	//If client found
	if (isset($client_id)) {
		//Get the appropriate wrapper to get the available client's Lists
		$wrap_client = new CS_REST_Clients($client_id, $auth);
		$lists = $wrap_client->get_lists();
		
		//JSON manipiulation of the response
		$output = "[";
		foreach ($lists->response as $list) {
			$output .= "{\"ListID\": \"{$list->ListID}\", ";
			$output .= "\"Name\": \"{$list->Name}\"";
			$output .= "},";
		}
		//subs the last comma
		$output  = substr($output, 0, -1); 
		$output .= "]";

		echo($output); 		
	}
	
} elseif ($req == "list" && isset($_GET["list_id"])) {
	//View active subscribers from a list(list_id)
	
	$list_id = $_GET["list_id"];
	//Get the appropriate wrapper to View active subscribers
	$wrap_lists = new CS_REST_Lists($list_id, $auth);
	$active_subscribers = $wrap_lists->get_active_subscribers();
	
	//JSON manipiulation of the response
	$output = "[";
	foreach ($active_subscribers->response->Results as $subscriber) {
			$output .= "{\"EmailAddress\": \"{$subscriber->EmailAddress}\", ";
			$output .= "\"Name\": \"{$subscriber->Name}\"";
			$output .= "},";
		}
	//subs the last comma
	$output  = substr($output, 0, -1); 
	$output .= "]";
	
	echo $output;

	
	
} elseif ($req == "addSub" && isset($_GET["list_id"])) {
	//Add a new subscriber to the list
	$list_id = $_GET["list_id"];
	//Save the data that were posted by the client via ajax
	$name = $_POST["Name"];
	$email = $_POST["EmailAddress"];
	//array manipiulation of the input parameters for the API method
	$subscriber = array("EmailAddress" => $email, "Name" => $name);
	
	//Get the appropriate wrapper to add a new subscriber
	$wrap_subscribers = new CS_REST_Subscribers($list_id, $auth);
	$add_subsciber = $wrap_subscribers->add($subscriber);
	
	
	
} elseif ($req == "removSub" && isset($_GET["list_id"])) {
	//remove a subscriber
	
	$list_id = $_GET["list_id"];
	//Email is needed as an input parameter for API method
	$email   = $_POST["EmailAddress"];
	//Get the appropriate wrapper to remove a subscriber
	$wrap_subscribers = new CS_REST_Subscribers($list_id, $auth);
	$remove_subscriber = $wrap_subscribers->unsubscribe($email);
		
} else {
	echo "Please check the AJAX url";
}



 ?>

