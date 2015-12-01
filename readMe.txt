ReadMe

Client side (htlm/js/php): 
	- client_index.php
	- list_page.php
	
Server Side (php):
	-server.php
	
	
- The first page is the "client_index.php" (welcome page), where there is a button that asks to list all the available client's lists. By clicking on the button ajax/javascript brings each list. By clicking a list the app redirects to "list_page.php"?list_name&list_id.....

- After the redirection the app presentates, via ajax/javascrip, the corresponding list's subscribers in a table (Name, Email,Remove). There is also a button that generates a form (form with no action or method) which helps to add a new subscriber on the list, again via ajax/javascrip. The x-button represents the remove action which also uses ajax/javascrip.

- JS folder contains all the required javascript files

- The "server.php" manipulates all the ajax requests and communicates with the API using its classes/libraries

- As an editor I used Notepad++ and the wep app was deployed locally in WAMP


There are also comments inside the code files.
For further info do not hesitate to contact me.

Alkis Koukovinis
7/11/2015