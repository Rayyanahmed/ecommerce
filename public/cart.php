<?php require_once("./resources/config.php"); ?>


<?php 

if(isset($_GET['add'])) {
  // Here we are building a cap according to how many products we have on hand
  $query = query("SELECT * FROM products WHERE product_id =" . escape_string($_GET['add'] . " "));
  // Make sure query goes through
  confirm($query);

  while($row = fetch_array($query)) {
    if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
      $_SESSION['product_' . $_GET['add']] += 1;
      redirect("checkout.php");
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
    unset($_SESSION['total_quantity']);
    unset($_SESSION['item_total']);
    redirect("checkout.php");
  } else {
    redirect("checkout.php");
  }
}

// Deleting an entire product
if(isset($_GET['delete'])) {
  $_SESSION['product_' . $_GET['delete']] = '0';
   unset($_SESSION['total_quantity']);
    unset($_SESSION['item_total']);
  redirect("checkout.php");
}

function cart() {
  $total = 0;
  $_SESSION['total_quantity'] = 0;
  $item_name = 1; // Default
  $item_number = 1;
  $amount = 1;
  $quantity = 1;

  foreach ($_SESSION as $name => $value) {

    if (is_int($value) && $value > 0) {

       if(substr($name, 0, 8) == "product_") {

        $id = substr($name, 8, 2);

       $query = query("SELECT * FROM products WHERE product_id = " . $id . " ");
  confirm($query);
  while($row = fetch_array($query)) {

   $sub_total = $row['product_price'] * $value;
   // Loop through the hidden inputs to add each dataset dynamically
    $product = <<<DELIMETER
      
            <tr>
                <td>{$row['product_title']}</td>
                <td>{$row['product_price']}</td>
                <td>{$value}</td>
                <td>{$sub_total}</td>
                <td><a class="btn btn-warning" href="cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a>
                    <a class="btn btn-success" href="cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>
                    <a class="btn btn-danger" href="cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
            </tr>
       <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
       <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}"> 
       <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}"> 
       <input type="hidden" name="quantity_{$quantity}" value="{$row['product_quantity']}"> 
DELIMETER;
echo $product;
  $item_name++; // Default
  $item_number++;
  $amount++;
  $quantity++;

$_SESSION['item_total'] = $total += $sub_total;
$_SESSION['total_quantity'] += $value; 
    }
  }
    }  
  }
}

?>