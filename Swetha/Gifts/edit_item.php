<?php

// include function files for this application

require_once('Gifts_fns.php');

session_start();


do_html_header("Updating Item");

if (check_admin_user()) 
{
  if (filled_out($_POST)) {
    $olditem_id = $_POST['olditem_id'];
   
 $item_id = $_POST['item_id'];
  
$item_id = $_POST['item_id'];
 $item_name = $_POST['item_name'];

$item_desc = $_POST['item_desc'];
  
$id = $_POST['id'];
  
$price = $_POST['price'];
  
$item_id = $_POST['item_id'];

   
 if(update_item($olditem_id, $item_id, $item_name, $item_desc, $id, $price, $item_desc)) {
      echo "<p>Item was updated.</p>";
    } else {
      echo "<p>Item could not be updated.</p>";
    }
  } else {
    echo "<p>You have not filled out the form.  Please try again.</p>";
  }
  do_html_url("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorised to view this page.</p>";
}

do_html_footer();

?>
