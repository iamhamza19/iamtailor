<?php
session_start();
include_once("dbcon.php");
$USER_ID = $_SESSION['USER']['id'];
$Order_Id = $_REQUEST['Order_Id'];
$Id = $_REQUEST['id'];
$Customer_Name = $_REQUEST['Customer_Name'];
$Product_Type = $_REQUEST['Product_Type'];
$Order_Date = $_REQUEST['Order_Date'];
$Delivery_Date = $_REQUEST['Delivery_Date'];
$Total_Payment = $_REQUEST['Total_Payment'];
$Advance_Amount = $_REQUEST['Advance_Amount'];
$Pendening_Amount = $_REQUEST['Pendening_Amount'];
$paid = $_REQUEST['paid']+$Advance_Amount;
//$Image_Product = base64_encode(file_get_contents(addslashes($_FILES['Image_Product']['tmp_name']))); // file_get_contents($_FILES['files']['tmp_name'][$ik]);
if ($_FILES['Image_Product']['tmp_name'] != null) {
    $f_name = $_FILES['Image_Product']['name'];
    $img = file_get_contents($_FILES['Image_Product']['tmp_name']);
    $sql = "UPDATE customers SET
     `Customer_Name` = '$Customer_Name',
      `Product_Type` = '$Product_Type',
     `Delivery_Date` = '$Delivery_Date',
      `Total_Payment` = '$Total_Payment' ,
       `Advance_Amount` = '$Advance_Amount', 
    `Pendening_Amount` = '$Pendening_Amount',
    `paid`            = '$paid',
    image_name = '$f_name',
    pic = ?
    where id = $Id";

    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param($stmt, "s", $img);
    $updated = mysqli_stmt_execute($stmt);
} else {
    $sql = "UPDATE customers SET 
  
     `Customer_Name` = '$Customer_Name',
      `Product_Type` = '$Product_Type',
     `Delivery_Date` = '$Delivery_Date',
      `Total_Payment` = '$Total_Payment' ,
       `Advance_Amount` = '$Advance_Amount', 
    `Pendening_Amount` = '$Pendening_Amount',
    `paid`            = '$paid'
    where id = $Id";
    $updated = $con->query($sql);
}
$con->close();
if ($updated) {
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


