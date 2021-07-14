<?php
session_start();
include_once('action/dbcon.php');
if(isset($_SESSION['USER']))
{
    echo  "ahoo";
    $path="location: ./home.php";
    header($path);
}

if(isset($_SESSION['Message']))
{
    $Message = $_SESSION['Message'];
    unset($_SESSION['Message']);
}
else
{
    $Message = "";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>i'm Tailor | Login  </title>
  </head>
  <body>
  <!--  -->
  <div class="container">
 
<center class="" style="margin-top: 20vh;">
<h1 style="font-size: 50px;font-weight:900; "><strong>i'm </strong><u>Tailor</u></h1>
<h1 class="mt-3">Login Here!</h1>
<div class="col-4">
<hr></div>
<h6 class="text-danger"><strong><?php echo ($Message ? $Message : ""); ?></strong></h6>
<form action="./action/login.php" method="post" class="mt-4">
<div class="col-md-5 form-floating mb-3">
  <input type="text" class="form-control" name="Username" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Username</label>
</div>

<div class="col-md-5 form-floating">
  <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
  <label for="floatingPassword">Password</label>
</div>
<button type="submit" class="btn btn-dark mt-4"> Login Here</button>
</form>

</center>
</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>