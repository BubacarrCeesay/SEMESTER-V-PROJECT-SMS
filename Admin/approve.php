
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

if(isset($_GET['viewid'])){

    $rid=intval($_GET['viewid']);

    $_SESSION['vwid']=$rid;


}

?>

<?php

    $aid=intval($_SESSION['vwid']);

    $qc="select * from enroll where id=$aid";

    $qc=mysqli_query($con,$qc);

    if (mysqli_num_rows($qc) > 0) {
        while ($rs = mysqli_fetch_array($qc)) {

            $prf = $rs['profile'];
            $em = $rs['email'];
            $cln = $rs['class'];
            $gen = $rs['gender'];
            $ad = $rs['address'];
            $cont=$rs['contact'];
            $uname=$rs['username'];
            $ps=$rs['password'];
            $dob=$rs['dob'];
            $fn = $rs['fname'];
            $ln=$rs['lname'];

        }
    }


$qr = "SELECT * FROM class where name='$cln'";
$res = mysqli_query($con, $qr);

while ($rw = mysqli_fetch_assoc($res)) {
    $cls=$rw['id'];
}

$qr = "SELECT * FROM division where classId='$cls'";
$res = mysqli_query($con, $qr);
$classout = "";

while ($rw = mysqli_fetch_assoc($res)) {
    $classout .= "<option value='" . $rw['id'] . "'>" . $rw['div_name'] . "</option>";
}


if(isset($_POST['reject'])){


    $feedback=$_POST['feedback'];
    $rollno=$_POST['rollno'];
    $div=intval($_POST['division']);

    $qc="select * from student where classId='$cls' and divId='$div'";
    $rc=mysqli_query($con,$qc);

    while($rwc=mysqli_fetch_array($rc)){

      if(intval($rwc['rollno'])==$rollno){
        $_SESSION['update_success'] = "roll";
            header("Location: enroll.php");
            exit();
      }
    }

    $qy="INSERT INTO student(firstname, lastname, rollno, username, password, email, address, contact, dob, gender,profile,classId,divId) VALUES ('$fn','$ln',$rollno,'$uname','$ps','$em','$ad','$cont','$dob','$gen','$prf','$cls','$div')";

    $rs = mysqli_query($con, $qy);

    $sql="UPDATE enroll SET status='approve',feedback='$feedback' WHERE id=$aid";


    $dr=mysqli_query($con,$sql);


    if($dr && $rs){

            $_SESSION['update_success'] = "approve";
            header("Location: enroll.php");
            exit();


    }

    else{
         
            $_SESSION['update_success'] = "error";
            header("Location: enroll.php");
            exit();


    }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Enrollments</title>
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
          <a href="#" class="prof-btn" id="active"
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
          <a href="mailbox.php"
            ><i class="fa-solid fa-envelope"></i> Mail Box</a
          >
        </li>
        
      </ul>
    </nav>

    <main class="main">
    <section>
         <br/><br/>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="frmdown" id="filterform">
        
          <div class="field">
            <label>Assign Division :</label>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="division" required>
                <option value="">Select Division</option>
                <?php echo"$classout"; ?>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Roll Number :</label><br/><br/>
                <input type="number" placeholder="Enter Roll Number" name="rollno" autocomplete="off">
          </div>  

          <div class="field">
            <label>FeedBack / Reason :</label><br/><br/>
                <input type="text" placeholder="Enter Feedback / Reason" name="feedback" autocomplete="off">
          </div>  
          
        <p class="sbtfrm" id="filsub">
          <input type="submit" value="Confirm" name="reject" />
        </p>
        </form>
    </section>

    </main>
  </body>
  <script src="jsfile.js"></script>

</html>
