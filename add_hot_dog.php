<?php
    $msg ="";
    if (isset($_POST['submit'])) {
        // connect to the database
        $db = mysqli_connect("localhost", "id10457811_volter3228","20301823","id10457811_hot_dogs");

        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $description = $_POST['description'];
        $price = $_POST['price'];
        $calorificValue = $_POST['calorific-value'];
        $name = $_POST['hot-dog-name'];

        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));
        $fileNameNew = uniqid('',true).".".$fileActualExt;

        if($_POST['hot-dog-id'] != '')  
        {  
           $sql = "UPDATE hot_dogs   
           SET name='$name',   
           description='$description',   
           price='$price',   
           calorific_value = '$calorificValue',   
           image = '$fileNameNew'   
           WHERE id='".$_POST["hot-dog-id"]."'";  
           $message = 'Data Updated';  
           $_POST['hot-dog-id'] = "";
      }  
      else  
      {  
        $sql = "INSERT INTO hot_dogs (image,name,price,calorific_value,description) 
        VALUES ('$fileNameNew', '$name','$price','$calorificValue','$description')";  
        $message = 'Data Inserted';  
      }  
        
        mysqli_query($db, $sql);
        
        $allowed = array('jpg', 'jpeg','png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 100000000) {
                    $fileDestination = 'images/uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    //$msg = "Image uploaded successfully";
                    header("Location: index.php");
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "You cannot upload files of this type!";
        }
    }
?>