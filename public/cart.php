<?php require_once("./resources/config.php"); ?>


<?php 
// First thing incoming is the GET request

if(isset($_GET['add'])) {
  // Here we are building a cap according to how many products we have on hand
  $query = query("SELECT * FROM products WHERE product_id =" . escape_string($_GET['add'] . " "));
  // Make sure query goes through
  confirm($query);

  // $_SESSION['product_' . $_GET['add']] += 1;
  // redirect("index.php");
}


?>