
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


$qtb="select * from subject order by classId";

    $qt=mysqli_query($con,$qtb);

    $output="";

    if(mysqli_num_rows($qt) > 0){

        while($rs= mysqli_fetch_array($qt)){

            $clas=$rs['classId'];
            $div=$rs['divId'];
            $sid=$rs['id'];
            $sn=$rs['name'];
            $clt=$rs['teacherId'];

            if($clt==0){
                
                $t="N/A";

            }

            else{

                $qft="select * from teacher where id=$clt";
                $rd=mysqli_query($con,$qft);


                if((mysqli_num_rows($rd) > 0)){
                    $rdo= mysqli_fetch_array($rd);
                    $t=$rdo['firstname']." ".$rdo['lastname'];
                }
            }

            $qf="select * from division where id=$div";
            $rl=mysqli_query($con,$qf);


            if((mysqli_num_rows($rl) > 0)){
                $ro= mysqli_fetch_array($rl);
                $d=$ro['div_name'];
            }

            $qfc="select * from class where id=$clas";
            $rcl=mysqli_query($con,$qfc);


            if((mysqli_num_rows($rcl) > 0)){
                $rco= mysqli_fetch_array($rcl);
                $c=$rco['name'];
            }

            $output.="
            <tr>
            <td>$sid</td>
            <td>$c</td>
            <td>$d</td>
            <td>$sn</td>
            <td>$t</td>
                    <td>
                    <a href='redirectsub.php?removeid=$sid'><button id='rej'>Remove Subject<i class='fa-regular fa-rectangle-xmark'></i></button></a></td>
            </tr>
            ";            
        }
    }


?>

<?php 

if(isset($_POST['addsub'])){

$name=$_POST['subname'];
$cls=intval($_POST['class']);
$dv=intval($_POST['division']);
$flag=0;

$chq="select * from subject where classId='$cls' and divId='$dv'";

$chr=mysqli_query($con,$chq);

if(mysqli_num_rows($chr)> 0){

    while($chvl=mysqli_fetch_array($chr)){
        if(trim(strtolower($chvl['name'])) == trim(strtolower($name))){
            $flag=1;
        }
    }

}

if($flag==0){

    $qry="INSERT INTO subject(name,classId,divId) VALUES ('$name','$cls','$dv')";

    $rsl=mysqli_query($con,$qry);

    if($rsl){
            $_SESSION['update_success'] = "subinsert";
                header("Location: managesub.php");
                exit();
    }

    else{
            $_SESSION['update_success'] = "subnotinsert";
                header("Location: managesub.php");
                exit();
    }

}

else{
            $_SESSION['update_success'] = "nameexist";
                header("Location: managesub.php");
                exit();
}

}



if(isset($_POST['asstch'])){

    $sub=intval($_POST['subject']);
    $tch=$_POST['tchname'];
    $ass="ass";


if($tch==$ass){
        $_SESSION['update_success'] = "alass";
                header("Location: managesub.php");
                exit();
}

else{
    
    $tch=intval($_POST['tchname']);

    $checkcl="update subject set teacherId='$tch' where id='$sub'";

    $qmc=mysqli_query($con,$checkcl);

    if($qmc){
           $_SESSION['update_success'] = "tchassign";
                header("Location: managesub.php");
                exit();
    }
    else{
           $_SESSION['update_success'] = "tchnotassign";
                header("Location: managesub.php");
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
    <title>Admin | Manage Subject</title>
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
          <a href="#" class="prof-btn" id="active"
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
          <h1>MANAGE SUBJECT</h1>
          <hr/>
      </section>
      <section class="alladm">
        <h3>ADD SUBJECT</h3>
      </section>
    <section class="managesub">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="frmdown" id="subfrm">
          <div class="field">
            <label>Class:</label>
            <p>
                <i class="fa-solid fa-book"></i>
              <select name="class" id="class" required>
                <option value="">Select Class</option>
                <?php echo"$classout"; ?>
              </select>
            </p>
          </div>  
          
          <div class="field">
            <label>Division :</label>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="division" id="division" required>
                <option value="">Select Division</option>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Subject Name :</label><br/>
                <p>
                <input type="text" placeholder="Enter Subject Name" name="subname" autocomplete="off">
                </p>
          </div>
          
        <p class="sbtfrm" id="filsub">
          <input type="submit" value="Add Subject" name="addsub" />
        </p>
     </form>

    <section class="alladm">
        <h3>List Of Subject</h3>

        <div class="info">
            <table border="1" id="vtable">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> Name </th>
                    </tr>
                </thead>
                <tbody id="tableData"></tbody>

             </table>
      </section>
    </section>
    <br/>
<hr/>
    <br/>
      <section class="alladm">
        <h3>ASSIGN ANG UPDATE SUBJECT TEACHER</h3>
      </section>

    <section>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="frmdown">
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
            <label>Teacher :</label>
            <p>
              <i class="fa-solid fa-user"></i>
              <select name="tchname" id="tchname" required>
                <option value="">Select Teacher</option>
              </select>
            </p>
          </div>
          
        <p class="sbtfrm" id="filsub">
          <input type="submit" value="Assign Teacher" name="asstch" />
        </p>
     </form>
    </section>
    <br/>
<hr/>
    <br/>
    <section class="alladm">
        <h3>SUBJECT AND TEACHER INFORMATION</h3>

        <div class="info">
            <table border="1" id="vtable">
                <th> ID </th>
                <th> Class </th>
                <th> Division </th>
                <th> Subject </th>
                <th> Teacher </th>
                <th> Action </th>

                <?php echo"$output"; ?>

             </table>
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

            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="subinsert") {
                echo "showAlert('✅ Subject Added Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="subnotinsert") {
                echo "showAlert('⚠️ Error, Subject Not Added!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="nameexist") {
                echo "showAlert('⚠️ Error, Subject Name Already Exist For The Class & Division!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="alass") {
                echo "showAlert('⚠️ Error,This Teacher Already Assigned To This Subject!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="tchassign") {
                echo "showAlert('✅ Subject Teacher Assign Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="tchnotassign") {
                echo "showAlert('⚠️ Error, Subject Teacher Not Assigned!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="deleted") {
                echo "showAlert('✅ Subject Deleted Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notdeleted") {
                echo "showAlert('⚠️ Error, Subject Not Deleted!');";
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
        if (classId) {
            $.ajax({
                type: 'POST',
                url: 'get_divisions.php',
                data: { class_id: classId },
                success: function(response) {
                    $('#division').html(response);
                }
            });
        }
    });

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


        $('#division').change(function() {
            var classId = $('#class').val();
            var divisionId = $(this).val();
            if (classId && divisionId) {
                $.ajax({
                    type: 'POST',
                    url: 'get_subject.php',
                    data: {class_id: classId, division_id: divisionId},
                    success: function(response) {
                        $('#tableData').html(response);
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


        $('#subject').change(function() {
            var classId = $('#subclass').val();
            var divisionId = $('#subdivision').val();
            var subjectId = $(this).val();
            if (classId && divisionId && subjectId) {
                $.ajax({
                    type: 'POST',
                    url: 'get_subteacher.php',
                    data: {class_id: classId, division_id: divisionId, subject_id: subjectId},
                    success: function(response) {
                        $('#tchname').html(response);
                    }
                });
            }
        });

    });


    </script>

</html>
