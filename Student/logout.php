<?php

session_start();

if(isset($_SESSION['student']))
{
    unset($_SESSION['student']);

    header("Location: ../Home/studlogin.php");
    exit();
}
else{
    echo"<script>alert('Oops😑! Something Went Wrong...');</script>";
}


?>