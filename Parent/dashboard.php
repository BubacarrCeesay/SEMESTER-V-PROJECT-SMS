
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}

if(isset($_SESSION['parent'])){

    $username=$_SESSION['parent'];

    $query="select * from parent where username='$username'";

    $result=mysqli_query($con, $query);

    while($row=mysqli_fetch_array($result)){
    
    $fname=$row['firstname'];
    $lname=$row['lastname'];
     $pid=$row['id'];
      $sid=$row['studentId'];
    $profile=$row['profile'];

}



}
?>




<?php 

$ex=mysqli_query($con,"select * from mail where receiver='$pid' and status='notread'");
$totalunr=mysqli_num_rows($ex);

    $sqmt="select * from notice ";

    $rmt=mysqli_query($con,$sqmt);

    $totalnt=mysqli_num_rows($rmt);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parent | Dashboard</title>
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
        <img src="../Student/logo.png" alt="#">
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
          <p class="pson"><i class="fa-solid fa-circle"></i> Parent</p>
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
            ><i class="fa-regular fa-user"></i> Parent
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
            ><i class="fa-solid fa-chalkboard-user"></i> Student
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">

            <li>
              <a href="viewstudent.php"><i class="fa-regular fa-eye"></i></i>Student Info </a>
              
            </li>

            <li>
              <a href="myclass.php"><i class="fa-solid fa-door-open"></i> Class Info </a>
            </li>

            <li>
              <a href="marksheet.php"><i class="fas fa-print"></i> Marksheet</a>
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
                <img src="../Student/proficon.jpeg" alt=""></a>
              </div>
          </div>
          <div class="info" id="doctor">
              <div class="num">
                <a href="mystudent.php">
                  <h1>
                      <?php echo""; ?>
                  </h1>
                  <h3>My Student</h3>
              </div>
              <div class="icon">
                <img src="../Admin/studenticon.png" alt=""> </a>
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
                <img src="../Student/noticon.jpeg" alt=""></a>
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
              <img src="../Student/mailicon.jpeg" alt=""></a>
              </div>
          </div>

          </div>

      </section>

    </main>
  </body>

  <script src="../Admin/jsfile.js"></script>
 
</html>
