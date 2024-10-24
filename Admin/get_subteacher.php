<?php
$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if (isset($_POST['class_id']) && isset($_POST['division_id']) && isset($_POST['subject_id'])) {
    $class_id = $_POST['class_id'];
    $division_id = $_POST['division_id'];
    $subject_id = $_POST['subject_id'];

    $query = "SELECT * from teacher";
    $result = mysqli_query($con, $query);

    echo "<option value=''>Select Teacher</option>";
    while ($row = mysqli_fetch_assoc($result)) {

        $sid=$row['id'];
        
        $qr = "SELECT * FROM subject WHERE teacherId = '$sid' and id='$subject_id' and classId='$class_id' and divId='$division_id'";
        $res = mysqli_query($con, $qr);
        
        if(mysqli_num_rows($res)>0){
            
            $tch_name =$row['id'] ." => ".$row['firstname'] . " " . $row['lastname'];
            echo "<option style='background-color: red;' value='ass'>" . $tch_name . "</option>";            
        }

        else{
            $tch_name =$row['id'] ." => ".$row['firstname'] . " " . $row['lastname'];
            echo "<option value='" . $row['id'] . "'>" . $tch_name . "</option>";
        }

    }
}
?>
