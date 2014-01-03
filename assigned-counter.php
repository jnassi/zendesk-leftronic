<?php

require('db_config.php');
$mysql_table = "zendesk_assigned";

if(isset($_POST)) {

	foreach($_POST as $key => $value) {
		
		list($ticket_id,$name) = explode(":::", $value);
		
		mysql_connect($mysql_host, $mysql_username, $mysql_password) or die(mysql_error());
		mysql_select_db($mysql_db) or die(mysql_error());
		$query = "INSERT INTO `$mysql_db`.`$mysql_table` (`ticket_id`, `assigned_to`, `date`) VALUES ('" . $ticket_id . "', '" . $name . "',  now());";

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


