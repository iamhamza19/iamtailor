<?php
session_start();
//echo $_SESSION['USER']['Type'];
include_once('action/dbcon.php');
if (!isset($_SESSION['USER'])) {
    $path = "location: ./index.php";
    header($path);
} else {
    if ($_SESSION['USER']['Type'] != "admin") {
        $path = "location: ./home.php";
        header($path);
    }
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

if($row['Status']=="Delivered")
{
    $_SESSION['Message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Order has been Delivered you can view Only.</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    $path = "location: ./ViewOrder.php?Product_id=".$Id;
    header($path);
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

    <title>i'm Tailor | Update Order </title>
</head>

<body>
    <!--  -->
    <?php include_once('action/nav.php'); ?>
    <!--  -->
    <div class="container">

        <div class="row">
            <div class="offset-2 col-md-8">
                <center>
                    <h3 class="mt-4">Update Order</h3>
                </center>
                <center>
                    <p class="mt-1">Please Update information Below</p>
                </center>
                <center>
                    <div class="col-4">
                        <hr>
                    </div>
                </center>
                <form action="action/updateorder.php?id=<?php echo $Id; ?>" method="post" class="mt-4" enctype="multipart/form-data">
                    <div class="row mt-4">
                        <div class="col-md-6 mt-2 ">
                            <label for="inputPassword5" class="form-label">Order Id</label>
                            <input type="text" readonly name="Order_Id" id="inputPassword5" value="<?php echo $row['Order_Id']; ?>" required class="form-control" aria-describedby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text d-none">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="inputPassword5" class="form-label">Customer Name</label>
                            <input type="text" name="Customer_Name" id="inputPassword5" value="<?php echo $row['Customer_Name']; ?>" required class="form-control" aria-describedby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text d-none">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="inputPassword5" class="form-label">Product Type</label>
                            <select class="form-select" required name="Product_Type" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option <?php echo ($row['Product_Type'] ==  "Complete Suit" ? "selected" : "") ?> value="Complete Suit">Complete Suit</option>
                                <option <?php echo ($row['Product_Type'] ==  "Shalwar" ? "selected" : "") ?> value="Shalwar">Shalwar</option>
                                <option <?php echo ($row['Product_Type'] ==  "Kurta" ? "selected" : "") ?> value="Kurta">Kurta</option>
                                <option <?php echo ($row['Product_Type'] ==  "Pent" ? "selected" : "") ?> value="Pent">Pent</option>
                                <option <?php echo ($row['Product_Type'] ==  "Coat" ? "selected" : "") ?> value="Coat">Coat</option>
                                <option <?php echo ($row['Product_Type'] ==  "Shirt" ? "selected" : "") ?> value="Shirt">Shirt</option>
                                <option <?php echo ($row['Product_Type'] ==  "Waistcoat" ? "selected" : "") ?> value="Waistcoat">Waistcoat</option>
                                <option <?php echo ($row['Product_Type'] ==  "Complete Pen Coat" ? "selected" : "") ?> value="Complete Pen Coat">Complete Pen Coat</option>
                            </select>
                            <div id="passwordHelpBlock" class="form-text d-none">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Select Image of Product</label>
                                <input class="form-control" type="file" name="Image_Product" id="formFile">
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="mb-3">
                                <img height="100" class="" src=<?php echo $pic ?> alt="">

                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Picking Order Date</label>
                                <input class="form-control" readonly value="<?php echo date('d-m-Y', strtotime($row['Order_Date'])); ?>" type="text" name="Order_Date" id="formFile">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Order Delivery Date</label>
                                <input class="form-control" type="date" value="<?php echo date('Y-m-d', strtotime($row['Delivery_Date'])); ?>" required name="Delivery_Date" id="formFile">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 ">
                            <label for="inputPassword5" class="form-label">Total Payment</label>
                            <input type="number" name="Total_Payment" id="total" onchange="calculations()" value="<?php echo $row['Total_Payment']; ?>" required class="form-control" aria-describedby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text d-none">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 ">
                            <label for="inputPassword5" class="form-label">Advance Amount</label>
                            <input type="number" readonly name="Advance_Amount" id="advance" onchange="calculations()" value="<?php echo $row['Advance_Amount']; ?>" required class="form-control" aria-describedby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text d-none">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>
                        </div>

                        <div class="col-md-6 mt-2 ">
                            <label for="inputPassword5" class="form-label">Pendening Amount</label>
                            <input type="number" name="Pendening_Amount" id="pendening" value="<?php echo $row['Pendening_Amount']; ?>" class="form-control" readonly aria-describedby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text d-none">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 ">
                            <label for="inputPassword5" class="form-label">Dues Amount</label>
                            <input type="number" name="paid" id="paid" onkeyup="calculations()" value="<?php echo $row['Pendening_Amount']; ?>" class="form-control"  aria-describedby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text d-none">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>
                        </div>
                        <!-- end Row -->
                    </div>
                    <center>
                        <a href="ViewOrder.php?Product_id=<?php echo $Id; ?>" class="mt-4 btn btn-dark">Go To View</a>

                        <button class="btn btn-dark" <?php echo($row['Status']=="Delivered" ? "disabled" : "") ?> type="submit" style="margin-top: 3%;">Update</button>
                        <a href="UpdateOrderStatus.php?Product_id=<?php echo $Id ; ?>" class="mt-4 btn btn-dark">Update Status</a>

                    </center>
            </div>
            <div class="col-md-2 mt-4">
                <?php if (isset($_SESSION['MessageCustomer'])) {

                    echo $_SESSION['MessageCustomer'];
                    unset($_SESSION['MessageCustomer']);
                }  ?>
            </div>
            </form>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    <script>
    //calculations();
        function calculations() {
            const total = parseInt($("#total").val());
            const Advance = parseInt($("#advance").val());
            const paid = parseInt($("#paid").val());
            $("#pendening").val(total - (Advance + paid));
           // alert(total - (paid + Advance));

        }
    </script>
</body>

</html>