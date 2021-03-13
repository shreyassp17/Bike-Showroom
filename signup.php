<?php 
 $showAlert = false;
 $showError = false;
 if($_SERVER["REQUEST_METHOD"]=="POST"){
     include 'partials/_dbconnect.php';
     $username = $_POST["username"];
     $fname = $_POST["firstname"];
     $lname = $_POST["lastname"];
     $phone = $_POST["phone"];
     $email = $_POST["email"];
     $date = $_POST["date"];
     $password = $_POST["password"];
     $cpassword = $_POST["cpassword"];
     $exists = false;
     if(($password==$cpassword) && $exists==false && $username!='admin'){
       $sql = "INSERT INTO `customer`(`c_username`,`f_name`,`l_name`,`c_phone`,`email`,`c_dob`,`c_password`) VALUES ('$username','$fname','$lname','$phone','$email','$date','$password')";
       $result = mysqli_query($conn,$sql);
       if($result)
       {
          $showAlert = true;
       }
       else{
         $showError = "Username already exists";
       }
     }
     else{
        $showError = "Passwords didnot match";
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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <title>Signup</title>
    <style>
    
   body {
          /* The image used */
          background-image: url("bg-images/7.jpg");

         /* Full height */
          height: 100%;

          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          font-family: 'Poppins', sans-serif;
         }
          .form-control{
            border-radius:25px;
          }
          .btn{
            border-radius:25px;
          }

    </style>
  </head>
  <body>
  <?php require 'partials/_nav.php' ?>
  <?php
  if($showAlert){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account has been created successfully.
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
 ?>

  <div class="container my-4">
  <h3 class="text-center my-4"><strong>New Customer ? Please Signup</strong></h3>
  <form action ="/Bike Showroom/signup.php" method = "post" style ="display: flex;
    flex-direction: column;
    align-items:center;
    padding:15px">
  <div class="form-group col-md-6">
    <label for="firstname">First Name</label>
    <input type="text" class="form-control" id="firstname" name = "firstname" required>
  </div>
  <div class="form-group col-md-6">
    <label for="firstname">Last Name</label>
    <input type="text" class="form-control" id="lastname" name = "lastname" required>
  </div>
  <div class="form-group col-md-6">
    <label for="phone">Phone Number</label>
    <input type="text" class="form-control" id="phone" name = "phone" required maxlength = "10">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "email" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group col-md-6">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name = "username" required maxlength = "20" minlength = "5">
    <small id="emailHelp" class="form-text text-muted">Username should have minimum 5 and maximum 10 characters.</small>
  </div>
  <div class="form-group col-md-6">
    <label for="date">Date of Birth</label>
    <input type="date" class="form-control" id="date" name = "date" required>
  </div>
  <div class="form-group col-md-6">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="password" name = "password" required maxlength = "20">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name = "cpassword" required maxlength = "20">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>