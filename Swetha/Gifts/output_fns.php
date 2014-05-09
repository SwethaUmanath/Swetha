<?php
session_start();
function do_html_header($item_name = '') {
  // print an HTML header
    
  // declare the session variables we want access to inside the function
  if (!$_SESSION['items']) {
    $_SESSION['items'] = '0';
  }
  
?>
  <html>
  <head>
  
    <title><?php echo $item_name; ?></title>
    <style>
      h2 { font-family: Arial, Helvetica, sans-serif; font-size: 22px; color: Red; margin: 6px }
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      hr { color: #FF0000; width=70%; text-align=center}
      a { color: #000000 }
    </style>
  </head>
  <body bgcolor="#FFE4C4">
  
  <tr>
  <td rowspan="2">
  <a href="index.php"><img src="gift.jpg" alt="Gifts" border="0"
       div align="center"  height="100" width="150"/></a>
  </td>
  <td align="right" valign="bottom">
  <?php
     if(isset($_SESSION['admin_user'])) {
       echo "&nbsp;";
     } else {
       //echo "Total Items = ".$_SESSION['items'];
     }
  ?>
  </td>
  <td align="right" rowspan="2" width="135">
  <?php
     if(isset($_SESSION['admin_user'])) {
       display_button('logout.php', 'log-out', 'Log Out');
     } else {
       //display_button('show_cart.php', 'view-cart', 'View Your Shopping Cart');
     }
  ?>
  </tr>
  <tr>
  <td align="right" valign="top">
  <?php
     if(isset($_SESSION['admin_user'])) {
       echo "&nbsp;";
     } else {
       //echo "Total Price = $".number_format($_SESSION['total_price'],2);
     }
  ?>
  </td>
  </tr>
  </table>
<?php
  if($item_name) {
    do_html_heading($item_name);
  }
}

function do_html_footer() {
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

function do_html_heading($heading) {
  // print heading
?>
  <h2><?php echo $heading; ?></h2>
<?php
}

function do_html_URL($url, $name) {
  // output URL as link and br
?>
  <a href="<?php echo $url; ?>"><?php echo $name; ?></a><br />
<?php
}

function display_categories($cat_array) {
  if (!is_array($cat_array)) {
     echo "<p>No categories currently available</p>";
     return;
  }
  echo "<ul>";
  foreach ($cat_array as $row)  {
    $url = "show_cat.php?id=".$row['id'];
    $item_name = $row['name'];
    echo "<li>";
    do_html_url($url, $item_name);
    echo "</li>";
  }
  echo "</ul>";
  echo "<hr />";
}

function display_items($item_array) {
  //display all books in the array passed in
  if (!is_array($item_array)) {
    echo "<p>No items currently available in this category</p>";
  } else {
    //create table
    echo "<table width=\"100%\" border=\"0\">";

    //create a table row for each book
    foreach ($item_array as $row)
 {
      $url = "show_item.php?item_id=".$row['item_id'];
      echo "<tr><td>";
      if (@file_exists("images/".$row['item_id'].".jpg")) {
        $item_name = "<img src=\"images/".$row['item_id'].".jpg\"
                  style=\"border: 1px solid black\"/>";
        do_html_url($url, $item_name);
      } else {
        echo "&nbsp;";
      }
      echo "</td><td>";
      $item_name = $row['item_id']." - ".$row['item_name'];
      do_html_url($url, $item_name);
      echo "</td></tr>";
    }

    echo "</table>";
  }

  echo "<hr />";
}

function display_item_details($items) {
  // display all details about this book
  if (is_array($items)) {
    echo "<table><tr>";
    //display the picture if there is one
    if (@file_exists("images/".$items['item_id'].".jpg"))  {
      $size = GetImageSize("images/".$items['item_id'].".jpg");
      if(($size[0] > 0) && ($size[1] > 0)) {
        echo "<td><img src=\"images/".$items['item_id'].".jpg\"
              style=\"border: 1px solid black\"/></td>";
      }
    }
    echo "<td><ul>";
    echo "<li><strong>Name:</strong> ";
    echo $items['item_name'];
    echo "</li><li><strong>Item:</strong> ";
    echo $items['item_id'];
    echo "</li><li><strong>Our Price:</strong> ";
    echo number_format($items['price'], 2);
    echo "</li><li><strong>Description:</strong> ";
    echo $items['Item_desc'];
    echo "</li></ul></td></tr></table>";
  } else {
    echo "<p>The details of this item cannot be displayed at this time.</p>";
  }
  echo "<hr />";
}



function display_login_form() {
  // dispaly form asking for name and password
?>
 <form method="post" action="admin.php">
 <table bgcolor="#5F9EA0">
   <tr>
     <td>Username:</td>
     <td><input type="text" name="username"/></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type="password" name="passwd"/></td></tr>
   <tr>
     <td colspan="2" align="center">
     <input type="submit" value="Log in"/></td></tr>
   <tr>
 </table></form>
<?php
}

function display_admin_menu() {
?>
<br />
<a href="index.php">Go to main site</a><br />
<a href="insert_category_form.php">Add a new category</a><br />
<a href="insert_item_form.php">Add a new item</a><br />
<a href="change_password_form.php">Change admin password</a><br />
<?php
}

function display_button($target, $image, $alt) {
  echo "<div align=\"center\"><a href=\"".$target."\">
          <img src=\"images/".$image.".gif\"
           alt=\"".$alt."\" border=\"0\" height=\"50\"
           width=\"135\"/></a></div>";
}

function display_form_button($image, $alt) {
  echo "<div align=\"center\"><input type=\"image\"
           src=\"images/".$image.".png\"
           alt=\"".$alt."\" border=\"0\" height=\"50\"
           width=\"135\"/></div>";
}



function display_comment_form() 
{
// displays html change password form
?>
   <br />
   <form  action="insert_comment.php" method="post" >
 
  <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
           <tr><td>Name</td>
 <td><input type="text" name="name" size="16" maxlength="16" /></td>
   </tr>
   
<tr><td>Comment:</td>
 <td><input type="text" name="comment" size="25" maxlength="20" /></td>
   </tr>

<tr><td>Item ID:</td>
       <td><input type="text" name="item_id" size="10" maxlength="16" /></td>
   </tr>
 <tr><td colspan=2 align="center"><input type="submit" value="Post">
   </td></tr>
   </table>
   <br />
<?php
}




function display_comments($com_array) {

echo "<p><u><b>Comments:</b></u></p>";
  // display all details about this book
  if (is_array($com_array)) 
{
//$com_array= db_result_to_array($com_array);

  //foreach ($com_array as $row)
{
    
    echo "<table><tr>";
    //display the picture if there is one
    
    
    echo "<td><ul>";
        
    echo "<li><strong>Name:</strong>";
    echo $com_array['name'];
     
    echo "</li><li><strong>Comments:</strong>";
    echo $com_array['comments'];
     
    
   // echo "<li><strong>Name:</strong>";
    //echo $result['name'];
     //echo $row->name;
    //echo "</li><li><strong>Comments:</strong>";
    //echo $result['comments'];
     //echo $row->comments;
    
    echo "</li></ul></td></tr></table>";
  }
}

 else {
    echo "<p>No Comments available.</p>";
  }
  echo "<hr />";
}
