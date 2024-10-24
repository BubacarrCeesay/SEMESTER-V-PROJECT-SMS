<?php
$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if (isset($_POST['class_id']) && isset($_POST['division_id'])) {
    $class = $_POST['class_id'];
     $div = $_POST['division_id'];

    $query = "select * from material where classId = '$class' and divId = '$div'";

    $result = mysqli_query($con, $query);

    $output="";

    if(mysqli_num_rows($result)>0){
        while($val=mysqli_fetch_array($result)){
            $div=$val['id'];
            $type=$val['type'];
            $date=$val['date'];
            $sub=$val['subject'];
            $file=$val['upfile'];
            $by=$val['bya'];
            $des=$val['descrip'];


                    $output.="
                        <tr>
                        <td>$sub</td>
                        <td>$by</td>
                        <td>$type</td>
                        <td>$des</td>
                        <td>$date</td>
                                <td><button onclick='downloadFile($div)' id='app'>Download<i class='fa-solid fa-download'></i></button>
                                <a href='matdirect.php?removeid=$div'><button id='rej'>Delete<i class='fa-regular fa-rectangle-xmark'></i></button></a></td>
                    ";
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
            window.location.href = 'downloadmatt.php?file_id=' + fileId;
        }
    </script>
</body>
</html>

