<?php
$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    $query = "select * from division where classId = '$class_id'";
    $result = mysqli_query($con, $query);

    echo "<option value=''>Select Division</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['id'] . "'>" . $row['div_name'] . "</option>";
    }
}
?>
