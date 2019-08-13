<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>CRUD Hot Dog</title>

    <link rel="stylesheet" href="style.css">
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="shortcut icon" type="image/png" href="images/hot-dog-favicon.png"/>
    
    <!-- JQuery, Ajax and jquery for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>       
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" > 
                <a class="navbar-brand" id="logo" href="index.php">
                    <img src="images/hot-dog-header.png" width="40" height="40" class="d-inline-block align-top" alt="">
                    CRUD Hot Dog
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active pr-md-3" href="#">
                            <a href="index.php" class="nav-link">List</a>
                        </li> 
                        <li class="nav-item pr-md-3" href="#">
                                <a href="#" class="nav-link">About</a>
                        </li>    
            </nav>

            <div class="jumbotron">
                <h1 class="display-4">The list of something tasty and hot🔥</h1>
                <hr class="my-4">
                <p class="lead">Here you can explore the list of all hot dogs. Also, you can update or delete each of them, if you want. Enjoy :^)</p>
                
                <p class="lead">
                <button type="button" id="createModalButton" data-toggle="modal" data-target="#createHotDogModal" class="mb-3 btn btn-dark btn-lg">Create Hot Dog</button>    
                <a href="https://www.linkedin.com/in/volodymyr-morozov-79bb37163/" id="aboutButton" target="_blank" class="btn btn-dark btn-lg ml-md-3 mb-3" role="button">About developer</a>
                </p>
            </div>
            <?php
            $db = mysqli_connect("localhost", "id10457811_volter3228","20301823","id10457811_hot_dogs");
            $sql = "SELECT * FROM hot_dogs";
            $result = mysqli_query($db, $sql);
            $counter = 0;
            while ($row = mysqli_fetch_array($result)) {
                ++$counter;
                if ($counter === 1 || $counter%4 === 0) {
                    echo "<div class='row mb-3' style='font-size: 14px;'>";
                }
                echo "<div class = 'col mr-1 mb-2'>";
                echo "<div class = 'card'>";
                echo "<div class = 'card-body text-center'>";
                    echo "<h5 class='card-title font-weight-bolder'>".$row['name']."</h5>";
                    echo "<img style='margin: 5px; width: 290px; height: 256px;' src = 'images/uploads/".$row['image']."' >";
                    echo "<p class='card-text'><span class='font-weight-bold'>Price:</span> ".$row['price']."$</p>";
                    echo "<p class='card-text'><span class='font-weight-bold'>Calorific Value:</span> ".$row['calorific_value']." kcal</p>";
                    echo "<p class='card-text'><span class='font-weight-bold'>Description:</span> <br>".$row['description']."</p>";
                    echo "<p class='lead'>";
                    echo "<button type='button' data-target='#createHotDogModal' data-toggle='modal' name = 'edit' id = '".$row["id"]."' style='width: 120px;' class='mb-3 btn btn-dark btn-lg edit_data'>Edit</button>";
                    echo "<a href='delete_hot_dog.php?del=".$row['id']." type='button' name = 'delete' id = 'deleteButton' style='width: 120px;' class='ml-3 mb-3 btn btn-dark btn-lg'>Delete</a></p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                if ($counter%3 === 0) {
                    echo "</div>";
                }
            }           
        ?>
        </div>  

        <!-- Modal Section -->
        <div class="modal fade" id="createHotDogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-3">
                        <h5 class="modal-title" id="exampleModalLabel">Create Hot Dog</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span style="font-size: 30px;" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form action="add_hot_dog.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">       
                            <div class="input-group mb-4">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="file" aria-describedby="inputGroupFileAddon04">
                                    <label class="custom-file-label" required for="file">Select a photo of Hot Dog...</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Upload</button>
                                </div>
                            </div>

                            <label for="hot-dog-name">Name</label>
                            <div class="input-group mb-4">
                                <input type="text" name="hot-dog-name" required id="hot-dog-name" class="form-control" placeholder="Enter the name..." aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                            <label for="price">Price</label>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input onkeypress="return isNumberKey(event)" required placeholder = "Enter the price..." type="text" id="price" name="price" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                            <label for="calorific-value">Calorific value</label>
                            <div class="input-group mb-4">
                                <input onkeypress="return isNumberKey(event)" required type="text" name="calorific-value" id="calorific-value" class="form-control" placeholder="Enter the value..." aria-label="Username" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <span class="input-group-text">kcal</span>
                                </div>
                            </div>

                            <label for="description">Description</label>
                            <div class="input-group mb-4 text-description">
                                <div class="input-group-prepend">
                                    <span class="input-group-text word-counter" style="justify-content: center;">0/150</span>
                                </div>
                                <textarea required maxlength = "150" style="resize:none;" rows="6" class="form-control" name="description" id="description" aria-label="With textarea"></textarea>
                            </div>
                            <input type="hidden" name="hot-dog-id" id ="hot-dog-id">
                            <input type="hidden" name="imageUpdated" id ="imageUpdated">                       
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="create" name="submit" class="btn btn-dark">Insert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

    $(document).on('click', '.edit_data',function(){
        let id = $(this).attr("id");
        $.ajax({
            url: "fetch.php",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function(data) {
                $('#hot-dog-name').val(data.name);
                $('#price').val(data.price);
                $('#calorific-value').val(data.calorific_value);
                $('#description').val(data.description);
                $('#hot-dog-id').val(data.id);
                //replace the "Choose a file" label
                $('#description').keyup();
                $('.modal').modal('show');
                hotdogUpdate = true;
            }   
        })
    });

    $(document).on('click', '#createModalButton',function(){
        $('#hot-dog-id').val('');
    })

    $('.modal').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea")
            .val('')
            .end();
    })

    $('#description').keyup(function(){
        $('.word-counter').text(this.value.length+'/150');
    })    

    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
    }    

    $('.custom-file-input').on('change',function(){
        //get the file name
        let fileName = $(this).val().replace(/^.*[\\\/]/, '');
        let imageUpdate = $('#hot-dog-id').val();
        $('#imageUpdated').val('true');
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    }); 
    </script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 
       
</body>
</html>