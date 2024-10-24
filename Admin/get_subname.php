<?php
$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if (isset($_POST['class_id']) && isset($_POST['division_id'])) {
    $class = $_POST['class_id'];
     $div = $_POST['division_id'];

    $query = "select * from subject where classId = '$class' and divId = '$div'";

    $result = mysqli_query($con, $query);

    echo "<option value=''>Select Subject</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }

}
?>
