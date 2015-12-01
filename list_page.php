<?php
//redirect_to and __autoload functions
require_once("functions.php"); 
?>

<?php
//If the get-parameters are given hold them
//else redirect to the welcome page(client_index.php)
if (isset($_GET["list_name"]) && isset($_GET["list_id"])) {
	$list_name = $_GET["list_name"];
	$list_id   = $_GET["list_id"];
	
} else {
	redirect_to("client_index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title>List Page</title>
		
		<script src="js/jquery-1.11.3.js"></script>
		<script src="js/getActiveSubscribers.js"></script>
		<script src="js/addSubscribers.js"></script>
		<script src="js/removeSubscriber.js"></script>
		<script>
		
			$("document").ready(function() {
				//Hide/Show Form
				$("#addSubscriForm").hide();
				formStyle();
				//getActiveSubscribers(), populates the page with 
				//list's active subscribers
				getActiveSubscribers();	
				//addSubscribers(), waits for a click 
				//to add new subscribers.
				//Both send ajax requests
				addSubscribers();
				//Refreshes the list, calls the getActiveSubscribers() again
				refresh();
			});
			
			
			
			function formStyle() {
				//Hide/Show Form
				//if show onclick hide
				//or if hide onclick show
				$("#name").val("");
				$("#email").val("");
				$("#addBtn").click(function() {
					if ($("#addSubscriForm").attr("class")=="show") {
						$("#addSubscriForm").removeClass("show");
						$("#addSubscriForm").hide();
						$("#addBtn").html("+");
					} else {
						$("#addSubscriForm").show();
						$("#addSubscriForm").addClass("show");
						$("#addBtn").html("-");
					}					
				});
			}
			function refresh() {
				$("#refreshBtn").click(function() {
					$(".data").remove();
					getActiveSubscribers();	
				});
			}
		</script>
		
	</head>
	
	<body>
		<!-- -->
		<!-- Header is the name of the list -->
		<h2><?php echo "[". $list_name . "] "; ?> Page</h2>	
		<button type="button" id="refreshBtn">Refresh List</button>
		<br/><br/>
		<!-- Table that contains the subscribers of the list -->
		<!-- Name, Email Address and a remove subscriber button -->
		<!-- Pass to the table an attr value equla to the list's id -->
		<table id="tableListSubscribers">
			<tr>
				<th id="tableTitle" value="<?php echo $list_id; ?>"><?php echo $list_name; ?></th>
			</tr>
			<tr>
				<th>Name</th>
				<th>Email Address</th>
				<th>Remove</th>
			</tr>
		</table>
		
		<br/>
		<br/>
		<!-- button that shows/hides the form -->
		<button type="button" id="addBtn">+</button>
		
		<br/>
		<br/>
		<!-- Form to add a new subscriber -->
		<!-- There is not type=submit button because the post action -->
		<!-- will be done dynamically by ajax by clicking the addSubscriBtn -->		
		<form id="addSubscriForm">
			Name: <input type="text" id="name" name="name"></input> 
			<br/>
			Email: <input type="text" id="email" name="email"></input> 
			
			<!-- -->
			<div class="errors"></div>
			<button type="button" id="addSubscriBtn" >Add Subscriber</button>
			
		</form>	
		
		
		
	</body>
</html>