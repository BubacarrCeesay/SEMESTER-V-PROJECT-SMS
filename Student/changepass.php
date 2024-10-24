
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
    $email=$row['email'];
    $cont=$row['contact'];
    $addr=$row['address'];

    $profile=$row['profile'];

}
}

?>

<?php

if(isset($_POST['submit'])){

    $oldpass=$_POST['psswrd'];
    $newpass=$_POST['newpass'];
    $cnewpass=$_POST['cnewpass'];

    $q="select * from student where username='$username'";

    $res=mysqli_query($con, $q); 

    $rw=mysqli_fetch_array($res);

    $old=$rw['password'];


    if($oldpass != $old){
        $_SESSION['update_success'] = "incorrectpass";
    }

    else if($newpass != $cnewpass){
        $_SESSION['update_success'] = "notmatch";
    }
    else{

        $qr="update student set password='$newpass' where username='$username'";

         $r=mysqli_query($con,$qr);

        if($r){

            $_SESSION['update_success'] = "success";    
        }
        else{
            $_SESSION['update_success'] = "error";
        }

    }   

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student | Change Password</title>
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
          <a href="#" class="prof-btn" id="active"
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
          <a href="mailbox.php"
            ><i class="fa-solid fa-envelope"></i> Mail Box</a
          >
        </li>

        
      </ul>
    </nav>

    <main class="main">

      <section  class="head">
          <h1>CHANGE PASSWORD</h1>
          <hr/>
      </section>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
      <section class="editprof" id="changepass">
        <div class="left">
            <div>
                <p>Old Password : </p>
                <input type="text" placeholder="Enter Current Password" name="psswrd" autocomplete="off" required>
            </div>

            <div>
                <p>New Password : </p>
                <input type="password" placeholder="Enter New Password" name="newpass" required>
            </div>

            <div>
                <p>Confirm New Password : </p>
                <input type="password" placeholder="Confirm New Password" name="cnewpass"  required>
            </div>

        </div>
      </section>
                 <p class="sbmt">   <input type="submit" value="Change Password" name="submit"></p>
      </form>
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
 
            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="incorrectpass") {
                echo "showAlert('⚠️ Incorrect Old Password');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="success") {
                echo "showAlert('✅ Password Change Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="error") {
                echo "showAlert('⚠️ Not Updated, Something Went Wrong!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notmatch") {
                echo "showAlert('⚠️ New Password Does NOT Match');";
                unset($_SESSION['update_success']);
            }
            ?>
        };
    </script>
</html>
