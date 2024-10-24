
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

$qr = "SELECT * FROM class ORDER BY id";
$res = mysqli_query($con, $qr);
$classout = "";

while ($rw = mysqli_fetch_assoc($res)) {
    $classout .= "<option value='" . $rw['id'] . "'>" . $rw['name'] . "</option>";
}


?>

<?php 

if(isset($_POST['addsub'])){

$cls=intval($_POST['class']);
$dv=intval($_POST['division']);

if(isset($_FILES['syllfile']) && $_FILES['syllfile']['error'] == 0){

        $syll = basename($_FILES['syllfile']['name']);

        $q = "UPDATE division SET syllabus='$syll' WHERE id='$dv' and classId='$cls'";

        $rs = mysqli_query($con, $q);

        if($rs){
            move_uploaded_file($_FILES['syllfile']['tmp_name'], "files/$syll");
            $_SESSION['update_success'] = "updated";
            header("Location: managesyll.php");
            exit();
        }

        else {
            $_SESSION['update_success'] = "notupdated";
            header("Location: managesyll.php");
            exit();
        }
}

else{
            $_SESSION['update_success'] = "errorupdated";
            header("Location: managesyll.php");
            exit();
}

}



if(isset($_POST['addtt'])){

$cls=intval($_POST['class']);
$dv=intval($_POST['division']);

if(isset($_FILES['subsyllfile']) && $_FILES['subsyllfile']['error'] == 0){

        $syll = basename($_FILES['subsyllfile']['name']);

        $q = "UPDATE division SET timetable='$syll' WHERE id='$dv' and classId='$cls'";

        $rs = mysqli_query($con, $q);

        if($rs){
            move_uploaded_file($_FILES['subsyllfile']['tmp_name'], "files/$syll");
            $_SESSION['update_success'] = "subupdated";
            header("Location: managesyll.php");
            exit();
        }

        else {
            $_SESSION['update_success'] = "subnotupdated";
            header("Location: managesyll.php");
            exit();
        }
}

else{
            $_SESSION['update_success'] = "errorupdated";
            header("Location: managesyll.php");
            exit();
}

}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Syllabus & Timetable</title>
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
          <a href="#" class="prof-btn" id="active"
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
          <h1>MANAGE SYLLABUS AND TIMETABLE</h1>
          <hr/>
      </section>
      <section class="alladm">
        <h3>ADD AND UPDATE SYLLABUS</h3>
      </section>
    <section class="managesub">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" class="frmdown" id="subfrm">
          <div class="field">
            <label>Class:</label>
            <p>
                <i class="fa-solid fa-book"></i>
              <select name="class" id="subclass" required>
                <option value="">Select Class</option>
                <?php echo"$classout"; ?>
              </select>
            </p>
          </div>  
          
          <div class="field">
            <label>Division :</label>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="division" id="subdivision" required>
                <option value="">Select Division</option>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Upload Syllabus :</label><br/>
                <p>
                <input type="file" name="syllfile">
                </p>
          </div>
          
            <p class="sbtfrm" id="filsub">
                <input type="submit" value="Update Syllabus" name="addsub" />
            </p>
        </form>

        <section class="alladm">
            <h3> Syllabus Info. </h3>

            <div class="info">
                <table border="1" id="vtable">
                    <thead>
                        <tr>
                            <th> File </th>
                            <th> Options </th>
                        </tr>
                    </thead>
                    <tbody id="tableData"></tbody>

                </table>
            </div>

        </section>
    </section>
    <br/>
    <hr/>
    <br/>

      <section class="alladm">
        <h3>ADD AND UPDATE CLASS TIMETABLE</h3>
      </section>
    <section class="managesub">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" class="frmdown" id="subfrm">
          <div class="field">
            <label>Class:</label>
            <p>
                <i class="fa-solid fa-book"></i>
              <select name="class" id="subsubclass" required>
                <option value="">Select Class</option>
                <?php echo"$classout"; ?>
              </select>
            </p>
          </div>  
          
          <div class="field">
            <label>Division :</label>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="division" id="subsubdivision" required>
                <option value="">Select Division</option>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Upload Timetable :</label><br/>
                <p>
                <input type="file" name="subsyllfile">
                </p>
          </div>
          
            <p class="sbtfrm" id="filsub">
                <input type="submit" value="Update Timetable" name="addtt" />
            </p>
        </form>

        <section class="alladm">
            <h3> Timetable Info. </h3>

            <div class="info">
                <table border="1" id="vtable">
                    <thead>
                        <tr>
                            <th> File </th>
                            <th> Options </th>
                        </tr>
                    </thead>
                    <tbody id="subtableData"></tbody>

                </table>
            </div>

        </section>
    </section>
    <br/>
    <br/>
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

            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="updated") {
                echo "showAlert('✅ Syllabus Updated Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notupdated") {
                echo "showAlert('⚠️ Error, Syllabus Not Updated!');";
                unset($_SESSION['update_success']);
            }

            elseif (isset($_SESSION['update_success']) && $_SESSION['update_success']=="subupdated") {
                echo "showAlert('✅ Timetable Updated Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="subnotupdated") {
                echo "showAlert('⚠️ Error, Timetable Not Updated!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="errorupdated") {
                echo "showAlert('⚠️ Error, In Uploading File!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="deleted") {
                echo "showAlert('✅ Syllabus Deleted!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notdeleted") {
                echo "showAlert('⚠️ Error, Timetable Not Deleted!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="subdeleted") {
                echo "showAlert('✅ Timetable Deleted!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="subnotdeleted") {
                echo "showAlert('⚠️ Error, Timetable Not Deleted!');";
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
                url: 'get_divisions.php',
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
                    url: 'get_syllabus.php',
                    data: {class_id: classId, division_id: divisionId},
                    success: function(response) {
                        $('#tableData').html(response);
                    }
                });
            }
        });


    $('#subsubclass').change(function() {
        var classId = $(this).val();
        if (classId) {
            $.ajax({
                type: 'POST',
                url: 'get_divisions.php',
                data: { class_id: classId },
                success: function(response) {
                    $('#subsubdivision').html(response);
                }
            });
        }
    });




        $('#subsubdivision').change(function() {
            var classId = $('#subsubclass').val();
            var divisionId = $(this).val();
            if (classId && divisionId) {
                $.ajax({
                    type: 'POST',
                    url: 'get_classtimetable.php',
                    data: {class_id: classId, division_id: divisionId},
                    success: function(response) {
                        $('#subtableData').html(response);
                    }
                });
            }
        });


    });


    </script>

</html>
