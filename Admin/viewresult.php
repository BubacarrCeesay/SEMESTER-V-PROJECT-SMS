
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




$qr = "SELECT * FROM exam ORDER BY id";
$res = mysqli_query($con, $qr);
$exout = "";

while ($rw = mysqli_fetch_assoc($res)) {
    $exout .= "<option value='" . $rw['id'] . "'>" . $rw['name'] . "</option>";
}

?>

<?php 


if(isset($_POST['fetch'])){

    $classId = intval($_POST['subclass']);
    $divisionId = intval($_POST['subdivision']);
    $examId = intval($_POST['selex']);
    $subjectId = intval($_POST['subject']);

    $qex="select * from exam where id=$examId";
    $fqex=mysqli_query($con,$qex);

    while ($rwe = mysqli_fetch_assoc($fqex)) {
        $exmname=strtoupper($rwe['name']);
    }
    
    $qsub="select * from subject where id=$subjectId";
    $fqsub=mysqli_query($con,$qsub);

    while ($rwsub = mysqli_fetch_assoc($fqsub)) {
        $subname=strtoupper($rwsub['name']);
    }
    

    $minfo="$subname MARKSHEET FOR $exmname EXAM";
    $outfetch="";

    $qry="select * from result where classId=$classId and divId=$divisionId and examId=$examId and subjectId=$subjectId";

    $fqr=mysqli_query($con,$qry);

    if(mysqli_num_rows($fqr)>0){
        
        while($rq=mysqli_fetch_array($fqr)){

            $stu=$rq['studentId'];

            $mark=$rq['mark'];

            $qs="select * from student where id=$stu";

            $fsq=mysqli_query($con,$qs);

            while ($rws = mysqli_fetch_assoc($fsq)) {
                $fullname=$rws['firstname']." ".$rws['lastname'];
                $rollno=$rws['rollno'];
            }

            $outfetch.="
            <tr>
            <td>$rollno</td>
            <td>$fullname</td>
            <td>$mark</td>
            </tr>
            ";            

        }
    }

    else{
            $outfetch.="
            <tr>
            <td colspan='3'>Marks For This Subject Is Not Inserted</td>
            </tr>
            ";            
    }


}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | View Mark </title>
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
          <a href="#" class="prof-btn" id="active"
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
          <h1> VIEW MARKS </h1>
          <hr/>
      </section>
      <section class="alladm">
        <h3>VIEW STUDENT'S MARKS</h3>
      </section>

      <section>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="frmdown">
          <div class="field">
            <label>Class :</label>
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
            <label>Select Exam :</label>
            <p>
              <select name="selex" id="selex" required>
                <option value="" >Select Exam</option>
                <?php echo"$exout"; ?>
              </select>
            </p>
          </div>  

          <div class="field">
            <label>Subject :</label><br/>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="subject" id="subject" required>
                <option value="">Select Subject</option>
              </select>
            </p>
          </div>

          
        <p class="sbtfrm" id="filsub">
          <input type="submit" value="Fetch Marks" name="fetch" />
        </p>
     </form>
    </section>

    <br/>
<hr/>
    <br/>

      <section class="alladm">
        <h3><?php 
        if(isset($minfo)){
                echo"$minfo"; 
        }
        else{
            echo"";
        }   
        ?></h3>

        <div class="info">
            <table border="1" id="vtable">

                <th> Roll No. </th>
                <th> Student Name </th>
                <th> Mark (%)</th>

                <?php 
                if(isset($outfetch)){
                echo"$outfetch"; 
                }
                else{
                echo"";
                }
                ?>

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


            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="marks_exist") {
                echo "showAlert('⚠️ Error, Subject Marks Of This Class And Division Is Already Inserted!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="marks_inserted") {
                echo "showAlert('✅ Student's Marks Inserted Successfully!');";
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
                    url: 'get_subname.php',
                    data: {class_id: classId, division_id: divisionId},
                    success: function(response) {
                        $('#subject').html(response);
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
                    url: 'fetch_students.php',
                    data: {class_id: classId, division_id: divisionId},
                    success: function(response) {
                        $('#studentinfo').html(response);
                    }
                });
            }
        });



    });


    </script>



</html>


