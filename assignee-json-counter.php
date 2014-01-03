<?php

	$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default

	mysql_connect('localhost', 'MYSQL_USERNAME', 'MYSQL_USERNAME') or die(mysql_error());
	mysql_select_db('MYSQL_DB_NAME') or die(mysql_error());

	$query = "SELECT assigned_to,COUNT(`assigned_to`) as cnt FROM `MYSQL_TABLE_NAME` where date=curdate() Group by assigned_to order by count(`assigned_to`) desc";

	$result = mysql_query($query);

	// Check result
	// This shows the actual query sent to MySQL, and the error. Useful for debugging.
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}

	$arr=array();

	while ($row = mysql_fetch_array($result)) {
		$arr[]=array('name'=>$row['assigned_to'],'value'=>$row['cnt']);
	}


	if($format == 'json') {
		header('Content-type: application/json');
		echo '{"leaderboard": ' . json_encode($arr) . '}';
	}

?>
