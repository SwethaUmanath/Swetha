<?php
  include ('Gifts_fns.php');
 
 // The shopping cart needs sessions, so start one
  //session_start();

 
 $item_id = $_GET['item_id'];

  
// get this book out of database
 
 $items = get_item_details($item_id);
 
 do_html_header($items['item_name']);
 
 display_item_details($items);
 $num=$_GET['item_id'];


display_comment_form();
$com_array=get_comments($num);
display_comments($com_array);



// set url for "continue button"
  
$target = "index.php";
  
if($items['id']) 
{
    $target = "show_cat.php?id=".$items['id'];
 

 }

 
 // if logged in as admin, show edit book links
 
 if (check_admin_user()) 

{
    display_button("edit_item_form.php?item_id=".$item_id, "edit-item", "Edit Item");
 
   display_button("admin.php", "admin-menu", "Admin Menu");
   
 display_button($target, "continue", "Continue");
  
} 
else
 {
      
 display_button($target, "back", "Back");
  }

 
 do_html_footer();

?>
