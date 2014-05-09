<?php
  include ('Gifts_fns.php');
 
 // The shopping cart needs sessions, so start one
  session_start();

 
 $id = $_GET['id'];
 
 $name = get_category_name($id);

 
 do_html_header($name);

 
 // get the book info out from db
 
 $item_array = get_items($id);


  display_items($item_array);


  
// if logged in as admin, show add, delete book links
  
if(isset($_SESSION['admin_user'])) 
{
    display_button("index.php", "continue", "Continue Shopping");
   
 display_button("admin.php", "admin-menu", "Admin Menu");
  
  display_button("edit_category_form.php?id=".$id,
 "edit-category", "Edit Category");
  } else {
    display_button("index.php", "continue-shopping", "Continue Shopping");
  }

  do_html_footer();
?>
