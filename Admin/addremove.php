
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

    $output="";

    while($row=mysqli_fetch_array($result)){
    
    $ad_name=$row['fullname'];

    $profile=$row['profile'];

    }

    $q="select * from admin order by id";

    $res=mysqli_query($con, $q);

    while($rw=mysqli_fetch_array($res)){
        
        $name=$rw['fullname'];

        $prof=$rw['profile'];

        $id=$rw['id'];

        $usname=$rw['username'];

        $output.="
        <tr>
        <td>$id</td>
        <td>$name</td>
        <td>$usname</td>
        <td><img src='files/$prof' alt='' /></td>
        <td><a href='addremove?idr=$id'><button>Remove<i class='fa-regular fa-trash-can'></i></button></a></td>
        </tr>
        ";

    }


}

?>

<?php

if(isset($_POST['submit'])){

    $fname=$_POST['fname'];
    $uname=$_POST['uname'];
    $pswd=$_POST['pass'];
    $prof = basename($_FILES['proff']['name']);


    $q="insert into admin(fullname,username,password,profile) values('$fname','$uname','$pswd','$prof')";

    $res=mysqli_query($con,$q);

    if($res){
            move_uploaded_file($_FILES['prof']['tmp_name'], "files/$prof");
            $_SESSION['update_success'] = "added";
            header("Location: addremove.php");
            exit();
    }
    else{
            $_SESSION['update_success'] = "notadded";
            header("Location: addremove.php");
            exit();
    }

    }
 

?>


<?php

if(isset($_GET['idr'])){

    $did=$_GET['idr'];
    $qr="delete from admin where id='$did'";

    $r=mysqli_query($con,$qr);

    if($r){

            $_SESSION['update_success'] = "deleted";
            header("Location: addremove.php");
            exit();   
    }

    else{
         
            $_SESSION['update_success'] = "notdeleted";
            header("Location: addremove.php");
            exit();
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Add / Remove </title>
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

            <li>
              <a href="addremove.php"><i class="fa-solid fa-user-plus"></i>Add/Remove Admin</a>
              
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
              <a href="#"><i class="fa-solid fa-file-import"></i> Enrollments</a>
              
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

            <li>
              <a href="#"><i class="fa-solid fa-file-import"></i> Job Request</a>
              
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

            <li>
              <a href="managesyll.php"><i class="fa-regular fa-note-sticky"></i> Manage Syllabus</a>   
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
              <a href="insertmark.php"><i class="fa-solid fa-file-pen"></i> Insert Marks</a>
            </li>
            <li>
              <a href="viewresult.php"><i class="fa-regular fa-eye"></i> View Result</a>
            </li>
          </ul>
      </li>
        
      </ul>
    </nav>

    <main class="main">

      <section  class="head">
          <h1>ADD / REMOVE ADMIN</h1>
          <hr/>
      </section>

      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <h3>ADD ADMIN</h3>
      <section class="editprof" id="add">
        <div class="left">
            <div>
                <p>Username : </p>
                <input type="text" placeholder="Enter Username" name="uname" autocomplete="off" required>
            </div>

            <div>
                <p>Password : </p>
                <input type="password" placeholder="Enter Password" name="pass" required>
            </div>

            <div>
                <p>Full Name : </p>
                <input type="text" placeholder="Enter Full Name" name="fname" autocomplete="off"  required>
            </div>

            <div>
                <p>Profile Picture: </p>
                <input type="file" name="proff" required>
            </div>

        </div>
      </section>
                 <p class="sbmt" id="addadm">   <input type="submit" value="Add Admin" name="submit"></p>
      </form>

      <hr/>

      <section class="alladm">
        <h3>ALL ADMIN</h3>


        <div class="info">
            <table border="1">
                <th> ID </th>
                <th> Full Name</th>
                <th> Username </th>
                <th> Profile </th>
                <th> Action </th>

                <?php echo"$output"; ?>

             </table>

        </div>

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

            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notadded") {
                echo "showAlert('⚠️ Error, Admin NOT Added');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="added") {
                echo "showAlert('✅ Admin Successfully Added!');";
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

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="deleted") {
                echo "showAlert('✅ Admin Successfully Removed!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notmatch") {
                echo "showAlert('⚠️ Not Deleted, Something Went Wrong!');";
                unset($_SESSION['update_success']);
            }

            ?>
        };
    </script>
</html>



