<?php
   $login =false;
   $showError =false;
   if($_SERVER["REQUEST_METHOD"]=="POST"){
     include 'partials/_dbconnect.php';
     $username = $_POST["username"];
     $password = $_POST["password"];
     $sql = "Select * from customer where c_username ='$username' AND c_password='$password'"; 
       $result = mysqli_query($conn,$sql);
       $num = mysqli_num_rows($result);
       if($num==1){
         $login = true;
         session_start();
         $_SESSION['loggedin'] = true;
         $_SESSION['username'] = $username;
         header("location: welcome_cust.php");
       }
      
      else{
        $showError = "Invalid credentials"; 
      }
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
      include 'partials/_dbconnect.php';
      $username = $_POST["username"];
      $password = $_POST["password"];
      $sql = "Select * from admin where a_username ='$username' AND password='$password'"; 
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num==1){
          $login = true;
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $username;
          header("location: welcome_admin.php");
        }
       
       else{
         $showError = "Invalid credentials"; 
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <title>Login</title>
    <style>
     body, html {
         height: 100%;
   }

   body {
          /* The image used */
          background-image: url("bg-images/4.jpg");

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
    if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success.</strong> You are now logged in.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    }

    if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error.</strong> '.$showError.'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
      }
    ?>

    <div class="container my-4">
    <h3 class="text-center"><strong>Admin/Customer Login</strong></h3>
    <form action = "/Bike Showroom/login.php" method = "post" style ="display: flex;
    flex-direction: column;
    align-items: center;
    padding:13px">
    
    <div class="form-group col-md-6 ">
    <label for="username"><strong>Username</strong></label>
    <input type="username" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
    </div>

    <div class="form-group col-md-6">
    <label for="password"><strong>Password</strong></label>
    <input type="password" class="form-control" id="password" name = "password" required>
    </div>

   <button type="submit" class="btn btn-primary col-md-1">Login</button>
   </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 </body>
</html>