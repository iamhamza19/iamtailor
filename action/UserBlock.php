<?php
session_start();
include_once("dbcon.php");
$USER_ID = $_SESSION['USER']['id'];
$Status = $_REQUEST['Status'];
$Id = $_REQUEST['User_id'];

$sql = "SELECT * FROM `Users` where id = '$Id' ";
$result = $con->query($sql);
$row = $result->fetch_assoc();

if($row['flag']=="N"){
    $sql = "UPDATE users SET 
  
     `flag` = 'Blocked'
    where id = $Id";
    $ms= "BLOCKED";
}
else{
    $sql = "UPDATE users SET 
  
     `flag` = 'N'
    where id = $Id";
    $ms= "UNBLOCKED";
}
if ( $con->query($sql)) {
    $_SESSION['Message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>User '.$ms.'  Succfully</strong>
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


