<?php  

$db = mysqli_connect("localhost", "id10457811_volter3228","20301823","id10457811_hot_dogs"); 
if(isset($_POST["id"]))  
{  
      $query = "SELECT * FROM hot_dogs WHERE id = '".$_POST["id"]."'";  
      $result = mysqli_query($db, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
}  
?>