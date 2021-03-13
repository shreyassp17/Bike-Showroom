<?php
session_start();
include 'partials/_dbconnect.php';
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

if($_SESSION['username']=='admin'){
  header("location: login.php");
    exit;
}


?>
<?php
$cancel = false;
if(isset($_GET['cancel'])){
   $bookingid = $_GET['cancel'];
   $uname =  $_SESSION['username'];
   $sql = "DELETE FROM `bookings` WHERE `booking_id`='$bookingid'";
   $result = mysqli_query($conn, $sql);
   if($result){
      $cancel = true;
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
    <title>Your Bookings</title>
    <style>
    body {
          /* The image used */
          background-image: url("bg-images/13.jpg");

         /* Full height */
          height: 100%;

          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          font-family: 'Poppins', sans-serif;
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
  if($cancel){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Bike removed from Bookings.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }

 ?>

<h3 class= "text-center my-4" >Your Bookings</h3>
<div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Bike Photo</th>
          <th scope="col">Bike Name</th>
          <th scope="col">Customer Username</th>
          <th scope="col">Booking ID</th>
          <th scope="col">Bike Number</th>
          <th scope="col">Final Price</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM `bookings` WHERE `c_username`='$username'";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
            <td> <img src='images/".$row['bike_photo']."' > </td>
            <td>". $row['bike_name'] . "</td>
            <td>". $row['c_username'] . "</td>
            <td>". $row['booking_id'] . "</td>
            <td>". $row['bike_no'] . "</td>
            <td>". $row['final_price'] . "</td>
            <td> <button class='cancel btn btn-sm btn-primary' id=d".$row['booking_id'].">Cancel Booking</button>  </td>
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
cancel = document.getElementsByClassName('cancel');
    Array.from(cancel).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to cancel the booking!?")) {
          console.log("yes");
          window.location = `/Bike Showroom/yourbookings.php?cancel=${sno}`;
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