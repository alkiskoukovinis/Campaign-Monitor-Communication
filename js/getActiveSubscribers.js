function getActiveSubscribers() {
	//ajax-GET
	//global var, list's id
	listID = $("#tableTitle").attr("value");
	//the url has get-parameters for better communication with the server.
	//To finally get list's subscribers from the API,
	//we pass list id to the server
	//The API can send back JSON data.
	//On success call successActiveSubscribers().
	//https://api.createsend.com/api/v3.1/lists/{listid}/active.json
	$.ajax({
		url: "server.php?req=list&list_id="+listID,
		type: "GET",
		dataType: "JSON",
		success: successActiveSubscribers
	});
}			

function successActiveSubscribers(result) {
	console.log("view subscr succeed");
	//The result is in JSON format.
	//Foreach subscriber get the details.
	$.each(result, function(i, res) {
		var email = res.EmailAddress;
		var name  = res.Name;
		//global var for index i
		counter = i;
		//Create new table row.
		//Give row id = "sub"+i
		var table_row = $("<tr>").attr("id", "sub"+i).appendTo("#tableListSubscribers");
		//Every row that is added belogs to class=.data
		//and can be manipulated as a group
		$(table_row).addClass("data");
		//Create 3 new data for table row
		//Name, Email and remove button
		$("<td>").html(name).appendTo(table_row);	
		$("<td>").html(email).appendTo(table_row);
		data = $("<td>").appendTo(table_row);
		//Give to every button a class
		var removeBtn = $("<button>").addClass("removeBtn").html("x").appendTo(data);
		//Give button the same id with the row
		//in order to manipulate each sunscriber's row
		//according to the button id
		$(removeBtn).attr("id", "sub"+i);
		//Pass the subscriber's email as a value to the button
		$(removeBtn).val(email);
	});
	//onclick: if confirm/yes remove the current subscriber
	$(".removeBtn").click(function() {
		if (confirm("Are you sure?")) {
			// Pass the email and row/button id to the function
			// removeSubscriber(), which will handle the removal
			var removeEmail = $(this).val();
			var removeID =  $(this).attr("id");
			removeSubscriber(removeEmail, removeID);
		}		
	});
}