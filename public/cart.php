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

// Removing a single product
if(isset($_GET['remove'])) {
  $_SESSION['product_' . $_GET['remove']] -= 1;
  if($_SESSION['product_'. $_GET['remove']] < 1) {
    redirect("checkout.php");
  } else {
    redirect("checkout.php");
  }
}

// Deleting an entire product
if(isset($_GET['delete'])) {
  $_SESSION['product_' . $_GET['delete']] = '0';
  redirect("checkout.php");
}

function cart() {
  $query = query("SELECT * FROM products");
  confirm($query);
  while($row = fetch_array($query)) {
    $product = <<<DELIMETER
      <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
            <tr>
                <td>{$row['product_title']}</td>
                <td>{$row['product_price']}</td>
                <td>{$row['product_quantity']}</td>
                <td>2</td>
                <td><a href="cart.php?remove={$row['product_id']}">Remove</a></td>
                <td><a href="cart.php?delete={$row['product_id']}">Delete</a></td>
            </tr>
        </tbody>
    </table>
DELIMETER;
echo $product;
  }
}

cart();

?>