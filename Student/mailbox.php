
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}

if(isset($_SESSION['student'])){

    $username=$_SESSION['student'];

    $query="select * from student where username='$username'";

    $result=mysqli_query($con, $query);

    while($row=mysqli_fetch_array($result)){
    
    $fname=$row['firstname'];
    $lname=$row['lastname'];
     $sid=$row['id'];
      $did=$row['divId'];
      $cls=$row['classId'];
    $email=$row['email'];
    $cont=$row['contact'];
    $addr=$row['address'];

    $profile=$row['profile'];

}
}


$qr = "SELECT * FROM class ORDER BY id";
$res = mysqli_query($con, $qr);
$classout = "";

while ($rw = mysqli_fetch_assoc($res)) {
    $classout .= "<option value='" . $rw['id'] . "'>" . $rw['name'] . "</option>";
}


$ex=mysqli_query($con,"select * from mail where receiver='$sid' and status='notread'");
$totalunr=mysqli_num_rows($ex);



?>

<?php

$sql="select * from mail where receiver='$sid' order by date DESC";

$qm=mysqli_query($con,$sql);

$mailout="";

    while($rm=mysqli_fetch_array($qm)){

      $snid=$rm['sender'];
      $by=$rm['bya'];
      $mid=$rm['id'];
      $st=$rm['status'];

      if($snid=="admin"){
        $sname="Admin";
      }
      
      else{
        $snid=intval($rm['sender']);
        $ex="select * from $by where id=$snid";
        $qex=mysqli_query($con,$ex);

        while($rex=mysqli_fetch_array($qex)){
            $sname=$rex['firstname']." ".$rex['lastname'];
        }
      }

      if ($st=="notread"){
        $mailout.="
              <div class='mailinfo' data-mail-id='$mid'><p style='color:red; font-weight:bold;'>* $sname </p> <span>$by</span></div>
              <hr/>
        ";
      }
      else{
        $mailout.="
              <div class='mailinfo' data-mail-id='$mid'><p> $sname </p> <span>$by</span></div>
              <hr/>
        ";
      }

    }


?>



<?php

if(isset($_POST['send'])){

    $sub=$_POST['sub'];
    $rec=$_POST['receiver'];
    $msg=$_POST['msg'];
    $attch=$_POST['attch'];

if(isset($_FILES['attch']) && $_FILES['attch']['error'] == 0){

  $attch = basename($_FILES['attch']['name']);

  $qr="INSERT INTO mail(bya, sender, receiver, subject, message, date, attachment, status) VALUES ('student','$sid','$rec','$sub','$msg',NOW(),'$attch','notread')";

  $res=mysqli_query($con, $qr);

    if ($res) {
        $_SESSION['update_success'] = "send";
        move_uploaded_file($_FILES['attch']['tmp_name'], "../Admin/files/$attch");
    } else {
        $_SESSION['update_success'] = "notsend";
    }

    header("Location: mailbox.php");
    exit();

}

else{

  $qr="INSERT INTO mail(bya, sender, receiver, subject, message, date,status) VALUES ('student','$sid','$rec','$sub','$msg',NOW(),'notread')";

  $res=mysqli_query($con, $qr);

    if ($res) {
        $_SESSION['update_success'] = "send";
    } else {
        $_SESSION['update_success'] = "notsend";
    }

    header("Location: mailbox.php");
    exit();
}


}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student | Mail Box </title>
    <link rel="website icon" type="" href="../Admin/logo.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../Admin/adindex.css" />
  </head>
  <body>

    <div id="customAlert">
        <p id="alertMessage"></p>
        <button onclick="closeAlert()">OK</button>
    </div>

    <div class="upper">
        <img src="logo.png" alt="#">
        <a href="logout.php"><button><i class="fa-solid fa-right-from-bracket"></i> Logout</button></a>
    </div>

    <div class="canshow">

        <span class="fas fa-bars">

    </div>

    <nav class="nav">
      <div class="top">
            <?php
             echo"<img src='files/$profile' alt='' />";
            ?>
        <div class="text">
          <p class="name"><?php echo"$fname $lname"; ?></p>
          <p class="pson"><i class="fa-solid fa-circle"></i> Student</p>
        </div>
      </div>

      <ul>
        <li>
          <a href="dashboard.php"
            ><i class="fa-solid fa-gauge"></i> Dashboard</a
          >
        </li>

        <li>
          <a href="#" class="prof-btn"
            ><i class="fa-regular fa-user"></i> Student
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="editprofile.php"><i class="fa-solid fa-user-pen"></i> Edit Profile</a>
            </li>
            <li>
              <a href="changepass.php"><i class="fa-solid fa-unlock"></i> Change Password</a>
              
            </li>
          </ul>
        </li>

      <li>
          <a href="#" class="prof-btn"
            ><i class="fa-solid fa-school"></i> Classroom
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="myclass.php"><i class="fa-solid fa-door-open"></i> Class Info </a>
            </li>
            <li>
              <a href="mysub.php"><i class="fa-solid fa-book"></i> My Subjects</a>
              
            </li>

          </ul>
      </li>

      <li>
          <a href="#" class="prof-btn"
            ><i class="fa-solid fa-chalkboard-user"></i></i> Parent
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">

            <li>
              <a href="viewparent.php"><i class="fa-regular fa-eye"></i></i>My Parent</a>
              
            </li>

          </ul>
        </li>

      <li>
          <a href="#" class="prof-btn"
            ><i class="fa-regular fa-file"></i> Exam Section
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="timetable.php"><i class="fa-solid fa-table"></i>Timetable</a>
              
            </li>
            <li>
              <a href="viewmark.php"><i class="fa-regular fa-eye"></i> View Mark</a>
            </li>
            <li>
              <a href="marksheet.php"><i class="fas fa-print"></i> Marksheet</a>
            </li>
          </ul>
      </li>

      <li>
          <a href="#" class="prof-btn"
            ><i class="fa-solid fa-book-open"></i> Education
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="viewsyll.php"><i class="fa-regular fa-note-sticky"></i>Syllabus & Timetable</a>   
            </li>
            <li>
              <a href="studymaterial.php"><i class="fa-regular fa-file-pdf"></i>Study Material</a>
              
            </li>
            <li>
              <a href="assignment.php"><i class="fas fa-file-pdf"></i></i>Assignment</a>
              
            </li>
          </ul>
      </li>  
      

        <li>
          <a href="notice.php"
            ><i class="fa-solid fa-volume-high"></i> Notice Board</a
          >
        </li>

        <li>
          <a href="mailbox.php" id="active"
            ><i class="fa-solid fa-envelope"></i> Mail Box</a
          >
        </li>

        
      </ul>
    </nav>
    <main class="main">

      <section  class="head">
          <h1>MAILBOX </h1>
          <hr/>
      </section>
      <section class="alladm" id="mailhead">
        <h3><i class="fa-solid fa-inbox"></i> INBOX ➡️ <span><?php echo"$totalunr"; ?></span></h3>
        <a id="compose"><button> Compose Mail </button></a>
      </section>
      <br/>
      <hr/>

        <section class="mailsec" id="mailsec">

          <section class="left">

          <?php
              echo"$mailout";
          ?>


          </section>

          <section class="right" id="rightmails">
          </section>

        </section>

    </main>
  </body>

  <script src="../Admin/jsfile.js"></script>

  <script>

          function showAlert(message) {
            var alertBox = document.getElementById("customAlert");
            var alertMessage = document.getElementById("alertMessage");

            alertMessage.textContent = message;
            alertBox.style.display = "block";
          }

          function closeAlert() {
            var alertBox = document.getElementById("customAlert");
            alertBox.style.display = "none";
          }

            window.onload = function() {
            <?php

            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="send") {
                echo "showAlert('✅ Mail Successfully Send!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notsend") {
                echo "showAlert('⚠️ Error, Mail Not Send!');";
                unset($_SESSION['update_success']);
            }

            ?>
        };
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    $(document).ready(function() {


    $(document).on('click', '.mailinfo', function() {
        var mailId = $(this).data('mail-id');
        if (mailId) {
            $.ajax({
                type: 'POST',
                url: 'getmail.php',
                data: { mail_id: mailId },
                success: function(response) {
                    $('#rightmails').html(response);
                }
            });
        }
    });

    $('#compose').click(function() {
            $.ajax({
                type: 'POST',
                url: 'composemail.php',
                data: {},
                success: function(response) {
                    $('#rightmails').html(response);
                }
            });
    });    


    });


    </script>

</html>
