<?php 

// helper functions

/*********************BACK END FUNCTIONS **************************/

function set_message($msg) {
	if(!empty($msg)) {
		$_SESSION['message'] = $msg;
	} else {
		$msg = "";
	}
}

function display_message() {
	if(isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

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


/*********************FRONT END FUNCTIONS **************************/

// get products 

function get_products() {
	// using query helper function, assign query to variable
	$query = query("SELECT * FROM products");
	confirm($query);

	while($row = fetch_array($query)) {
		$product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
            <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to Cart</a>
        </div>
    </div>
</div> 


DELIMETER;

echo $product;

	}
}


function get_categories() {
// took out global $connection because query helper function takes care of that
$query = query("SELECT * FROM categories");
confirm($query);
while ($row = fetch_array($query)) {
$category_links = <<<DELIMETER
	<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;
echo $category_links;
	}
}

function get_category_products($category_id) {
	$query = query("SELECT * FROM products WHERE product_category_id = " . $category_id . "");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_links = <<<DELIMETER

   <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="{$row['product_image']}" alt="">
            <div class="caption">
                <h3>{$row['product_title']}</h3>
                <p>{$row['short_desc']}</p>
                <p>
                    <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                </p>
            </div>
        </div>
    </div>

DELIMETER;
echo $product_links;
	}
}

// Add function to get all products to display on shop page


function get_shop_products() {
	// forgot to add this query function in the query string, need to have the actual query object before fetching
	$query = query("SELECT * FROM products");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_links = <<<DELIMETER
<div class="col-md-3 col-sm-6 hero-feature">
    <div class="thumbnail">
        <img src="{$row['product_image']}" alt="">
        <div class="caption">
            <h3>{$row['product_title']}</h3>
            <p>{$row['short_desc']}</p>
            <p>
                <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
            </p>
        </div>
    </div>
</div>
DELIMETER;
echo $product_links;
	}
}

function login_user() {
	
	if(isset($_POST['submit'])) {
		$username = escape_string($_POST['username']);
		$password = escape_string($_POST['password']);

		$query = query("SELECT * FROM users WHERE username='{$username}' AND password='{$password}'");
		confirm($query);
		// this function tells us how many queries returned
		if (mysqli_num_rows($query) == 0) {
			// figure out when to use relative paths vs absolute paths
			set_message('Your password and username are wrong');
			redirect("login.php");
		} else {
			redirect("admin");
		}
	}
}


 
?>