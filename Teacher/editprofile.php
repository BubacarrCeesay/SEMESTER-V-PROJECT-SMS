
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

    $profile=$row['profile'];
    $email=$row['email'];
    $cont=$row['contact'];
    $addr=$row['address'];

}
}

?>

<?php

if(isset($_POST['submit'])){

    $uname=$_POST['username'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $add=$_POST['addr'];
    $contact=$_POST['cont'];

if(isset($_FILES['prof']) && $_FILES['prof']['error'] == 0){

        $prof = basename($_FILES['prof']['name']);

        $q = "UPDATE teacher SET username='$uname', firstname='$fname',lastname='$lname', profile='$prof',email='$email', address='$add', contact='$contact' WHERE username='$username'";

        $res = mysqli_query($con, $q);

        if($res){
            
            $_SESSION['teacher'] = $uname;
            move_uploaded_file($_FILES['prof']['tmp_name'], "files/$prof");
            $_SESSION['update_success'] = true;
            header("Location: editprofile.php");
            exit();
        }

        else {
           $_SESSION['update_success'] = false;
            header("Location: editprofile.php");
            exit();
        }
}

else{

        $q = "UPDATE teacher SET username='$uname',firstname='$fname', lastname='$lname',email='$email', address='$add', contact='$contact' WHERE username='$username'";

    $res=mysqli_query($con, $q);

    if($res){
        $_SESSION['teacher']=$uname;

         $_SESSION['update_success'] = true;

      header("Location: editprofile.php");
      exit();

    }
    else{
        $_SESSION['update_success'] = false;

       header("Location: editprofile.php");
      exit();
    } 
}

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher | Edit Profile</title>
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
          <p class="pson"><i class="fa-solid fa-circle"></i> Teacher</p>
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
          <h1>EDIT PROFILE</h1>
          <hr/>
      </section>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
      <section class="editprof">
        <div class="left">

            <div>
                <p>First Name : </p>
                <input type="text" value="<?php echo"$fname"; ?>" name="fname" autocomplete="off">
            </div>

            <div>
                <p>Last Name : </p>
                <input type="text" value="<?php echo"$lname"; ?>" name="lname" autocomplete="off">
            </div>

            <div>
                <p>Email : </p>
                <input type="text" value="<?php echo"$email"; ?>" name="email" autocomplete="off">
            </div>

            <div>
                <p>Address : </p>
                <input type="text" value="<?php echo"$addr"; ?>" name="addr" autocomplete="off">
            </div>

            <div>
                <p>Contact : </p>
                <input type="text" value="<?php echo"$cont"; ?>" name="cont" autocomplete="off">
            </div>

        </div>

        <div class="right">
             <div>
                <?php
                    echo"<img src='files/$profile' alt='' />";
                ?>
                <br/>
                <input type="file" name="prof">
            </div>

            <div>
                <p>Username : </p>
                <input type="text" value="<?php echo"$username"; ?>" name="username" autocomplete="off">
            </div>
            
        </div>
      </section>
                 <p class="sbmt">   <input type="submit" value="Save Changes" name="submit"></p>
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
            if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
                echo "showAlert('✅ Profile Updated Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']==false) {
                echo "showAlert('⚠️ Not Updated, Something Went Wrong!');";
                unset($_SESSION['update_success']);
            }

            ?>
        };
    </script>
</html>
