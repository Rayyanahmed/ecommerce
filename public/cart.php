<?php require_once("./resources/config.php"); ?>


<?php 
// First thing incoming is the GET request

if(isset($_GET['add'])) {
  $_SESSION['product_' . $_GET['add']] += 1;
}
echo $_SESSION['product_1'];

?>