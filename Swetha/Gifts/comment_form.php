<?php

// include function files for this application
require_once('Gifts_fns.php');

//session_start();


do_html_header("Add comment");


 
 
display_comment_form($name,$comment);
  



do_html_url("comment.php", "Add Comment");
} 


?>
