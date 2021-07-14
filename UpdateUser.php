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
$Id = $_GET['User_id'];
$sql = "SELECT * FROM `Users` where id = '$Id' ";
$result = $con->query($sql);
$row = $result->fetch_assoc();

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
                <form action="action/Updatuser.php?id=<?php echo $Id ;?>" method="post" class="mt-4" enctype="multipart/form-data">
          <div class="row mt-4">
            <div class="col-md-6 mt-2 ">
              <label for="inputPassword5" class="form-label">Full Name</label>
              <input type="text" name="Full_Name" value="<?php echo $row['Full_Name'] ;?>" id="inputPassword5" required class="form-control" aria-describedby="passwordHelpBlock">
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <label for="inputPassword5" class="form-label">Email</label>
              <input type="email" name="email" id="inputPassword5" value="<?php echo $row['email'] ;?>" required class="form-control" aria-describedby="passwordHelpBlock">
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <label for="inputPassword5" class="form-label">Password</label>
              <input type="text" name="password" id="inputPassword5" value="<?php echo $row['password'] ;?>" required class="form-control" aria-describedby="passwordHelpBlock">
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <label for="inputPassword5" class="form-label">User Type</label>
              <select class="form-select" required name="Type"  aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option <?php echo ($row['Type'] == "admin" ? "selected" : "" );?> value="admin">Admin</option>
                <option <?php echo ($row['Type'] == "Tailor" ? "selected" : "" );?>value="Tailor">Tailor</option>
                <option <?php echo ($row['Type'] == "Manager" ? "selected" : "" );?> value="Manager">Manager</option>
              </select>
              <div id="passwordHelpBlock" class="form-text d-none">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
            </div>
            
            
            
           
            <!-- end Row -->
          </div>
          <center>
          <a href="UserManagement.php" class="mt-4 btn btn-dark">Go To List</a>

            <button class="btn btn-dark" type="submit" style="margin-top: 3%;">Update</button>
          </center>
      </div>
      <div class="col-md-2 mt-4">
        <?php if ($Message) {

          echo $Message;
          
        }  ?>
      </div>
      </form>
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