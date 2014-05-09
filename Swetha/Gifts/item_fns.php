<?php 



function get_categories() 
{
   // query database for a list of categories
  
 $conn = db_connect();
  
 $query = "select id, name from categories";
 
  $result = @$conn->query($query);
  
 if (!$result) 
{
     return false;
  
 }
   
$num_cats = @$result->num_rows;
  
 if ($num_cats == 0) {
      return false;
 
  }
  
 $result = db_result_to_array($result);

   return $result;
}



function get_category_name($id) 
{
   // query database for the name for a category id
   
$conn = db_connect();
 
  $query = "select name from categories
 where id = '".$id."'";
 
  $result = @$conn->query($query);
  
 if (!$result) {
     return false;
 
  }
 

  $num_cats = @$result->num_rows;
  
 if ($num_cats == 0) 
{
      return false;
   }
   
$row = $result->fetch_object();
  
 return $row->name;
}


function get_category_desc($id) 
{
   // query database for the name for a category id
   
$conn = db_connect();
 
  $query = "select description from categories
 where id = '".$id."'";
 
  $result = @$conn->query($query);
  
 if (!$result) {
     return false;
 
  }
 

  $num_cats = @$result->num_rows;
  
 if ($num_cats == 0) 
{
      return false;
   }
   
$row = $result->fetch_object();
  
 return $row->description;
}





function get_items($id) 
{
   // query database for the books in a category
 
  if ((!$id) || ($id == '')) {
     return false;
   }

  
 $conn = db_connect();
 

  $query = "select * from items where id = '".$id."'";
 
  $result = @$conn->query($query);
  

 if (!$result) 
{
     return false;
   }
 
  $num_items = @$result->num_rows;
  
 if ($num_items == 0) {
      return false;
   }
 
  $result = db_result_to_array($result);
  
 return $result;

}



function get_item_details($item_id)

 {
  // query database for all details for a particular book
 
 if ((!$item_id) || ($item_id=='')) {
     return false;
  }
 
 $conn = db_connect();
 
 $query = "select * from items where item_id='".$item_id."'";
  
$result = @$conn->query($query);
  
if (!$result) 
{
     return false;
  }
 
 $result = @$result->fetch_assoc();
  
return $result;

}







function insert_comment($name, $comment, $item_id)
 {
  $conn = db_connect();

  
 
    
$query = "insert into comments values
 ('".$name."', '".$comment."', '".$item_id."')";

  
 $result = $conn->query($query);
 
  
if(!$result) {
     
return false;
   }
 else {
     return true;
   }

}




function get_comments($num)

 {
  
 if ((!$num) || ($num=='')) 
{
     return false;
  }
 
 $conn = db_connect();


$query = "select * from comments where item_id='".$num."'";
  
$com_array = @$conn->query($query);




if (!$com_array) 
{
     return false;
  }
 
 $com_array = @$com_array->fetch_assoc();
  
return $com_array;

}


