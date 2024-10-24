
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}

if(isset($_SESSION['teacher'])){

    $username=$_SESSION['teacher'];

    $query="select * from teacher where username='$username'";

    $result=mysqli_query($con, $query);

    while($row=mysqli_fetch_array($result)){
    
    $fname=$row['firstname'];
    $lname=$row['lastname'];
     $tid=$row['id'];

    $profile=$row['profile'];

}



}



?>

<?php 

$ex=mysqli_query($con,"select * from mail where receiver='$tid' and status='notread'");
$totalunr=mysqli_num_rows($ex);

    $sqmt="select * from notice ";

    $rmt=mysqli_query($con,$sqmt);

    $totalnt=mysqli_num_rows($rmt);

    $sqmt="select * from material where bya='$fname $lname'";

    $rmt=mysqli_query($con,$sqmt);

    $totalmtt=mysqli_num_rows($rmt);

    $sql="select * from subject where teacherId='$tid'";

    $r=mysqli_query($con,$sql);

    $totalsub=mysqli_num_rows($r);
    
    $totalst=0;

    $subout="";

    if(mysqli_num_rows($r)>0){
        while($rs= mysqli_fetch_array($r)){
            $class=$rs['classId'];
            $div=$rs['divId'];
            $qs="select * from student where classId=$class and divId=$div";
            $rs=mysqli_query($con,$qs);

            $totalst=$totalst + mysqli_num_rows($rs);
        }
      }
mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher | Dashboard</title>
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
          <p class="pson"><i class="fa-solid fa-circle"></i> Teacher</p>
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
            ><i class="fa-regular fa-user"></i> Teacher
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
              <a href="viewstudent.php"><i class="fa-regular fa-eye"></i></i> View Student</a>
              
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
              <a href="myclass.php"><i class="fa-solid fa-door-open"></i> My Class</a>
            </li>
            <li>
              <a href="mysub.php"><i class="fa-solid fa-book"></i> My Subjects</a>
              
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
              <a href="insertmark.php"><i class="fa-solid fa-file-circle-plus"></i> Insert Marks</a>
            </li>
            <li>
              <a href="viewmark.php"><i class="fa-regular fa-eye"></i> View Marks</a>
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
              <a href="studymaterial.php"><i class="fa-regular fa-file-pdf"></i> Upload Materials</a>
              
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
                  <h3>My<br/>Profile</h3>
              </div>
              <div class="icon">
                <img src="proficon.jpeg" alt=""></a>
              </div>
          </div>
          <div class="info" id="doctor">
              <div class="num">
                <a href="viewstudent.php">
                  <h1>
                      <?php echo"$totalst"; ?>
                  </h1>
                  <h3> My Students </h3>
              </div>
              <div class="icon">
                <img src="studenticon.png" alt=""> </a>
              </div>
          </div>
          <div class="info" id="patient">
              <div class="num">
                <a href="mysub.php">
                  <h1>
                      <?php echo"$totalsub"; ?>
                  </h1>
                  <h3>Subjects</h3>
              </div>
              <div class="icon">
                  <img src="subicon.jpeg" alt=""></a>
              </div>
          </div>
          <div class="info" id="report">
              <div class="num">
                <a href="studymaterial.php">
                  <h1>
                      <?php echo"$totalmtt"; ?>
                  </h1>
                  <h3>Uploaded Materials</h3>
              </div>
              <div class="icon">
                <img src="fileicon.jpeg" alt=""></a>
              </div>
          </div>
          <div class="info" id="job">
              <div class="num">
                <a href="notice.php">
                  <h1>
                      <?php echo"$totalnt"; ?>
                  </h1>
                  <h3>Notice</h3>
              </div>
              <div class="icon">
                <img src="noticon.jpeg" alt=""></a>
              </div>
          </div>
          <div class="info" id="income">
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

          </div>

      </section>

    </main>
  </body>

  <script src="../Admin/jsfile.js"></script>
</html>
