function addSubscribers() {
	//onclick: ajax-POST
	$("#addSubscriBtn").click(function() {
		//Validate the form data
		//check if data are not empy
		//or email has correct email format
		if (formValidated()) {
		
		//increases by 1 the global counter
		counter++;
		addName  = $("#name").val();
		addEmail = $("#email").val();
		var jsonData = {Name: addName, EmailAddress: addEmail};
		//the url has get-parameters for better communication with the server.
		//To finally add subscriber to the API,
		//we pass list id to the server
		//and subscriber's details through ajax
		//in JSON format
		//The API can send back a string
		//On success call successAddSubscribers()
		//https://api.createsend.com/api/v3.1/subscribers/{listid}.json
		$.ajax({						
			url: "server.php?req=addSub&list_id="+listID,
			type: "POST",
			data: jsonData,
			success: successAddSubscribers					
		});
		}
	});
}			
			
function successAddSubscribers() {
	console.log("success");
	//empty the input boxes
	$("#name").val("");
	$("#email").val("");
	//Create new table row.
	//Give row id = "sub"+i
	var table_row = $("<tr>").attr("id", "sub"+counter).appendTo("#tableListSubscribers");
	//Every row that is added belogs to class=.data
	//and can be manipulated as a group
	$(table_row).addClass("data");
	//Create 3 new data for table row
	//Name, Email and remove button
	$("<td>").html(addName).appendTo(table_row);	
	$("<td>").html(addEmail).appendTo(table_row);
	var data = $("<td>").appendTo(table_row);
	//Give to every button a class
	var removeBtn = $("<button>").addClass("removeBtn").html("x").appendTo(data);
	//Give button the same id with the row
	//in order to manipulate each sunscriber's row
	//according to the button id
	//Pass the subscriber's email as a value to the button
	$(removeBtn).attr("id", "sub"+counter);
	$(removeBtn).val(addEmail);
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


function formValidated() {
	$(".errors div").remove();
	if ($("#name").val()=="" || $("#email").val()=="") {
		$("<div>").html("Name/Email Not valid input!").appendTo(".errors");
		return false;
	} else if (!isEmail($("#email").val())){
		$("<div>").html("Not an email, ex: example@bod.fi!").appendTo(".errors");
		return false;
	} else {
		return true;
	}
}

function isEmail(email) {
	//email template
	var template = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return template.test(email);
}