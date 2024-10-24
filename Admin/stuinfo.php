
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if(isset($_GET['viewid'])){

    $sid=$_GET['viewid'];

    $sql="select * from student where id=$sid";

    $r=mysqli_query($con,$sql);

    if(mysqli_num_rows($r)==1){
        while($rs= mysqli_fetch_array($r)){

            $prf=$rs['profile'];
             $roll=$rs['rollno'];
              $em=$rs['email'];
            $sid=$rs['id'];
            $un=$rs['username'];
             $cl=$rs['classId'];
              $di=$rs['divId'];
              $gen=$rs['gender'];
              $ad=$rs['address'];
              $ct=$rs['contact'];
              $dob=$rs['dob'];
            $fullname=$rs['firstname']." ".$rs['lastname'];

            $qy="select * from class where id=$cl";
            $rcl=mysqli_query($con,$qy);

            $qd="select * from division where id=$di and classId=$cl";
            $rd=mysqli_query($con,$qd);


            if((mysqli_num_rows($rcl) > 0) && (mysqli_num_rows($rd) >0)){
                $rco= mysqli_fetch_array($rcl);
                $rdo= mysqli_fetch_array($rd);
                $d=$rdo['div_name'];
                $c=$rco['name'];
            }

        }

        

}

    $sl="select * from parent where studentId=$sid";

    $rl=mysqli_query($con,$sl);

    if(mysqli_num_rows($rl)==1){
        while($rsl= mysqli_fetch_array($rl)){

            $pem=$rsl['email'];
            $pc=$rsl['contact'];
            $pname=$rsl['firstname']." ".$rsl['lastname'];
        }       
    }

    else{
            $pem="N\A";
            $pc="N\A";
            $pname="N\A";      
    }

}

?>

<?php

if (isset($_SESSION['admin'])) {
    $username = $_SESSION['admin'];

    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        $ad_name = $row['fullname'];
        $profile = $row['profile'];
    }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | View Student Profile</title>
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
      <section  class="head">
        <h1>STUDENT PROFILE</h1>
          <hr/>
      </section>

    <section class="alladm">
        <h3>Student's Information</h3>
      </section>

      <section class="profinfo">
        <div class="left">

        <?php echo"<img src='../Student/files/$prf' alt='' />" ?>


        <h3><span><?php echo"$fullname" ?></span></h3>

        <table border="1">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> Class </th>
                        <th> Division </th>
                        <th> Roll No. </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span><?php echo"$sid" ?></span></th>
                        <td><span><?php echo"$c" ?></span></th>
                        <td><span><?php echo"$d" ?></span></th>
                        <td><span><?php echo"$roll" ?></span></th>
                    </tr>                    
                </tbody>            

        </table>



        </div>

        <div class="right">

                <p>Email : <a href="mailto:<?php echo"$em" ?>"><span id="lnk"><?php echo"$em" ?></span></a></p>

                <p>Contact : <a href="tel:<?php echo"$ct" ?>"><span id="lnk"><?php echo"$ct" ?></span></a></p>

                <p>Username : <span><?php echo"$un" ?></span></a></p>

                <p>Gender : <span><?php echo"$gen" ?></span></a></p>

                <p>Date Of Birth : <span><?php echo"$dob" ?></span></a></p>

                <p>Address : <span><?php echo"$ad" ?></span></a></p>

                <h4>Parent's Information</h4>

                <p>Parent Name : <span><?php echo"$pname" ?></span></a></p>

                <p>Parent Email : <a href="mailto:<?php echo"$pem" ?>"><span id="lnk"><?php echo"$pem" ?></span></a></p>

                <p>Parent Contact : <a href="tel:<?php echo"$pc" ?>"><span id="lnk"><?php echo"$pc" ?></span></a></p>


        </div>


      </section>

    </main>
  </body>

  <script src="jsfile.js"></script>



</body>
</html>

</html>
