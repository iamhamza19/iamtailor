<?php
session_start();
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <title>i'm Tailor | Home </title>
</head>

<body>
  <!--  -->
  <?php include_once('action/nav.php'); ?>
  <!--  -->
  <div class="container">

    <div class="row">
      <div class="offset-2 col-md-8">
        <center>
          <h3 class="mt-4">Add Customer</h3>
        </center>
        <center>
          <p class="mt-1">Please Provide information Below</p>
        </center>
        <center>
          <div class="col-4">
            <hr>
          </div>
        </center>
        <form action="action/customer.php" method="post" class="mt-4" enctype="multipart/form-data">
          <div class="row mt-4">
            <div class="col-md-6 mt-2 ">
              <label for="inputPassword5" class="form-label">Order Id</label>
              <input type="text" name="Order_Id" id="inputPassword5" required class="form-control" aria-describedby="passwordHelpBlock">
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <label for="inputPassword5" class="form-label">Customer Name</label>
              <input type="text" name="Customer_Name" id="inputPassword5" required class="form-control" aria-describedby="passwordHelpBlock">
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <label for="inputPassword5" class="form-label">Product Type</label>
              <select class="form-select" required name="Product_Type" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="Complete Suit">Complete Suit</option>
                <option value="Shalwar">Shalwar</option>
                <option value="Kurta">Kurta</option>
                <option value="Pent">Pent</option>
                <option value="Coat">Coat</option>
                <option value="Shirt">Shirt</option>
                <option value="Waistcoat">Waistcoat</option>
                <option value="Complete Pen Coat">Complete Pen Coat</option>
              </select>
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <div class="mb-3">
                <label for="formFile" class="form-label">Select Image of Product</label>
                <input class="form-control" type="file" name="Image_Product" id="formFile">
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <div class="mb-3">
                <label for="formFile" class="form-label">Picking Order Date</label>
                <input class="form-control" value="<?php echo date('Y-m-d'); ?>" type="date" name="Order_Date" id="formFile">
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <div class="mb-3">
                <label for="formFile" class="form-label">Order Delivery Date</label>
                <input class="form-control" type="date" required name="Delivery_Date" id="formFile">
              </div>
            </div>
            <div class="col-md-6 mt-2 ">
              <label for="inputPassword5" class="form-label">Total Payment</label>
              <input type="number" name="Total_Payment" id="total" onchange="calculations()" required class="form-control" aria-describedby="passwordHelpBlock">
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            <div class="col-md-6 mt-2 ">
              <label for="inputPassword5" class="form-label">Advance Amount</label>
              <input type="number" name="Advance_Amount" id="advance" onchange="calculations()" required class="form-control" aria-describedby="passwordHelpBlock">
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            <div class="col-md-6 mt-2 ">
              <label for="inputPassword5" class="form-label">Paid Amount</label>
              <input type="number" name="paid" id="paid"  readonly class="form-control" aria-describedby="passwordHelpBlock">
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            <div class="col-md-6 mt-2 ">
              <label for="inputPassword5" class="form-label">Pendening Amount</label>
              <input type="number" name="Pendening_Amount" id="pendening" class="form-control" readonly aria-describedby="passwordHelpBlock">
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            <!-- end Row -->
          </div>
          <center>
            <button class="btn btn-dark" type="submit" style="margin-top: 3%;">Save</button>
            <?php
            if (isset($_SESSION['USER'])){
            if($_SESSION['USER']['Type']=="admin")
            {?>
                            <a href="CustomerManagement.php" class="mt-4 btn btn-dark">Go To List</a>

            <?php }} ?>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script>

      function calculations() {
            const total = parseInt($("#total").val());
            const Advance = parseInt($("#advance").val());
            $("#paid").val(Advance);
            $("#pendening").val(total - Advance );
           // alert(total - (paid + Advance));

        

    }
  </script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>