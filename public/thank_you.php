<?php require_once("./resources/config.php"); ?>
<?php require_once("cart.php") ?>
<?php include (TEMPLATE_FRONT . DS . "header.php"); ?>
<?php 

if(isset($_GET['tx'])) {
	// We can cache values as well back from get request
	$amount = $_GET['amt'];
	$currency = $_GET['cc'];
	$transaction = $_GET['tx'];
	$status = $_GET['st'];
} else {
	// If those values are set then good, otherwise redirect to index
	redirect("index.php")
}


?>


    <div class="container">
    	<h1 class="text-center">THANK YOU</h1>
    <div>



<?php include (TEMPLATE_FRONT . DS . "footer.php"); ?>