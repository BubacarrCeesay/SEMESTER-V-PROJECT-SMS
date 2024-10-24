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

if (isset($_POST['class_id']) && isset($_POST['division_id'])) {
    $class = $_POST['class_id'];
     $div = $_POST['division_id'];

    $query = "select * from subject where classId = '$class' and divId = '$div' and teacherId='$tid'";

    $result = mysqli_query($con, $query);

    echo "<option value=''>Select Subject</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }

}
?>
