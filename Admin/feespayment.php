
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

if(isset($_POST['fetch'])){

  $class=intval($_POST['class']);
  $div=intval($_POST['division']);


  $sql="select * from student where classId=$class and divId=$div order by rollno";

  $output="";
    
    $r = mysqli_query($con, $sql);

    if (mysqli_num_rows($r) > 0) {

        while ($rs = mysqli_fetch_array($r)) {
            $roll = $rs['rollno'];
            $sid = $rs['id'];
            $fullname = $rs['firstname'] . " " . $rs['lastname'];
            $status="Not Paid";

            $chqr="select * from feesinvoice where studentId = $sid";

            $chres=mysqli_query($con,$chqr);

            if(mysqli_num_rows($chres)>0){
              while($rw=mysqli_fetch_array($chres)){
                $status="<p style='color: green; font-size: 18px; font-weight: bold;'> $rw[status]</p>";
                $action="<a><button style='background-color: blue;' id='app'>Paid <i class='fa-solid fa-check'></i></button></a>";
              }
            }

            else{
              $status="<p style='color: red; font-size: 18px; font-weight: bold;'> Not Paid </p>";
              $action="<a href='feespayment.php?payid=$sid'><button id='app'>Pay<i class='fa-solid fa-dollar-sign'></i></button></a>";
            }

            $output .= "
                <tr>
                    <td>$sid</td>
                    <td>$roll</td>
                    <td>$fullname</td>
                    <td>$status</td>
                    <td>$action</td>
                </tr>
            ";
        }
    }

    else{
      $output.="<tr><td colspan='5'><h4>Selected Class And Division Is Empty</h4></td></tr>";
    }

}


?>

<?php

if(isset($_GET['payid'])){

  $sid=intval($_GET['payid']);

  $qpy="select * from student where id=$sid";

  $respy=mysqli_query($con,$qpy);

  if(mysqli_num_rows($respy)>0){

    while($rwpy=mysqli_fetch_array($respy)){

      $classId=intval($rwpy['classId']);

    }
  }


  $qfs="select * from fees where classId=$classId";

  $resfs=mysqli_query($con,$qfs);

  if(mysqli_num_rows($resfs)>0){

    while($rwfs=mysqli_fetch_array($resfs)){

      $amt=intval($rwfs['amount']);

    }
  }

  $st="Paid";

  $qry="Insert into feesinvoice (studentId,classId,amount,status) values ('$sid','$classId','$amt','$st')";

  $rz=mysqli_query($con,$qry);

  if($rz){
                $_SESSION['update_success'] = "paidsucc";
                header("Location: feespayment.php");
                exit();    
  }

  else{
                $_SESSION['update_success'] = "paidnot";
                header("Location: feespayment.php");
                exit();    
  }


}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Fees Payment </title>
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
          <a href="#" class="prof-btn" id="active"
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
          <h1>FEES PAYMENT</h1>
          <hr/>
      </section>
      <section class="alladm">
        <h3>FEES COLLECTION</h3>
      </section>

    <section>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="frmdown" id="filterform">
          <div class="field">
            <label>Class :</label>
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
          
        <p class="sbtfrm" id="filsub">
          <input type="submit" value="Fetch" name="fetch" />
        </p>
        </form>
    </section>
    <br/>
    <hr/>
    <br/>
    <section class="alladm">
        <h3>LIST OF STUDENTS</h3>
        <div class="info" id="infohght">
            <table border="1" id="vtable">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> Roll No. </th>
                        <th> Full Name </th>
                        <th> Status </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody id="tableData">

                <?php
                
                if(isset($output)){
                  echo"$output";
                }

                else{
                  echo"<tr><td colspan='5'>Select Class And Division To Display Students</td></tr>";
                }
                
                ?>


                </tbody>
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

            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="paidsucc") {
                echo "showAlert('✅ Successfully Paid!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="paidnot") {
                echo "showAlert('⚠️ Error, Payment Not Successfully!');";
                unset($_SESSION['update_success']);
            }

            ?>
        };
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    $(document).ready(function() {
            $('#class').change(function () {
                const classId = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'get_divisions.php',
                    data: { class_id: classId },
                    success: function (response) {
                        $('#division').html(response);
                    }
                });
            });
    });


    </script>

</html>
