<?php
session_start();
if(isset($_SESSION['USER']))
{
    unset($_SESSION['USER']);
    $path="location: ./home.php";
    header($path);
}

?>