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
        
            $student_name =$row['id'] ." => ".$row['firstname'] . " " . $row['lastname'];
            echo "<option value='" . $row['id'] . "'>" . $student_name . "</option>";

    }
}
?>
