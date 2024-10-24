<?php

session_start();

if(isset($_SESSION['teacher']))
{
    unset($_SESSION['teacher']);

    header("Location: ../Home/teacherlogin.php");
    exit();
}
else{
    echo"<script>alert('Oops😑! Something Went Wrong...');</script>";
}


?>