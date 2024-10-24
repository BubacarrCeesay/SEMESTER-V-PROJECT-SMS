
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


    $qr="select * from class order by id";

    $res=mysqli_query($con, $qr);

    $classout="";

    while ($rw = mysqli_fetch_assoc($res)) {
        $classout.="<option value='" . $rw['id'] . "'>" . $rw['name'] . "</option>";
    }


?>


<?php

if (isset($_POST["enroll"])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $uname = $_POST['uname'];
    $pswrd = $_POST['pswrd'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $std = strval($_POST['name']);
    $ass="ass";


if($std==$ass){
        $_SESSION['update_success'] = "assign";
        header("Location: addparent.php");
        exit();
 
}

else{

        $std = intval($_POST['name']);

    if(isset($_FILES['profpic']) && $_FILES['profpic']['error'] == 0){

    $prof = basename($_FILES['profpic']['name']);

    $qr="INSERT INTO parent(firstname, lastname,username, password, email, address,  contact, gender, studentId, profile) VALUES ('$fname','$lname','$uname','$pswrd','$email','$address','$contact','$gender','$std','$prof')";

    $res=mysqli_query($con, $qr);

        if ($res) {
            $_SESSION['update_success'] = "inserted";
            move_uploaded_file($_FILES['profpic']['tmp_name'], "../Parent/files/$prof");
        } else {
            $_SESSION['update_success'] = "notinserted";
            echo "Error: " . mysqli_error($con);
        }

        header("Location: addparent.php");
        exit();

    }

    else{

    $qr="INSERT INTO parent(firstname, lastname,username, password, email, address,  contact, gender, studentId) VALUES ('$fname','$lname','$uname','$pswrd','$email','$address','$contact','$gender','$std')";

    $res=mysqli_query($con, $qr);

        if ($res) {
            $_SESSION['update_success'] = "inserted";
        } else {
            $_SESSION['update_success'] = "notinserted";
            echo "Error: " . mysqli_error($con);
        }

        header("Location: addparent.php");
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
    <title>Admin | Add Parent</title>
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
          <a href="#" class="prof-btn" id="active"
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
        <h1>ADD PARENT</h1>
          <hr/>
      </section>
    <section class="frmup">
        <p>** All Fields Are <span>Required</span> **</p>
      </section>

      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <section class="frmdown">
          <div class="field">
            <label>First Name :</label>
            <p>
              <i class="fa-solid fa-user"></i>
              <input type="text" name="fname" placeholder="Enter First Name" required/>
            </p>
          </div>

          <div class="field">
            <label>Last Name :</label>
            <p>
              <i class="fa-solid fa-image-portrait"></i>
              <input type="text" name="lname" placeholder="Enter Last Name" required/>
            </p>
          </div>

          <div class="field">
            <label>Email :</label>
            <p>
              <i class="fa-regular fa-envelope"></i>
              <input type="email" name="email" placeholder="Enter Email" required/>
            </p>
          </div>

          <div class="field">
            <label>Address :</label>
            <p>
              <i class="fa-solid fa-location-dot"></i>
              <input type="text" name="address" placeholder="Enter Address" required/>
            </p>
          </div>

          <div class="field">
            <label>Username :</label>
            <p>
              <i class="fa-solid fa-user-tie"></i>
              <input type="text" name="uname" placeholder="Enter Username" required/>
            </p>
          </div>

          <div class="field">
            <label>Password :</label>
            <p>
              <i class="fa-solid fa-lock"></i>
              <input type="text" name="pswrd" placeholder="Enter Password" required/>
            </p>
          </div>

          <div class="field">
            <label>Contact :</label>
            <p>
              <i class="fa-solid fa-phone"></i>
              <input type="text" name="contact" placeholder="Enter Contact" required/>
            </p>
          </div>

          <div class="field">
            <label>Gender :</label>
            <p>
              <i class="fa-solid fa-person-half-dress"></i>
              <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Student's Class :</label>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="class" id="class" required>
                <option value="">Select Class</option>
                <?php echo"$classout"; ?>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Student's Division :</label>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="division" id="division" required>
                <option value="">Select Division</option>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Student's Name :</label>
            <p>
              <i class="fa-solid fa-child"></i>
              <select name="name" id="name" required>
                <option value="">Select Name</option>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Profile Picture (Optional):</label>
            <p>
              <i class="fa-regular fa-file"></i>
              <input type="file" name="profpic" />
            </p>
          </div>

        </section>

        <p class="sbtfrm">
          <input type="submit" value="Add Parent" name="enroll" />
        </p>
 
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

            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="inserted") {
                echo "showAlert('✅ Parent Added Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notinserted") {
                echo "showAlert('⚠️ Error, Parent Not Added!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="assign") {
                echo "showAlert('⚠️ Error, Student\'s Parent Already Exist!');";
                unset($_SESSION['update_success']);
            }

            ?>
        };
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#class').change(function() {
            var classId = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'get_divisions.php',
                data: {class_id: classId},
                success: function(response) {
                    $('#division').html(response);
                }
            });
        });

        $('#division').change(function() {
            var classId = $('#class').val();
            var divisionId = $(this).val();
            if (classId && divisionId) {
                $.ajax({
                    type: 'POST',
                    url: 'get_students.php',
                    data: {class_id: classId, division_id: divisionId},
                    success: function(response) {
                        $('#name').html(response);
                    }
                });
            }
        });
    });


    </script>

</html>
