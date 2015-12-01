function getClientsLists() {
	//the url has get-parameters for better communication with the server.
	//To finally get lists from the API
	//we pass client id to the server
	//The client id is defined to the server side
	//The API can send back JSON data.
	//On success call successClientsLists().
	//https://api.createsend.com/api/v3.1/clients/{clientid}/lists.json
	$.ajax({					
		url: "server.php?req=viewLists",
		type: "GET",
		dataType: "JSON",
		success: successClientsLists
	});
}			
function successClientsLists(result){
	//Show the title of the table.
	$("th").html("Name of Lists");
	//The result is in JSON format.
	//Foreach list get the details.
	$.each(result, function(i, res){
		var listName = res.Name;
		var listID   = res.ListID;	
		//Create new table row.
		var table_row = $("<tr>").appendTo("#tableLists");
		table_row     = $("<td>").appendTo(table_row);
		//Create new data for table row
		//and fill it with links <a>
		//that will have as href a new page, the list page,
		//where we can view the content of the list.
		//List name and id are passed as get-parameters.
		$("<a>").attr("href","list_page.php?list_name="+listName+"&list_id="+listID).html(listName).appendTo(table_row);					
		//links to list_page.php?list_name="+listName+"&list_id="+listID			
	});
}