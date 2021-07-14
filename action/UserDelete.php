<?php
include_once('dbcon.php');

session_start();
$id = $_REQUEST['User_id'];
if ($_SESSION['USER']['Type'] == "admin") {
    $sql = "DELETE FROM Users WHERE id=$id";

    if ($con->query($sql) === TRUE) {
        $_SESSION['Message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>User deleted successfully</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        $_SESSION['Message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Error deleting record:  </strong> '.$sql.' <br> '.$con->error.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    $con->close();
} else {
    $_SESSION['Message'] = "You are NOt Allowed only Admin can!";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
