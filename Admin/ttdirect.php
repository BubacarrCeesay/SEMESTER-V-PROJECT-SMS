
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if(isset($_GET['removeid'])){

    $def="N/A";
    $did=$_GET['removeid'];
    $dq="update division set timetable='$def' where id='$did'";

    $dr=mysqli_query($con,$dq);

    if($dr){
            $_SESSION['update_success'] = "subdeleted";
            header("Location: managesyll.php");
            exit();


    }

    else{
         
            $_SESSION['update_success'] = "subnotdeleted";
            header("Location: managesyll.php");
            exit();


    }
}

?>