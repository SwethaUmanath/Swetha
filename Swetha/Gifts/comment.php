<?php
 require_once('Gifts_fns.php');
 

session_start();


 do_html_header("Write a review for this item");
 


 //display_Comment_form();


 display_button("index.php", "save", "Add Comment");
 do_html_url("index.php", "Back to categories");

 do_html_footer();
?>
