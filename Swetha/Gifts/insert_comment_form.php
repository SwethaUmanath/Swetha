<?php

// include function files for this application
require_once('Gifts_fns.php');

//session_start();


do_html_header("Post Comment");

 {
 
 
display_comment_form();
  



do_html_url("admin.php", "Back to administration menu");
} 

do_html_footer();

?>
