<?php

// include function files for this application
require_once('Gifts_fns.php');

//session_start();


do_html_header("Adding a category");

if (check_admin_user()) 
{
  if (filled_out($_POST))   
{
    $name = $_POST['name'];
 
     $id= $_POST['id']; 
     $description= $_POST['description'];
 
 if(insert_category($name,$id,$description)) 

{
      echo "<p>Category \"".$name."\" has been added to the database.</p>";
    } else {
      echo "<p>Category \"".$name."\" could not be added to the database.</p>";
    }
  } else {
    echo "<p>You have not filled out the form.  Please try again.</p>";
  }
  do_html_url('admin.php', 'Back to administration menu');
} else {
  echo "<p>You are not authorised to view this page.</p>";
}

do_html_footer();

?>
