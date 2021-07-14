<?php
include_once("action/dbcon.php");
session_start();
if (!isset($_SESSION['USER'])) {
  $path = "location: ./index.php";
  header($path);
}
else
{
  $u = $_SESSION['USER']['id'];
}
if (isset($_SESSION['Message'])) {
  $Message = $_SESSION['Message'];
  unset($_SESSION['Message']);
} else {
  $Message = "";
}

//all customers
$sql = "SELECT count(*) as All_Customer FROM `customers`";
$result = $con->query($sql);
$All_Customer = $result->fetch_assoc();

//pending Pend_Customer
$sql = "SELECT count(*) as Pend_Customer FROM `customers` where Status <> 'Delivered'";
$result = $con->query($sql);
$Pend_Customer = $result->fetch_assoc();

//DONE Pend_Customer
$sql = "SELECT count(*) as Done_Customer FROM `customers` where Status = 'Delivered'";
$result = $con->query($sql);
$Done_Customer = $result->fetch_assoc();

//ready_Customer
$sql = "SELECT count(*) as ready_Customer FROM `customers` where Status = 'Ready To Deliver'";
$result = $con->query($sql);
$ready_Customer = $result->fetch_assoc();

//total_earn
$sql = "SELECT sum(paid) as total_earn FROM `customers` where Status = 'Delivered'";
$result = $con->query($sql);
$total_earn = $result->fetch_assoc();
//Not_Paid
$sql = "SELECT sum(Pendening_Amount) as Not_Paid FROM `customers` where Status = 'Delivered'";
$result = $con->query($sql);
$Not_Paid = $result->fetch_assoc();
//Advanced_Received
$sql = "SELECT sum(Advance_Amount) as Advanced_Received FROM `customers` where Status <> 'Delivered'";
$result = $con->query($sql);
$Advanced_Received = $result->fetch_assoc();
//Advanced_Received_of_completed
$sql = "SELECT sum(Advance_Amount) as Advanced_Received_of_completed FROM `customers` where Status = 'Delivered'";
$result = $con->query($sql);
$Advanced_Received_of_completed = $result->fetch_assoc();
//pending_pay
$sql = "SELECT sum(Advance_Amount) as pending_pay FROM `customers` where Status = 'Delivered'";
$result = $con->query($sql);
$pending_pay = $result->fetch_assoc();
//Pendinds_Receiveable
$sql = "SELECT sum(Pendening_Amount) as Pendinds_Receiveable FROM `customers` where Status <> 'Delivered'";
$result = $con->query($sql);
$Pendinds_Receiveable = $result->fetch_assoc();
//tu

$sql = "SELECT count(*) as tu FROM `Users` where id <> $u";
$result = $con->query($sql);
$tu = $result->fetch_assoc();
//tt
$sql = "SELECT count(*) as tt FROM `Users` where Type = 'Tailor'";
$result = $con->query($sql);
$tt = $result->fetch_assoc();
//tm
$sql = "SELECT count(*) as tm FROM `Users` where Type = 'Manager'";
$result = $con->query($sql);
$tm = $result->fetch_assoc();
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <title>i'm Tailor | Home </title>
</head>

<body>
  <!--  -->
  <?php include_once('action/nav.php'); ?>
  <!--  -->
  <div class="container">
    <?php
    if (isset($_SESSION['USER'])) {
      if ($_SESSION['USER']['Type'] == "admin") { ?>

        <div class="row" style="margin-top: 5vh;">
        <h3>Orders</h3>

          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Total Orders</div>
              <div class="card-body">
                <h5 class="card-title">Total Orders: <?php echo $All_Customer['All_Customer']; ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Pending Orders</div>
              <div class="card-body">
                <h5 class="card-title">Pending Orders: <?php echo $Pend_Customer['Pend_Customer']; ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Completed Orders</div>
              <div class="card-body">
                <h5 class="card-title">Completed Orders: <?php echo $Done_Customer['Done_Customer']; ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Orders Ready To Deliver</div>
              <div class="card-body">
                <h5 class="card-title">Orders Ready To Deliver: <?php echo $ready_Customer['ready_Customer']; ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <h3>Payments</h3>

          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Total Earnings</div>
              <div class="card-body">
                <h5 class="card-title">Total Earn: <?php echo $total_earn['total_earn']; ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Customer Not Paid Properly</div>
              <div class="card-body">
                <h5 class="card-title">Not Paid: <?php echo $Not_Paid['Not_Paid']; ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Advanced Received</div>
              <div class="card-body">
                <h5 class="card-title">Advanced Received: <?php echo ($Advanced_Received['Advanced_Received'] ? $Advanced_Received['Advanced_Received'] :"0"); ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Advanced Received of Completed</div>
              <div class="card-body">
                <h5 class="card-title">Advanced Received: <?php echo $Advanced_Received_of_completed['Advanced_Received_of_completed']; ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Pendinds Receiveable</div>
              <div class="card-body">
                <h5 class="card-title">Pendinds Receiveable: <?php echo ($Pendinds_Receiveable['Pendinds_Receiveable'] ? $Pendinds_Receiveable['Pendinds_Receiveable'] :"0"); ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            
          </div>
          <div class="col-lg-3">
            
            </div>
            <div class="col-lg-3">
            
            </div>
            <h3>Users</h3>
          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Total User</div>
              <div class="card-body">
                <h5 class="card-title">Total User: <?php echo ($tu['tu'] ? $tu['tu'] :"0"); ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Total Tailor</div>
              <div class="card-body">
                <h5 class="card-title">Total Tailor: <?php echo ($tt['tt'] ? $tt['tt'] :"0"); ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Total Manger</div>
              <div class="card-body">
                <h5 class="card-title">Total Manger: <?php echo ($tm['tm'] ? $tm['tm'] :"0"); ?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              </div>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <center class="" style="margin-top: 35vh;">
          <h1 style="font-size: 50px;font-weight:900; "><strong>i'm </strong><u>Tailor</u></h1>
          <a href="Customers.php" class="mt-4 btn btn-dark">Add Customer</a>


        </center>
    <?php }
    } ?>

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