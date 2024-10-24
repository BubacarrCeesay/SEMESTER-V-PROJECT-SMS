
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if(isset($_GET['removeid'])){

    $did=$_GET['removeid'];
    $dq="delete from teacher where id='$did'";

    $dr=mysqli_query($con,$dq);

    if($dr){
            $_SESSION['update_success'] = "deleted";
            header("Location: viewteacher.php");
            exit();


    }

    else{
         
            $_SESSION['update_success'] = "notdeleted";
            header("Location: viewteacher.php");
            exit();


    }
}

?>