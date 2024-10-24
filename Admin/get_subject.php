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

    $output="";

    if(mysqli_num_rows($result)>0){
        while($val=mysqli_fetch_array($result)){

            $id=$val['id'];
            $name=$val['name'];

            $output.="
                <tr>
                <td>$id</td>
                <td>$name</td>
                </tr>
            ";
        }
    }
    else{
            $output.="
                <tr>
                <td colspan='2'>No Subject Added Yet!</td>
                </tr>
            ";     
    }

    echo"$output";
}
?>
