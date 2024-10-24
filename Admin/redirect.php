
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if(isset($_GET['removeid'])){

    $did=$_GET['removeid'];
    $dq="delete from student where id='$did'";
    $dd="delete from parent where studentId='$did'";

    $dr=mysqli_query($con,$dq);
    $qd=mysqli_query($con,$dd);

    if($dr && $qd){
            $_SESSION['update_success'] = "deleted";
            header("Location: viewstudent.php");
            exit();


    }

    else{
         
            $_SESSION['update_success'] = "notdeleted";
            header("Location: viewstudent.php");
            exit();


    }
}

?>