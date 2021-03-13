<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

if($_SESSION['username']!='admin'){
  header("location: login.php");
    exit;
}
?>

<?php 
 $showAlert = false;
 $showError = false;
 include 'partials/_dbconnect.php';
 if($_SERVER["REQUEST_METHOD"]=="POST"){
   // Get image name
   $image = $_FILES['image']['name'];
   // image file directory
   $target = "images/".basename($image);
     $compname = $_POST["compname"];
     $email = $_POST["compemail"];
     $address = $_POST["address"];
     $description = $_POST["compdescription"];
     
     $sql = "INSERT INTO `company`(`cmp_logo`,`cmp_name`,`cmp_email`,`cmp_address`,`cmp_desc`) VALUES ('$image','$compname','$email','$address','$description')";
       $result = mysqli_query($conn,$sql);
       if($result)
       {
          $showAlert = true;
       }
       else{
         $showError = "Company already available";
       }
       if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
        }
        else{
        $msg = "Failed to upload image";
      }
     }
     $del = false;
     if(isset($_GET['delete'])){
        $sno = $_GET['delete'];
        $delete = true;
        $sql = "DELETE FROM `company` WHERE `cmp_name` = '$sno'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $del = true;
        }
      }
     
 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <title>Add/Remove Companies</title>
    <style>
    .form-control{
            border-radius:25px;
          }
          .btn{
            border-radius:25px;
          }
          body{
            font-family: 'Poppins', sans-serif;
            /* The image used */
             background-image: url("bg-images/11.jpg");

             /* Full height */
             height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
             background-repeat: no-repeat;
             background-size: cover;
            
          }
          img{
   	        float: left;
   	        margin: 5px;
   	        width: 230px;
   	        height: 150px;
          }
    </style>
  </head>
  <body>
  <?php require 'partials/_nav.php' ?>
  <?php
  if($del){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Company information deleted successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }

  if($showError){
    echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong>' .$showError.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
   </button>
   </div>';
  }

  if($showAlert){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>Company information added successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
   </button>
   </div>';
  }
 ?>
  <h3 class= "text-center my-4" >Add Company Information</h3>
  <div class="container my-4">
  <form action ="/Bike Showroom/add_removecomp.php" method = "post" style ="display: flex;
    flex-direction: column;
    align-items: center;
    padding:15px" enctype="multipart/form-data">
  <div class="form-group col-md-6">
    <label for="compname">Company Name</label>
    <input type="text" class="form-control" id="compname" name = "compname" maxlength = "20">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleInputEmail1">Company Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "compemail">
    
  </div>
  <div class="form-group col-md-6">
    <label for="avail">Company Address</label>
    <input type="text" class="form-control" id="address" name = "address">
  </div>

  <div class="form-group col-md-6">
    <label for="exampleFormControlTextarea1">Company Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="compdescription"></textarea>
  </div>

  <div class="form-group col-md-6">
  <input type="hidden" name="size" value="1000000" class="form-control">
  <div class="form-group col-md-6">
  <label for="exampleFormControlTextarea1">Company Logo</label>
  	  <input type="file" name="image">
  </div>
  </div>
  
  <button type="submit" class="btn btn-primary col-md-1">Submit</button>
</form>
</div>
<hr>

<h3 class= "text-center my-4" >Available Company Details</h3>
<div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Company Logo</th>
          <th scope="col">Company Name</th>
          <th scope="col">Company Email</th>
          <th scope="col">Number of bikes available</th>
          <th scope="col">Company Address</th>
          <th scope="col">Company Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `company`";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
            <td> <img src='images/".$row['cmp_logo']."' > </td>
            <td>". $row['cmp_name'] . "</td>
            <td>". $row['cmp_email'] . "</td>
            <td>". $row['no_of_bikes'] . "</td>
            <td>". $row['cmp_address'] . "</td>
            <td>". $row['cmp_desc'] . "</td>
            <td> <button class='delete btn btn-sm btn-primary' id=d".$row['cmp_name'].">Delete</button>  </td>
          </tr>";
        } 
          ?>
       </tbody>
    </table>
  </div>
  <hr>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

<script>
deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to remove this Company!?")) {
          console.log("yes");
          window.location = `/Bike Showroom/add_removecomp.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
  </body>
</html>