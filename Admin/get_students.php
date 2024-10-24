<?php
$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if (isset($_POST['class_id']) && isset($_POST['division_id'])) {
    $class_id = $_POST['class_id'];
    $division_id = $_POST['division_id'];

    $query = "SELECT id, firstname, lastname FROM student WHERE classId = '$class_id' AND divId = '$division_id'";
    $result = mysqli_query($con, $query);

    echo "<option value=''>Select Name</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        $sid=$row['id'];
        
        $qr = "SELECT * FROM parent WHERE studentId = '$sid'";
        $res = mysqli_query($con, $qr);
        
        if(mysqli_num_rows($res)>0){
            
            $student_name =$row['id'] ." => ".$row['firstname'] . " " . $row['lastname'];
            echo "<option style='background-color: red;' value='ass'>" . $student_name . "</option>";            
        }

        else{
            $student_name =$row['id'] ." => ".$row['firstname'] . " " . $row['lastname'];
            echo "<option value='" . $row['id'] . "'>" . $student_name . "</option>";
        }

    }
}
?>
