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
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>i'm Tailor | Customer </title>
</head>

<body>
    <!--  -->
    <?php include_once('action/nav.php'); ?>
    <!--  -->
    <div class="container">
        <center>
            <h3 class="mt-4"><strong>View All Customer</strong></h3>
        </center>
        <center>
            <p>Viewing All customer</p>
        </center>
        <center>
            <div class="col-4">

                <hr>
            </div>
        </center>
        <div class="row mt-4">
            <div class="offset-2 col-md-8">
                <div class="col-md-12">
                    <table id="myTable" class="order-column" style="width:100%">
                        <thead>
                            <tr>
                                <th>Ordere Id</th>
                                <th>Customer Name</th>
                                <th>Product Type</th>
                                <th>Total</th>
                                <th>Advance</th>
                                <th>Pendening</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sql = "SELECT * FROM `Customers`";
                            $result = $con->query($sql);
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['Order_Id'] ?></td>
                                    <td><?php echo $row['Customer_Name'] ?></td>
                                    <td><?php echo $row['Product_Type'] ?></td>
                                    <td><?php echo $row['Total_Payment'] ?></td>
                                    <td><?php echo $row['Advance_Amount'] ?></td>
                                    <td><?php echo $row['Pendening_Amount'] ?></td>
                                    <td><?php echo ($row['paid']==$row['Total_Payment'] ? "Paid" : "Pendening"); ?></td>
                                    <td><?php echo $row['Status'] ?></td>
                                    <td><a href="action/Delete.php?Product_id=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                        <?php if($row['Status']!="Delivered"){ ?>
                                        <a href="UpdateOrder.php?Product_id=<?php echo $row['id'] ?>" class="btn btn-sm btn-secondary">Update</a>
                                        <?php } ?>
                                        <a href="ViewOrder.php?Product_id=<?php echo $row['id'] ?>" class="btn btn-sm btn-primary mt-2">View</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2 mt-4">
                <?php if (isset($_SESSION['DeleteMessage'])) {

                    echo $_SESSION['DeleteMessage'];
                    unset($_SESSION['DeleteMessage']);
                }  ?>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>