<?php 

// helper functions

function redirect($location) {
	header("Location: $location");
}

function query($sql) {
	// if we want to bring in the $connection variable from our config file into
	// this function must declare global, otherwise it will create a different variable
	global $connection;
	return mysqli_query($connection, $sql);
}

function confirm($result) {
	global $connection;

	if(!$result) {
		die("Query Failed" . mysqli_error($connection));
	}
}


// This will prevent sql injections
function escape_string($string) {
	global $connection;
	return mysqli_real_escape_string($connection, $string);
}


function fetch_array($result) {
	return mysqli_fetch_array($result);
}

// get products 

function get_products() {
	// using query helper function, assign query to variable
	$query = query("SELECT * FROM products");
	confirm($query);

	while($row = fetch_array($query)) {
		echo $row['product_price'];
	}
}

?>