<?php

if(isset($_POST)) {

	foreach($_POST as $key => $value) {
		
		list($ticket_id,$name) = explode(":::", $value);
		
		mysql_connect('localhost', 'MYSQL_USERNAME', 'MYSQL_USERNAME') or die(mysql_error());
		mysql_select_db('MYSQL_DB_NAME') or die(mysql_error());
		$query = "INSERT INTO `MYSQL_DB_NAME`.`MYSQL_TABLE_NAME` (`ticket_id`, `solved_by`, `date`) VALUES ('" . $ticket_id . "', '" . $name . "',  now());";

		$result = mysql_query($query);

		// Check result
		// This shows the actual query sent to MySQL, and the error. Useful for debugging.
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}	
}	

?>
