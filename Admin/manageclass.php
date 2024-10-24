
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


$qt = "SELECT * FROM teacher ORDER BY id";
$rs = mysqli_query($con, $qt);
$tchout = "";

while ($rws = mysqli_fetch_assoc($rs)) {

        $ct=$rws['id'];

        $qch = "SELECT * FROM division WHERE classteacher = '$ct'";

        $rch = mysqli_query($con, $qch);
        
        if(mysqli_num_rows($rch)>0){
            
             $tname=$rws['firstname']." ".$rws['lastname'];
            $tchout .= "<option style='background-color: red;' value='ass'>" . $tname . "</option>";        
        }

        else{
            $tname=$rws['firstname']." ".$rws['lastname'];
            $tchout .= "<option value='" . $rws['id'] . "'>" . $tname . "</option>";
        }

}


$qtb="select * from division order by div_name";

    $qt=mysqli_query($con,$qtb);

    $output="";

    if(mysqli_num_rows($qt) > 0){
        while($rs= mysqli_fetch_array($qt)){

            $clas=$rs['classId'];
            $dname=$rs['div_name'];
            $did=$rs['id'];
              $clt=$rs['classteacher'];

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

            $pr=mysqli_query($con,"select * from student where classId=$clas and divId=$did");

            $totals=mysqli_num_rows($pr);

            $qfc="select * from class where id=$clas";
            $rcl=mysqli_query($con,$qfc);


            if((mysqli_num_rows($rcl) > 0)){
                $rco= mysqli_fetch_array($rcl);
                $c=$rco['name'];
            }

            $output.="
            <tr>
            <td>$c</td>
            <td>$dname</td>
            <td>$t</td>
            <td>$totals</td>
                     <td><a href='classinfo.php?viewid=$did'><button id='app'>View<i class='fa-regular fa-eye'></i></button></a>
                    <a href='clsredirect.php?removeid=$did'><button id='rej'>Remove<i class='fa-regular fa-rectangle-xmark'></i></button></a></td>
            </tr>
            ";            
        }
    }


?>

<?php

if(isset($_POST['addclass'])){

    $cn=$_POST['classname'];
    $cv=$_POST['classval'];
    $flag=0;

    $fc="Class ".$cn."(".$cv.")";

    $cq="INSERT INTO class(name) VALUES ('$fc')";

    $mcq=mysqli_query($con,$cq);

    if($mcq){
           $_SESSION['update_success'] = "classadd";
            header("Location: manageclass.php");
            exit();
    }
    else{
           $_SESSION['update_success'] = "classnotadd";
            header("Location: manageclass.php");
            exit();
    }

}


if(isset($_POST['addDiv'])){

    $flag=0;
    $cl=$_POST['class'];
    $dv=$_POST['division'];

    $checkcl="select * from division where classId=$cl";
    $qmc=mysqli_query($con,$checkcl);

    if(mysqli_num_rows($qmc) > 0){

        while($rs= mysqli_fetch_array($qmc)){

            if(trim(strtolower($rs['div_name']))==trim(strtolower($dv))){
                $flag=1;
            }

        }

    }

if($flag==0){ 

    $dq="INSERT INTO division(div_name,classId) VALUES ('$dv','$cl')";

    $mdq=mysqli_query($con,$dq);

    if($mdq){
           $_SESSION['update_success'] = "divadd";
            header("Location: manageclass.php");
            exit();
    }
    else{
           $_SESSION['update_success'] = "divnotadd";
            header("Location: manageclass.php");
            exit();

        } 
}

else{
           $_SESSION['update_success'] = "divexist";
            header("Location: manageclass.php");
            exit();   
}

}


if(isset($_POST['assign'])){

    $cls=$_POST['class'];
    $div=$_POST['division'];
    $tch=$_POST['tchname'];

    $std = strval($tch);
    $ass="ass";

if($std==$ass){
        $_SESSION['update_success'] = "alreadyass";
        header("Location: manageclass.php");
        exit();
 
}

else{

    $assq="update division set classteacher=$tch where id=$div and classId=$cls";

    $aq=mysqli_query($con,$assq);

    if($aq){
           $_SESSION['update_success'] = "assign";
            header("Location: manageclass.php");
            exit();
    }
    else{
           $_SESSION['update_success'] = "notassign";
            header("Location: manageclass.php");
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
    <title>Admin | Manage Class</title>
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
          <h1>MANAGE CLASSROOM</h1>
          <hr/>
      </section>
      <section class="alladm">
        <h3>ADD CLASS</h3>
      </section>
    <section>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="frmdown" id="filterform">
          <div class="field">
            <label>Class Name :</label><br/><br/>
                <input type="text" placeholder="Enter Class Name In String" name="classname" autocomplete="off">
          </div>  
          <div class="field">
            <label>Class In Numeric :</label><br/><br/>
                <input type="text" placeholder="Enter Class Name In Numeric" name="classval" autocomplete="off">
          </div>
          
        <p class="sbtfrm" id="filsub">
          <input type="submit" value="Add Class" name="addclass" />
        </p>
        </form>
    </section>
    <br/>
<hr/>
    <br/>

    <section class="alladm">
        <h3>ADD DIVISION</h3>
      </section>
    <section>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="frmdown" id="filterform">
          <div class="field">
            <label>Class:</label>
            <p>
              <select name="class" required>
                <option value="">Select Class</option>
                <?php echo"$classout"; ?>
              </select>
            </p>
          </div>  
          <div class="field">
            <label>Division :</label><br/><br/>
                <input type="text" placeholder="Enter Division Name" name="division" autocomplete="off">
          </div>
          
        <p class="sbtfrm" id="filsub">
          <input type="submit" value="Add Division" name="addDiv" />
        </p>
        </form>
    </section>

    <br/>
<hr/>
    <br/>

    <section class="alladm">
        <h3>ASSIGN AND UPDATE CLASS TEACHER</h3>
      </section>
    <section>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="frmdown" id="filterform">
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
            <label>Teacher :</label>
            <p>
              <i class="fa-solid fa-user"></i>
              <select name="tchname" id="tchname" required>
                <option value="">Select Teacher</option>
                <?php echo"$tchout"; ?>
              </select>
            </p>
          </div>
          
        <p class="sbtfrm" id="assbtn">
          <input type="submit" value="Assign Teacher" name="assign" />
        </p>
        </form>
    </section>

    <br/>
<hr/>
    <br/>
    <section class="alladm">
        <h3>ACTIVE CLASSES</h3>

        <div class="info">
            <table border="1" id="vtable">
                <th> Class </th>
                <th> Division </th>
                <th> Class Teacher </th>
                <th> No. Of Students </th>
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

            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="classadd") {
                echo "showAlert('✅ Class Added Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="classnotadd") {
                echo "showAlert('⚠️ Error, Class Not Added!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="divadd") {
                echo "showAlert('✅ Division Added Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="divnotadd") {
                echo "showAlert('⚠️ Error, Division Not Added!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="divexist") {
                echo "showAlert('⚠️ Error, Division Name Already Exist!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="assign") {
                echo "showAlert('✅ Class Teacher Assigned Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notassign") {
                echo "showAlert('⚠️ Error,  Class Teacher Not Assigned!');";
               unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="alreadyass") {
                echo "showAlert('⚠️ Error, Teacher Is Already Assigned To A Class!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="deleted") {
                echo "showAlert('✅ Class & Division Deleted Successfully!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notdeleted") {
                echo "showAlert('⚠️ Error, ✅ Class & Division Not Deleted!');";
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
    });
    </script>

</html>
