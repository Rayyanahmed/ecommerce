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
		$product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <img src="http://placehold.it/320x150" alt="">
        <div class="caption">
            <h4 class="pull-right">{$row['product_price']}</h4>
            <h4><a href="product.html">First Product</a>
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
            <a class="btn btn-primary" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">View Tutorial</a>
        </div>
    </div>
</div> 


DELIMETER;

echo $product;

	}
}

?>