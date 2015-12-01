<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title>Welcome</title>
		
		<script src="js/jquery-1.11.3.js"></script>	
		<script src="js/getClientsLists.js"></script>		
		<script>
			//Onclick a ajax-GET-JSON will be called.
			//If ajax succeed the html table will be filled 
			//by client's lists
			$("document").ready(function() {	
				$("#getListsBtn").click(function() {
					getClientsLists();
				});				
			});	

		</script>		
	</head>
	
	<body>
		<h2>Welcome to Lists Menu</h2>
		<!-- -->
		<!-- Table that will be populated with the names -->
		<!--  of the existing lists by using ajax GET method -->
		<table id="tableLists">
			<tr>
				<th></th>
			</tr>
		</table>
		
		<br/><br/>
		
		<button type="button" id="getListsBtn">get Lists</button>
	</body>
</html>