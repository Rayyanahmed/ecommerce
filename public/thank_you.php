<?php require_once("./resources/config.php"); ?>
<?php require_once("cart.php") ?>
<?php include (TEMPLATE_FRONT . DS . "header.php"); ?>
<?php 

if(isset($_GET['tx'])) {
	// Paypal will send a GET request back if transaction works
}


?>


    <div class="container">
    	<h1 class="text-center">THANK YOU</h1>
    <div>



<?php include (TEMPLATE_FRONT . DS . "footer.php"); ?>