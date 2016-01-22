<?php 

function redirect($location) {
	header("Location: $location");
}

function query($sql) {
	// if we want to bring in the $connection variable from our config file into
	// this function must declare global, otherwise it will create a different variable
	global $connection;
	return mysqli_query($connection, $sql)
}

function confirm($result) {
	global $connection;

	if(!$result) {
		die("Query Failed" . mysqli_error($connection));
	}
}


?>