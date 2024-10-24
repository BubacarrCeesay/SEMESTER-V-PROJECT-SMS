<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}

if(isset($_SESSION['teacher'])){

    $username=$_SESSION['teacher'];

    $query="select * from teacher where username='$username'";

    $result=mysqli_query($con, $query);

    while($row=mysqli_fetch_array($result)){
    $tid=$row['id'];
}



}

if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];

    $qs = "select * from subject where classId = '$class_id' and teacherId='$tid'";
    $res = mysqli_query($con, $qs);
    echo "<option value=''>Select Division</option>";
    while ($row = mysqli_fetch_assoc($res)) {
        $div=$row['divId'];
        $query = "select * from division where classId = '$class_id' and id='$div'";
            $result = mysqli_query($con, $query);
            while ($rw = mysqli_fetch_assoc($result)) {
                $dname=$rw['div_name'];
            }
        echo "<option value='" . $row['divId'] . "'>" . $dname . " </option>";
    }

    
}
?>
