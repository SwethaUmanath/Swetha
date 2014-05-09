<?php

// This file contains functions used by the admin interface
// for the giftshop shopping cart.



function display_category_form($category = '')
 {


 $edit = is_array($category);

 
 ?>
  

<form method="post"
      action="<?php echo $edit ? 'edit_category.php' : 'insert_category.php'; ?>">
  <table border="0">
 
 

<tr>
    <td>Category Name:</td>
   
 <td><input type="text" name="name" size="40" maxlength="40"  value="<?php echo $edit ? $category['name'] : ''; ?>" /></td>
   </tr>
 

<tr>
    <td>Category ID:</td>
  <td><input type="text" name="id" size="20" maxlength="20"  value="<?php echo $edit ? $category['id'] : ''; ?>" /></td>
 
  </tr>
  

 <tr>
    <td>Description:</td>
   
 <td><input type="text" name="description" size="100" maxlength="100"  value="<?php echo $edit ? $category['description'] : ''; ?>" /></td>
   </tr>
 

 <tr>
    <td <?php if (!$edit) { echo "colspan=2";} ?> align="center">
      <?php
         if ($edit) {
            echo "<input type=\"hidden\" name=\"id\" value=\"".$category['id']."\" />";
         }
      ?>
      <input type="submit"
       value="<?php echo $edit ? 'Update' : 'Add'; ?> Category" /></form>
     </td>
     <?php
        if ($edit) {
          //allow deletion of existing categories
          echo "<td>
                <form method=\"post\" action=\"delete_category.php\">
                <input type=\"hidden\" name=\"id\" value=\"".$category['id']."\" />
                <input type=\"submit\" value=\"Delete category\" />
                </form></td>";
       }
     ?>
  </tr>
  </table>
<?php
}





function display_items_form($item = '') 
{
 
 // This displays the book form.
// It is very similar to the category form.
// This form can be used for inserting or editing books.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_item.php.
// To update, pass an array containing a book.  The
// form will be displayed with the old data and point to update_item.php.
// It will also add a "Delete item" button.


  // if passed an existing book, proceed in "edit mode"
  $edit = is_array($item);

  
// most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
 

 <form method="post"
  action="<?php echo $edit ? 'edit_item.php' : 'insert_item.php';?>">
  <table border="0">
  <tr>
    <td>Item ID:</td>
    <td><input type="text" name="item_id"
         value="<?php echo $edit ? $items['item_id'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td> Name:</td>
    <td><input type="text" Name="item_name"
  value="<?php echo $edit ? $items['item_name'] : ''; ?>" /></td>
  </tr>
  
 <tr>
     <td>Description:</td>
     <td><textarea rows="3" cols="50"
          name="Item_desc"><?php echo $edit ? $item['Item_desc'] : ''; ?></textarea></td>
    </tr>

  
<tr>
     <td>Category ID:</td>
     <td><textarea rows="1" cols="20"
          name="id"><?php echo $edit ? $item['id'] : ''; ?></textarea></td>
    </tr>


  <tr>
    <td>Price:</td>
    <td><input type="text" name="price"
               value="<?php echo $edit ? $items['price'] : ''; ?>" /></td>
   </tr>
 
    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
         <?php
            if ($edit)
             // we need the old isbn to find book in database
             // if the isbn is being updated
             echo "<input type=\"hidden\" name=\"oldisbn\"
                    value=\"".$items['item_id']."\" />";
         ?>
        <input type="submit"
               value="<?php echo $edit ? 'Update' : 'Add'; ?> item" />
        </form></td>
     
   <?php
           if ($edit) {
             echo "<td>
           

        <form method=\"post\" action=\"delete_item.php\">
                   <input type=\"hidden\" name=\"code\"
                    value=\"".$items['item_id']."\" />
                   <input type=\"submit\" value=\"Delete item\"/>
                   </form></td>";
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}



function display_password_form()
 {
// displays html change password form
?>
   <br />
   <form action="change_password.php" method="post">
 
  <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Old password:</td>
       <td><input type="password" name="old_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>New password:</td>
       <td><input type="password" name="new_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>Repeat new password:</td>
       <td><input type="password" name="new_passwd2" size="16" maxlength="16" /></td>
   </tr>
   <tr><td colspan=2 align="center"><input type="submit" value="Change password">
   </td></tr>
   </table>
   <br />
<?php
}



function insert_category($name,$id,$description) {

// inserts a new category into the database

   $conn = db_connect();

   // check category does not already exist
 
  $query = "select *
 from categories
  where name='".$name."'";
  
 $result = $conn->query($query);
  
 if ((!$result) || ($result->num_rows!=0))
 {
     return false;
   }

  

 // insert new category
   $query = "insert into categories values
 ('".$id."', '".$name."','".$description."')";
  
 $result = $conn->query($query);
   
if (!$result) {
     return false;
   } else {
     return true;
   }
}










function insert_item($item_id, $item_name, $Item_desc,  $price,$id) {
// insert a new book into the database

   $conn = db_connect();

  
 // check book does not already exist
  
 $query = "select *
  from items  where item_id='".$item_id."'";

 
  $result = $conn->query($query);
 
  if ((!$result) || ($result->num_rows!=0)) 
{
     return false;
   }

   // insert new item
   
$query = "insert into items values
            ('".$item_id."', '".$item_name."', '".$Item_desc."',
 '".$price."','".$id."')";

  
 $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}



function update_category($id, $name, $description) {

 $conn = db_connect();

   
$query = "update categories
 SET name='".$name."'
 , description='".$description."' where id='".$id."'";
 
  $result = @$conn->query($query);
   
if (!$result) {
     return false;
   } else {
     return true;
   }
}



function update_item($olditem_id, $item_id, $item_name, $Item_desc, $id,
                     $price, $Item_desc) {
// change details of book stored under $oldisbn in
// the database to new details in arguments

   
$conn = db_connect();

 
  $query = "update items
 set item_id= '".$item_id."',
             item_name = '".$item_name."',
             Item_desc= '".$Item_desc."',
             id = '".$id."',
             price = '".$price."',
             Item_desc = '".$Item_desc."'
             where item_id = '".$olditem_id."'";

  
 $result = @$conn->query($query);
   
if (!$result) {
     return false;
   } else {
     return true;
   }
}



function delete_category($id) {
// Remove the category identified by catid from the db
// If there are books in the category, it will not
// be removed and the function will return false.

   $conn = db_connect();

   // check if there are any books in category
   // to avoid deletion anomalies
 
  $query = "select *
             from items
             where id='".$id."'";

  
 $result = @$conn->query($query);
 
  if ((!$result) || (@$result->num_rows > 0)) {
     return false;
   }

   
$query = "delete from categories
             where id='".$id."'";
 
  $result = @$conn->query($query);
 
  if (!$result) {
     return false;
   } else {
     return true;
   }
}




function delete_item($item_id) {
// Deletes the book identified by $isbn from the database.

   $conn = db_connect();

   
$query = "delete from items where item_id='".$item_id."'";
  
 $result = @$conn->query($query);
   
if (!$result) {
     return false;
   } else {
     return true;
   }
}


?>
