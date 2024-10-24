<?php

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['file_id'])) {

    $file_id = intval($_GET['file_id']);
    
    $q="select * from notice where id=$file_id";

    $sq=mysqli_query($con,$q);

    if (mysqli_num_rows($sq)>0) {

        while($rs=mysqli_fetch_array($sq)){

        $file = $rs['attachment'];
        $filepath = "files/$file";

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath); 
            exit;
        } else {
            echo "File does not exist.";
        }

    } 

    }
    
    else {
        echo "No file found with that ID.";
    }

    $stmt->close();
}
?>
