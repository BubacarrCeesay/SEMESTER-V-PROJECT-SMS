<?php

session_start();

if(isset($_SESSION['admin']))
{
    unset($_SESSION['admin']);


    header("Location: ../Home/adminlogin.php");
    exit();
}
else{
    echo"<script>alert('Oops😑! Something Went Wrong...');</script>";
}


?>