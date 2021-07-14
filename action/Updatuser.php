<?php
session_start();
include_once("dbcon.php");
$USER_ID = $_SESSION['USER']['id'];
$Id = $_REQUEST['id'];
$Full_Name = $_REQUEST['Full_Name'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$Type = $_REQUEST['Type'];
// $create_date = date('d-M-Y');
//$Image_Product = base64_encode(file_get_contents(addslashes($_FILES['Image_Product']['tmp_name']))); // file_get_contents($_FILES['files']['tmp_name'][$ik]);

    $sql = "UPDATE Users SET 
  `Full_Name` = '$Full_Name',
  `email` = '$email',
  `password` = '$password',
  `Type` = '$Type'

    where id = $Id";
   
if ( $con->query($sql)) {
    $_SESSION['Message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Record Updated Succfully</strong>
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


