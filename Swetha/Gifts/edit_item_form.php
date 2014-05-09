<?php

// include function files for this application
require_once('Gifts_fns.php');

session_start();


do_html_header("Edit item details");

if (check_admin_user()) {
  if ($items = get_item_details($_GET['item_id'])) {
    display_item_form($items);
  } else {
    echo "<p>Could not retrieve item details.</p>";
  }
  do_html_url("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorized to enter the administration area.</p>";
}
do_html_footer();

?>
