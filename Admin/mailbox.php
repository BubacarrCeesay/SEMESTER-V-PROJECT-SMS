
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}

if(isset($_SESSION['admin'])){

    $username=$_SESSION['admin'];

    $query="select * from admin where username='$username'";

    $result=mysqli_query($con, $query);

    while($row=mysqli_fetch_array($result)){
    
    $ad_name=$row['fullname'];

    $profile=$row['profile'];

}

}

$qr = "SELECT * FROM class ORDER BY id";
$res = mysqli_query($con, $qr);
$classout = "";

while ($rw = mysqli_fetch_assoc($res)) {
    $classout .= "<option value='" . $rw['id'] . "'>" . $rw['name'] . "</option>";
}


$ex=mysqli_query($con,"select * from mail where receiver='admin' and status='notread'");
$totalunr=mysqli_num_rows($ex);



?>

<?php

$sql="select * from mail where receiver='admin' order by date DESC";

$qm=mysqli_query($con,$sql);

$mailout="";

    while($rm=mysqli_fetch_array($qm)){

      $sid=intval($rm['sender']);
      $by=$rm['bya'];
      $mid=$rm['id'];
      $st=$rm['status'];
      

      $ex="select * from $by where id=$sid";
      $qex=mysqli_query($con,$ex);

      while($rex=mysqli_fetch_array($qex)){
          $sname=$rex['firstname']." ".$rex['lastname'];
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

  $qr="INSERT INTO mail(bya, sender, receiver, subject, message, date, attachment, status) VALUES ('admin','admin','$rec','$sub','$msg',NOW(),'$attch','notread')";

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

  $qr="INSERT INTO mail(bya, sender, receiver, subject, message, date,status) VALUES ('admin','admin','$rec','$sub','$msg',NOW(),'notread')";

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
    <title>Admin | MailBox </title>
    <link rel="website icon" type="" href="logo.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="adindex.css" />
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
          <p class="name"><?php echo"$ad_name"; ?></p>
          <p class="pson"><i class="fa-solid fa-circle"></i> Admin</p>
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
            ><i class="fa-regular fa-user"></i> Admin
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
            ><i class="fa-solid fa-user-graduate"></i> Student
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="addstudent.php"><i class="fa-solid fa-user-plus"></i> Add Student</a>
            </li>
            <li>
              <a href="viewstudent.php"><i class="fa-regular fa-eye"></i></i> View Student</a>
              
            </li>

            <li>
              <a href="enroll.php"><i class="fa-solid fa-file-import"></i> Enrollments</a>
              
            </li>
          </ul>
        </li>


      <li>
          <a href="#" class="prof-btn"
            ><i class="fa-solid fa-chalkboard-user"></i> Teacher
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="addteacher.php"><i class="fa-solid fa-user-plus"></i> Add Teacher</a>
            </li>
            <li>
              <a href="viewteacher.php"><i class="fa-regular fa-eye"></i></i> View Teacher</a>
              
            </li>
          </ul>
      </li>

      <li>
          <a href="#" class="prof-btn"
            ><i class="fa-solid fa-children"></i> Parent
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="addparent.php"><i class="fa-solid fa-user-plus"></i> Add Parent</a>
            </li>
            <li>
              <a href="viewparent.php"><i class="fa-regular fa-eye"></i></i> View Parent</a>
              
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
              <a href="manageclass.php"><i class="fa-solid fa-door-open"></i> Manage Class</a>
            </li>
            <li>
              <a href="managesub.php"><i class="fa-solid fa-book"></i> Manage Subject</a>
              
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
              <a href="manageexam.php"><i class="fa-regular fa-copy"></i> Manage Exam</a>
            </li>
            <li>
              <a href="managetimetable.php"><i class="fa-solid fa-table"></i> Manage Timetable</a>
              
            </li>
          </ul>
      </li>

      <li>
          <a href="#" class="prof-btn"
            ><i class="fa-solid fa-file"></i> Exam Result
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="insertmark.php"><i class="fa-solid fa-file-circle-plus"></i> Insert Marks</a>
            </li>
            <li>
              <a href="viewresult.php"><i class="fa-regular fa-eye"></i> View Result</a>
            </li>

            <li>
              <a href="editresult.php"><i class="fa-solid fa-file-pen"></i> Edit Result</a>
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
              <a href="managesyll.php"><i class="fa-regular fa-note-sticky"></i>Syllabus & Timetable</a>   
            </li>
            <li>
              <a href="studymaterial.php"><i class="fa-regular fa-file-pdf"></i> Study Materials</a>
              
            </li>
          </ul>
      </li>  
      
      <li>
          <a href="#" class="prof-btn"
            ><i class="fa-solid fa-money-check-dollar"></i> Accounting
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="managefees.php"><i class="fa-solid fa-sack-dollar"></i> Manage Fees</a>   
            </li>
            <li>
              <a href="feespayment.php"><i class="fa-solid fa-hand-holding-dollar"></i> Fees Payment</a>
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
          <h1>MAIL BOX</h1>
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

  <script src="jsfile.js"></script>

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
