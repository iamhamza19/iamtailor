<?php
session_start();
include_once("dbcon.php");
$USER_ID = $_SESSION['USER']['id'];
$Status = $_REQUEST['Status'];
$Id = $_REQUEST['id'];

//$Image_Product = base64_encode(file_get_contents(addslashes($_FILES['Image_Product']['tmp_name']))); // file_get_contents($_FILES['files']['tmp_name'][$ik]);

    $sql = "UPDATE customers SET 
  
     `Status` = '$Status'
    where id = $Id";
   
if ( $con->query($sql)) {
    $_SESSION['MessageCustomer'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Record Updated Succfully</strong>
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';

    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['MessageCustomer'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Error: </strong> ' . $sql . ' <br> ' . $con->error . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


