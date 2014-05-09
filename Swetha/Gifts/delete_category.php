<?php

// include function files for this application
require_once('Gifts_fns.php');

//session_start();


do_html_header("Deleting category");

if (check_admin_user()) 
{
  if (isset($_POST['id']))
 {
 if(delete_category($_POST['id'])) 
{
      echo "<p>Category was deleted.</p>";
    }
 else {
  echo "<p>Category could not be deleted.<br />
  This is usually because it is empty.</p>";
  } }
else {
    echo "<p>No category specified.  Please try again.</p>";
  }
  
do_html_url("admin.php", "Back to administration menu");
} 
else {
  echo "<p>You are not authorised to view this page.</p>";

}

do_html_footer();

?>
