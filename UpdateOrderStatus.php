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
if($row['Status']=="Delivered")
{
    
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
    <link rel="stylesheet" href="action/css/sweetalert.css">
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
                    <h3 class="mt-4">Update Order Status</h3>
                </center>
                <center>
                    <p class="mt-1">Please Update information Below</p>
                </center>
                <center>
                    <div class="col-4">
                        <hr>
                    </div>
                </center>
                <form action="action/updatestatusorder.php?id=<?php echo $Id; ?>" method="post" class="mt-4" enctype="multipart/form-data">

                    <div class="col-md-12 mt-2">
                        <label for="inputPassword5" class="form-label">Order Status</label>
                        <select class="form-select" required name="Status" <?php echo($row['Status']=="Delivered" ? "disabled" : "") ?> onchange="updatestatus(this.value)" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option <?php echo ($row['Status'] ==  "Created" ? "selected" : "") ?> value="Washed">Nothing Done</option>
                            <option <?php echo ($row['Status'] ==  "Washed" ? "selected" : "") ?> value="Washed">Washed</option>
                            <option <?php echo ($row['Status'] ==  "Cutting" ? "selected" : "") ?> value="Cutting">Cutting</option>
                            <option <?php echo ($row['Status'] ==  "In Queue" ? "selected" : "") ?> value="In Queue">In Queue</option>
                            <option <?php echo ($row['Status'] ==  "In Process" ? "selected" : "") ?> value="In Process">In Process</option>
                            <option <?php echo ($row['Status'] ==  "Stiched" ? "selected" : "") ?> value="Stiched">Stiched</option>
                            <option <?php echo ($row['Status'] ==  "Pressed" ? "selected" : "") ?> value="Pressed">Pressed</option>
                            <option <?php echo ($row['Status'] ==  "Packed" ? "selected" : "") ?> value="Packed">Packed</option>
                            <option <?php echo ($row['Status'] ==  "Ready To Deliver" ? "selected" : "") ?> value="Ready To Deliver">Ready To Deliver</option>
                            <option <?php echo ($row['Status'] ==  "Delivered" ? "selected" : "") ?> value="Delivered">Delivered</option>

                        </select>

                        <!-- end Row -->
                    </div>
                    <a href="ViewOrder.php?Product_id=<?php echo $Id; ?>" class="mt-4 btn btn-dark">Go Back</a>
                    <a href="UpdateOrder.php?Product_id=<?php echo $Id; ?>" <?php echo($row['Status']=="Delivered" ? "disabled" : "") ?> class="mt-4 btn btn-dark">Update Order</a>
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
    <script src="action/js/sweetalert.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    <script>

        function updatestatus(vals) {
            var id = '<?php echo $Id ?>';
            var pendening = '<?php echo $row['Pendening_Amount'] ;?>';
            if (vals != "Delivered") {
                $.ajax({
                    type: "POST",
                    url: "action/updatestatusorder.php?id=" + id,
                    data: 'Status=' + vals,

                    success: function(data) {

                        swal({
                            title: "Status Updated",
                            // text: "Status Updated",
                            type: "success"},
                            function() {
                        
                                location.replace("http://localhost/corephp/CustomerManagement.php");

                            }
                        );
                        
                    }
                });
            } else {

                if (pendening > 0)

                {
                    swal({
                        title: "", //"<h3 class='text-danger font-monospace'>Welcome in Alerts</h3>",
                        //type: "error",
                        //customClass: 'swal-wide',
                        //closeOnConfirm: false,
                        html: true,
                        confirmButtonColor: "#198754",
                        confirmButtonText: "It's OK",
                        text: "<h3 class='text-left font-monospace'>This Customer have some Pendening Ammount If You Want to Update Click Update Otherwise Ok.</a></h3><br><a href='UpdateOrder.php?Product_id=" + id + "' class='btn btn-dark'>Update</a>"

                    }, function() {
                        $.ajax({
                            type: "POST",
                            url: "action/updatestatusorder.php?id=" + id,
                            data: 'Status=' + vals,

                            success: function(data) {

                                swal({
                                    title: "Status Updated",
                                    // text: "Status Updated",
                                    type: "success"
                                },
                            function() {
                        
                                location.replace("http://localhost/corephp/CustomerManagement.php");

                            }
                        );
                                // location.replace("http://localhost/corephp/CustomerManagement.php");

                            }
                        });
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "action/updatestatusorder.php?id=" + id,
                        data: 'Status=' + vals,

                        success: function(data) {

                            swal({
                                title: "Status Updated",
                                // text: "Status Updated",
                                type: "success"
                            },
                            function() {
                        
                                location.replace("http://localhost/corephp/CustomerManagement.php");

                            }
                        );
                            // location.replace("http://localhost/corephp/CustomerManagement.php");
                        }
                    });
                }
            }
        }
    </script>
</body>

</html>