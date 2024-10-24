
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



?>

<?php 

$ex=mysqli_query($con,"select * from mail where receiver='admin' and status='notread'");
$totalunr=mysqli_num_rows($ex);

$ex=mysqli_query($con,"select * from enroll where status='pending'");
$totalen=mysqli_num_rows($ex);

$ad=mysqli_query($con,"select * from admin");
$st=mysqli_query($con,"select * from student");
$tc=mysqli_query($con,"select * from teacher");
$pr=mysqli_query($con,"select * from parent");
$ex=mysqli_query($con,"select * from exam");



$totaladmin=mysqli_num_rows($ad);
$totalstu=mysqli_num_rows($st);
$totaltc=mysqli_num_rows($tc);
$totalpr=mysqli_num_rows($pr);
$totalex=mysqli_num_rows($ex);

$qfees = "SELECT SUM(amount) AS total_fees FROM feesinvoice";

$rfees = mysqli_query($con, $qfees);

if ($rfees) {

    $rwf = mysqli_fetch_assoc($rfees);

    $totalfees = $rwf['total_fees'];
} else {
    $totalfees = 0;
}




    $output="";

    $sql="select * from contactform";

    $r=mysqli_query($con,$sql);

    if(mysqli_num_rows($r) >0){
        while($rs= mysqli_fetch_array($r)){

            $name=$rs['name'];
            $email=$rs['email'];
              $pn=$rs['contact'];
            $msg=$rs['message'];
             $mid=$rs['id'];


            $output.="
            <tr>
            <td>$name</td>
            <td>$email</td>
            <td>$pn</td>
            <td>$msg</td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href='msgredirect.php?removeid=$mid'><button id='rej'>Remove<i class='fa-regular fa-rectangle-xmark'></i></button></a></td>
            </tr>
            ";            
        }

    }else{
      $output."<tr><td colspan=5> Contact Table Is Empty</td></tr>";
    }



mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Dashboard</title>
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
          <a href="dashboard.php" id="active"
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
          <a href="mailbox.php"
            ><i class="fa-solid fa-envelope"></i> Mail Box</a
          >
        </li>
        
      </ul>
    </nav>

    <main class="main">

      <section  class="head">
          <h1>DASHBOARD</h1>
          <hr/>
      </section>
      <section class="dashboard">
          <div class="info" id="admin">
              <div class="num">
                <a href="editprofile.php">
                  <h1>
                      <?php echo""; ?>
                  </h1>
                  <h3>My Profile</h3>
              </div>
              <div class="icon">
                <img src="imgdef.jpeg" alt=""></a>
              </div>
          </div>
          <div class="info" id="doctor">
              <div class="num">
                <a href="viewstudent.php">
                  <h1>
                      <?php echo"$totalstu"; ?>
                  </h1>
                  <h3> Student </h3>
              </div>
              <div class="icon">
                <img src="studenticon.png" alt=""> </a>
              </div>
          </div>
          <div class="info" id="patient">
              <div class="num">
                <a href="viewteacher.php">
                  <h1>
                      <?php echo"$totaltc"; ?>
                  </h1>
                  <h3>Teacher</h3>
              </div>
              <div class="icon">
                  <img src="teachericon.jpeg" alt=""></a>
              </div>
          </div>
          <div class="info" id="report">
              <div class="num">
                <a href="viewparent.php">
                  <h1>
                      <?php echo"$totalpr"; ?>
                  </h1>
                  <h3>Parent</h3>
              </div>
              <div class="icon">
                <img src="parenticon.jpg" alt=""></a>
              </div>
          </div>
          <div class="info" id="job">
              <div class="num">
                <a href="manageexam.php">
                  <h1>
                      <?php echo"$totalex"; ?>
                  </h1>
                  <h3>Exams</h3>
              </div>
              <div class="icon">
                <img src="examicon.png" alt=""></a>
              </div>
          </div>
          <div class="info" id="income">
              <div class="num">
                <a href="managefees.php">
                  <h1>
                    <?php echo"$ $totalfees"; ?>
                  </h1>
                  <h3>Fees Collected</h3>
              </div>
              <div class="icon">
              <img src="feesicon.png" alt=""></a>
              </div>
          </div>
          <div class="info" id="msg">
              <div class="num">
                <a href="mailbox.php">
                  <h1>
                      <?php echo"$totalunr"; ?>
                  </h1>
                  <h3>Unread Mails</h3>
              </div>
              <div class="icon">
                <img src="mailicon.jpeg" alt=""></a>
              </div>
          </div>
          <div class="info" id="dis">
              <div class="num">
                    <a href="enroll.php">
                  <h1>
                    <?php echo"$totalen"; ?>
                  </h1>
                  <h3>New Enrollments</h3>
              </div>
              <div class="icon">
                <img src="enrollicon.jpeg" alt=""></a>
              </div>
          </div>

      </section>

      <br/><br/><br/><br/>
      <hr/>
      <br/><br/>

    <section class="alladm">

        <h3>WEBSITE CONTACT FORM</h3>

        <div class="info">
            <table border="1" id="vtable">
                <thead>
                    <tr>
                        <th> Full Name </th>
                        <th> Email </th>
                        <th> Contact </th>
                        <th> Message </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody id="tableData">
                  <?php echo"$output"; ?>
                </tbody>

             </table>
      </section>

    </main>
  </body>

  <script src="jsfile.js"></script>
</html>
