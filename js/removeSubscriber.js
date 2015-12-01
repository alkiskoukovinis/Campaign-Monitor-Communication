function removeSubscriber(removeEmail, removeID) {
	//global var for the row element(tr) that has to be removed
	table_rowID = $("#"+removeID);
	//removes the current subscriber
	//the url has get-parameters for better communication with the server.
	//To finally remove subscriber from the API,
	//we pass list id to the server
	//and subscriber's email through ajax
	//in JSON format
	//On success call successRemoveSubscribers()
	//https://api.createsend.com/api/v3.1/subscribers/{listid}/unsubscribe.json
	var dataEmail = {EmailAddress: removeEmail};
	$.ajax({						
			url: "server.php?req=removSub&list_id="+listID,
			type: "POST",
			data: dataEmail,
			success: successRemoveSubscribers					
		});
}

function successRemoveSubscribers() {
	console.log("remove succeed");
	//remove the row from the table
	$(table_rowID).remove();				
}