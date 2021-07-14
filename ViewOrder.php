<?php
session_start();
include_once('action/dbcon.php');
if (!isset($_SESSION['USER'])) {
    $path = "location: ./index.php";
    header($path);
}

if (isset($_SESSION['Message'])) {
    $Message = $_SESSION['Message'];
    unset($_SESSION['Message']);
} else {
    $Message = "";
}
$Id = $_GET['Product_id'];
$sql = "SELECT * FROM `customers` where id = '$Id' ";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$IMG = $row['Image_Product'];
$pic = 'data:image/jpeg;base64,' . base64_encode($row['pic']);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>i'm Tailor | View Order </title>
</head>

<body>
    <!--  -->
    <?php include_once('action/nav.php'); ?>
    <!--  -->
    <div class="container">
        <center class="mt-4">
            <h4>Order DETAILS</h4>
        </center>
        <?php if($Message){ echo $Message;}?>
        <div class="row mt-4">
            <div class="offset-2 col-md-8">
                <div class="row">
                    <div class="col-md-4 ">
                        <img height="200" class="" src=<?php echo $pic ?> alt="">
                    </div>
                    <div class="offset-1 col-md-7 ">
                        <form action="action/customer.php" method="post" class="mt-4" enctype="multipart/form-data">
                            <div class="row mt-4">
                                <div class="col-md-6 mt-2 ">
                                    <label for="inputPassword5" class="form-label">Order Id</label>
                                    <input type="text" readonly value="<?php echo $row['Order_Id'] ; ?>" name="Order_Id" id="inputPassword5" required class="form-control" aria-describedby="passwordHelpBlock">
                                    <div id="passwordHelpBlock" class="form-text d-none">
                                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="inputPassword5" class="form-label">Customer Name</label>
                                    <input type="text" readonly value="<?php echo $row['Customer_Name'] ; ?>" name="Customer_Name" id="inputPassword5" required class="form-control" aria-describedby="passwordHelpBlock">
                                    <div id="passwordHelpBlock" class="form-text d-none">
                                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                    </div>
                                </div>
                               
                                <div class="col-md-6 mt-2">
                                    <label for="inputPassword5" class="form-label">Customer Name</label>
                                    <input type="text" readonly value="<?php echo $row['Product_Type'] ; ?>" name="Customer_Name" id="inputPassword5" required class="form-control" aria-describedby="passwordHelpBlock">
                                    <div id="passwordHelpBlock" class="form-text d-none">
                                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                    </div>
                                </div>
                               
                                <div class="col-md-6 mt-2">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Picking Order Date</label>
                                        <input class="form-control"readonly value="<?php echo date('d-m-Y',strtotime($row['Order_Date'])) ; ?>" type="text" name="Order_Date" id="formFile">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Order Delivery Date</label>
                                        <input class="form-control" type="text" readonly value="<?php echo date('d-m-Y',strtotime($row['Delivery_Date'] )); ?>" required name="Delivery_Date" id="formFile">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2 ">
                                    <label for="inputPassword5" class="form-label">Total Payment</label>
                                    <input type="text" readonly value="<?php echo $row['Total_Payment'] ; ?>" name="Total_Payment" id="inputPassword5" required class="form-control" aria-describedby="passwordHelpBlock">
                                    <div id="passwordHelpBlock" class="form-text d-none">
                                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2 ">
                                    <label for="inputPassword5" class="form-label">Advance Amount</label>
                                    <input type="text" name="Advance_Amount" readonly value="<?php echo $row['Advance_Amount'] ; ?>" id="inputPassword5" required class="form-control" aria-describedby="passwordHelpBlock">
                                    <div id="passwordHelpBlock" class="form-text d-none">
                                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2 ">
                                    <label for="inputPassword5" class="form-label">Pendening Amount</label>
                                    <input type="text" name="Pendening_Amount" readonly value="<?php echo $row['Pendening_Amount'] ; ?>" id="pendening" class="form-control" readonly aria-describedby="passwordHelpBlock">
                                    <div id="passwordHelpBlock" class="form-text d-none">
                                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2 ">
                                    <label for="inputPassword5" class="form-label">Order Status</label>
                                    <input type="text"  readonly value="<?php echo $row['Status'] ; ?>"  class="form-control" readonly aria-describedby="passwordHelpBlock">
                                    <div id="passwordHelpBlock" class="form-text d-none">
                                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                    </div>
                                </div>
                                <!-- end Row -->
                            </div>
                            <a href="CustomerManagement.php" class="mt-4 btn btn-dark">Back To List</a>
                            <?php if($row['Status']!="Delivered"){ ?>
                            <a href="UpdateOrder.php?Product_id=<?php echo $Id ; ?>" class="mt-4 btn btn-dark">Update</a>
                            <a href="UpdateOrderStatus.php?Product_id=<?php echo $Id ; ?>"  class="mt-4 btn btn-dark">Update Status</a>
                            <?php } ?>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

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