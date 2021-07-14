<?php
include_once('dbcon.php');

session_start();
 $Username = $_REQUEST['Username'];
 $password = $_REQUEST['password'];
$sql = "SELECT * FROM `users` where email = '$Username' ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['password'] == $password && $row['flag'] == "N") {
        $_SESSION['USER']=$row;
        $path = "location: ../home.php";
        header($path);
    } else {
        $_SESSION['Message'] = "Password not Matched or May be Blocked";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
} else {
    $_SESSION['Message'] = "No User Exist";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
