
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

if(isset($_POST['submit'])){

    $oldpass=$_POST['psswrd'];
    $newpass=$_POST['newpass'];
    $cnewpass=$_POST['cnewpass'];

    $q="select * from admin where username='$username'";

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

        $qr="update admin set password='$newpass' where username='$username'";

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
    <title>Admin | Change Password</title>
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
          <a href="#" class="prof-btn" id="active"
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
