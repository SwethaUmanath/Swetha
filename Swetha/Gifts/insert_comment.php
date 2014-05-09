<?php

// include function files for this application
require_once('Gifts_fns.php');

//session_start();


do_html_header("Post a comment");

 {
  if (filled_out($_POST)) {
  
  $name = $_POST['comment'];
  
  $comment = $_POST['name'];
 
  $item_id=$_POST['item_id'];
    
    
  
if(insert_comment($name, $comment, $item_id))
 {
      echo "<p>comment was added to the database.</p>";
    } else {
      echo "<p>comment was not added to the database.</p>";
    }
  } else {
    echo "<p>You have not filled out the form.  Please try again.</p>";
  }

  

do_html_url("index.php", "Back to main menu");
} 
do_html_footer();

?>
