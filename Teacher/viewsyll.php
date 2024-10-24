
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
    <title>Teacher | Syllabus & Timetable</title>
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
          <h1>SYLLABUS AND TIMETABLE</h1>
          <hr/>
      </section>
      <section class="alladm">
        <h3>VIEW SYLLABUS</h3>
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
    <br/>
        <br/>
    <hr/>
    <br/>

      <section class="alladm">
        <h3> VIEW CLASS TIMETABLE</h3>
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
                url: 'get_markdiv.php',
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
