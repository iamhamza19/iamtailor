<?php
session_start();
include_once("dbcon.php");
$USER_ID = $_SESSION['USER']['id'];
$Order_Id = $_REQUEST['Order_Id'];
$Customer_Name = $_REQUEST['Customer_Name'];
$Product_Type = $_REQUEST['Product_Type'];
$Order_Date = $_REQUEST['Order_Date'];
$Delivery_Date = $_REQUEST['Delivery_Date'];
$Total_Payment = $_REQUEST['Total_Payment'];
$Advance_Amount = $_REQUEST['Advance_Amount'];
$Pendening_Amount = $_REQUEST['Pendening_Amount'];
$f_name = $_FILES['Image_Product']['name'];
$paid = $_REQUEST['paid'];
//$Image_Product = base64_encode(file_get_contents(addslashes($_FILES['Image_Product']['tmp_name']))); // file_get_contents($_FILES['files']['tmp_name'][$ik]);
$img = file_get_contents($_FILES['Image_Product']['tmp_name']);
$sql = "insert into customers (`Order_Id`, `Customer_Name`, `Product_Type`,
`Order_Date`, `Delivery_Date`, `Total_Payment`, `Advance_Amount`, 
`Pendening_Amount`, `Created_By`, `Status`,`paid`,`image_name`,`pic`) values('$Order_Id','$Customer_Name','$Product_Type',
  '$Order_Date','$Delivery_Date','$Total_Payment','$Advance_Amount','$Pendening_Amount',
  $USER_ID,'Created','$paid','$f_name',?)";

$stmt = mysqli_prepare($con, $sql);

mysqli_stmt_bind_param($stmt, "s", $img);

if (mysqli_stmt_execute($stmt)) {
  $_SESSION['MessageCustomer'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Record Added Succfully</strong>
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

 $con->close();
