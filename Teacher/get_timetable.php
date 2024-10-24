<?php
$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if (isset($_POST['exm_Id'])) {
    $eid = $_POST['exm_Id'];

    $query = "select * from exam where id =$eid";

    $result = mysqli_query($con, $query);

    $output="";

    if(mysqli_num_rows($result)>0){
        while($val=mysqli_fetch_array($result)){

            $pd=$val['pdate'];
            $name=$val['name'];

            if($pd=="N/A"){

                $output.="
                <tr>
                <td colspan='3'> Timetable Not Uploaded!</td>
                </tr>
            ";     

            }

            else{

            $output.="
                <tr>
                <td>$name</td>
                <td>$pd</td>
                <td><button onclick='downloadFile($eid)' id='app'> Save <i class='fa-solid fa-download'></i></button>
                </tr>
            ";

            }
        }
    }
    else{
            $output.="
                <tr>
                <td colspan='3'>No Exam Added Yet!</td>
                </tr>
            ";     
    }

    echo"$output";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download File</title>
</head>
<body>

    <script>
        function downloadFile(fileId) {
            window.location.href = '../Admin/downloadtt.php?file_id=' + fileId;
        }
    </script>
</body>
</html>