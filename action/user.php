<?php
session_start();
include_once("dbcon.php");
$USER_ID = $_SESSION['USER']['id'];
$Full_Name = $_REQUEST['Full_Name'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$Type = $_REQUEST['Type'];
$create_date = date('d-M-Y');
$sql = "insert into users (`Full_Name`, `email`, `password`,
`Type`, `Created_By`,`create_date`) values('$Full_Name','$email','$password',
  '$Type','$USER_ID','$create_date')";

if ($con->query($sql)) {
  $_SESSION['Message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>User Added Succfully</strong>
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';
 
   header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
  $_SESSION['Message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Error: </strong> ' . $sql . ' <br> ' . $con->error . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
   header('Location: ' . $_SERVER['HTTP_REFERER']);
  
}

 $con->close();
