<?php require_once("./resources/config.php"); ?>
<?php require_once("cart.php") ?>
<?php include (TEMPLATE_FRONT . DS . "header.php"); ?>
<?php 

if(isset($_GET['tx'])) {
	$amount = $_GET['amt'];
	$currency = $_GET['cc'];
	$transaction = $_GET['tx'];
	$status = $_GET['st'];
	// Create a query and insert this into database, and then you can 
	// destroy your sessions so when user comes back to shopping cart there
	// is nothing left
} else {
	redirect("index.php");
}


?>


    <div class="container">
    	<h1 class="text-center">THANK YOU</h1>
    <div>



<?php include (TEMPLATE_FRONT . DS . "footer.php"); ?>