

<?php
$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if (isset($_POST['mail_id'])) {

    $mid=$_POST['mail_id'];

    $sup="update mail set status='read' where id=$mid";
    $qup=mysqli_query($con,$sup);

    $sql="select * from mail where id=$mid";
    $qm=mysqli_query($con,$sql);

    $mailout="";

    while($rm=mysqli_fetch_array($qm)){

      $sid=$rm['sender'];
      $by=$rm['bya'];
      $msg=$rm['message'];
      $dt=$rm['date'];
      $sub=$rm['subject'];
      $att=$rm['attachment'];

      if($sid=="admin"){
        $sname="Admin";
      }
      
      else{
        $sid=intval($rm['sender']);
        $ex="select * from $by where id=$sid";
        $qex=mysqli_query($con,$ex);

        while($rex=mysqli_fetch_array($qex)){
            $sname=$rex['firstname']." ".$rex['lastname'];
        }
      }

      if($att=="N/A"){
      $mailout.="
          <div class='up'>
            <div class='lft'>

              <p>From : <span>$sname </span></p>
              <p>Date : <span>$dt </span></p>

            </div>
            <div class='rgt'>
              <p>Reference ID : <span>$mid </span></p>
              <p>Attachment : N/A</p>
            </div>
          </div>

          <div class='down'>
            <h3>Subject : <span>$sub</span></h3>
            <p>
                $msg
            </p>

          </div>
      ";
      }
      
      else{

      $mailout.="
          <div class='up'>
            <div class='lft'>

              <p>From : <span>$sname </span></p>
              <p>Date : <span>$dt </span></p>

            </div>
            <div class='rgt'>
              <p>Reference ID : <span>$mid </span></p>
              <p>Attachment : <button onclick='downloadFile($mid)'><i class='fas fa-download'>&nbsp;</i>Download</button></p>
            </div>
          </div>

          <div class='down'>
            <h3>Subject : <span>$sub</span></h3>
            <p>
                $msg
            </p>

          </div>
      ";

      }

    }

    echo"$mailout";

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
            window.location.href = '../Admin/downloadmail.php?file_id=' + fileId;
        }
    </script>
</body>
</html>