<?php
$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if (isset($_POST['class_id']) && isset($_POST['division_id'])) {
    $class = $_POST['class_id'];
     $div = $_POST['division_id'];

    $query = "select * from division where classId = '$class' and id = '$div'";

    $result = mysqli_query($con, $query);

    $output="";

    if(mysqli_num_rows($result)>0){
        while($val=mysqli_fetch_array($result)){

            $name=$val['timetable'];

            if($name=="N/A"){

                    $output.="
                            <tr>
                            <td colspan='2'>Timetable Not Uploaded!</td>
                            </tr>
                        ";  

            }

            else{
                    $output.="
                        <tr>
                        <td>$name</td>
                                <td><button onclick='downloadFile($div)' id='app'>Download<i class='fa-regular fa-eye'></i></button>
                                <a href='ttdirect.php?removeid=$div'><button id='rej'>Delete<i class='fa-regular fa-rectangle-xmark'></i></button></a></td>
                        </tr>
                    ";
            }
        }
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
            window.location.href = 'downloadsyll.php?file_id=' + fileId;
        }
    </script>
</body>
</html>

