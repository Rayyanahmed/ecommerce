<?php require_once("./resources/config.php"); ?>


<?php 
// First thing incoming is the GET request

if(isset($_GET['add'])) {
  // Here we are building a cap according to how many products we have on hand
  $query = query("SELECT * FROM products WHERE product_id =" . escape_string($_GET['add'] . " "));
  // Make sure query goes through
  confirm($query);

  while($row = fetch_array($query)) {
    if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
      $_SESSION['product_' . $_GET['add']] += 1;
    } else {
      set_message("We only have " . $row['product_quantity'] . " available");
      redirect("checkout.php");
    }
  }

}

if(isset($_GET['remove'])) {
  $_SESSION['product_' . $_GET['remove']] -= 1;
  if($_SESSION['product_'. $_GET['remove']] < 1) {
    redirect("checkout.php");
  } else {
    redirect("checkout.php");
  }
}


if(isset($_GET['delete'])) {
  $_SESSION['product_' . $_GET['delete']] = 0;
  redirect("checkout.php");
}

?>