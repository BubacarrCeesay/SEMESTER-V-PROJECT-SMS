
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
    $tid=$row['id'];

}
}

?>


<?php


$qr = "SELECT * FROM class ORDER BY id";
$res = mysqli_query($con, $qr);
$classout = "";

while ($rw = mysqli_fetch_assoc($res)) {
    $classout .= "<option value='" . $rw['id'] . "'>" . $rw['name'] . "</option>";
}




$qr = "SELECT * FROM exam ORDER BY id";
$res = mysqli_query($con, $qr);
$exout = "";

while ($rw = mysqli_fetch_assoc($res)) {
    $exout .= "<option value='" . $rw['id'] . "'>" . $rw['name'] . "</option>";
}


?>

<?php 


if(isset($_POST['submit'])){

    $cls=intval($_POST['subclass']);
    $div=intval($_POST['subdivision']);
    $sub=intval($_POST['subject']);
    $type=$_POST['material'];
    $des=$_POST['desc'];

            $sub=mysqli_query($con,"select * from subject where id='$sub'");

                while($rsub=mysqli_fetch_array($sub)){

                    $nm=$rsub['name'];

                }

if(isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0){

        $upf = basename($_FILES['upfile']['name']);

        $q = "INSERT INTO material(type, classId, divId, subject, descrip, upfile, date,bya) VALUES ('$type','$cls','$div','$nm','$des','$upf',NOW(),'$fname $lname')";

        $res = mysqli_query($con, $q);

        if($res){
            
            move_uploaded_file($_FILES['upfile']['tmp_name'], "files/$upf");
            $_SESSION['update_success'] = "upload";
            header("Location: studymaterial.php");
            exit();
        }

        else {
            $_SESSION['update_success'] = "notupload";
            header("Location: studymaterial.php");
            exit();
        }
}else{
            $_SESSION['update_success'] = "notupload";
            header("Location: studymaterial.php");
            exit();    
}
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher | Upload Materials</title>
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
          <a href="#" class="prof-btn" id="active"
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
          <h1>UPLOAD MATERIALS </h1>
          <hr/>
      </section>
    <section>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" class="frmdown" id="filterform">
          <div class="field">
            <label>Class:</label>
            <p>
                <i class="fa-solid fa-book"></i>
              <select name="subclass" id="subclass" required>
                <option value="">Select Class</option>
                <?php echo"$classout"; ?>
              </select>
            </p>
          </div>  
          
          <div class="field">
            <label>Division :</label>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="subdivision" id="subdivision" required>
                <option value="">Select Division</option>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Subject Name :</label><br/>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="subject" id="subject" required>
                <option value="">Select Subject</option>
              </select>
            </p>
          </div>  
          
          <div class="field">
            <label>Upload As :</label><br/>
            <p>
              <i class="fa-solid fa-file"></i>
              <select name="material" required>
                <option value="">Select Material</option>
                <option value="studymaterial">Study Material (Notes)</option>
                <option value="assignment">Assignment</option>
              </select>
            </p>
          </div>  

          <div class="field">
            <label>Description :</label><br/>
            <p>
                <input type="text" name="desc" placeholder="Enter Description" required>
            </p>
          </div> 

          <div class="field">
            <label>Select File:</label><br/>
                <p>
                <input type="file" name="upfile" required>
                </p>
          </div>

    </section>
          <p class="sbmt">   <input type="submit" value="Upload" name="submit"></p>
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

            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notupload") {
                echo "showAlert('⚠️ File Not Uploaded');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="upload") {
                echo "showAlert('✅ Material Uploaded Successfully!');";
                unset($_SESSION['update_success']);
            }

            ?>
        };

    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    $(document).ready(function() {


    $('#subclass').change(function() {
        var classId = $(this).val();
        if (classId) {
            $.ajax({
                type: 'POST',
                url: 'get_markdiv.php',
                data: { class_id: classId },
                success: function(response) {
                    $('#subdivision').html(response);
                }
            });
        }
    });



        $('#subdivision').change(function() {
            var classId = $('#subclass').val();
            var divisionId = $(this).val();
            if (classId && divisionId) {
                $.ajax({
                    type: 'POST',
                    url: 'get_subname.php',
                    data: {class_id: classId, division_id: divisionId},
                    success: function(response) {
                        $('#subject').html(response);
                    }
                });
            }
        });
    });


    </script>


</html>
