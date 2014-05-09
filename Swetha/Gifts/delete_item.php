<?php

// include function files for this application
require_once('GiftShop_fns.php');
session_start();

do_html_header("Deleting Item");
if (check_admin_user()) {
  if (isset($_POST['Code'])) {
    $Code = $_POST['code'];
    if(delete_item($code)) {
      echo "<p>Item ".$code." was deleted.</p>";
    } else {
      echo "<p>Item ".$code." could not be deleted.</p>";
    }
  } else {
    echo "<p>We need a code to delete item.  Please try again.</p>";
  }
  do_html_url("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorised to view this page.</p>";
}

do_html_footer();

?>
