<?php
    $db = mysqli_connect("localhost", "id10457811_volter3228","20301823","id10457811_hot_dogs");
    if(isset($_GET['del']))
	{
      $id = $_GET['del'];
      $sql = "DELETE FROM hot_dogs WHERE id='$id'";
      $res = mysqli_query($db, $sql);
     
      //echo "<meta http-equiv='refresh' content='0;url=index.php'>";
      header("Location: index.php");
	}
?>