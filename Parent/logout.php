<?php

session_start();

if(isset($_SESSION['parent']))
{
    unset($_SESSION['parent']);

    header("Location: ../Home/parentlogin.php");
    exit();
}
else{
    echo"<script>alert('Oops😑! Something Went Wrong...');</script>";
}


?>