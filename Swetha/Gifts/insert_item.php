<?php

// include function files for this application

require_once('Gifts_fns.php');

//session_start();



do_html_header("Adding an item");

if (check_admin_user()) 
{
 
 if (filled_out($_POST)) 
{
  
  $item_id = $_POST['item_id'];
  
  $item_name = $_POST['item_name'];
 
   $Item_desc = $_POST['Item_desc'];
  
  $price = $_POST['price'];
 
  $id = $_POST['id']; 
    
  
if(insert_item($item_id, $item_name, $Item_desc,  $price, $id))
 {
      echo "<p>Item <em>".stripslashes($item_name)."</em> was added to the database.</p>";
    } else {
      echo "<p>Item <em>".stripslashes($item_name)."</em> could not be added to the database.</p>";
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
