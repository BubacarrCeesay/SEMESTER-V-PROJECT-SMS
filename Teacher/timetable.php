
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

$qr = "SELECT * FROM exam ORDER BY id";
$res = mysqli_query($con, $qr);
$exout = "";

while ($rw = mysqli_fetch_assoc($res)) {
    $exout .= "<option value='" . $rw['id'] . "'>" . $rw['name'] . "</option>";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher | Exam Timetbale </title>
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
          <a href="#" class="prof-btn" id="active"
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
          <h1>EXAM TIMETABLE</h1>
          <hr/>
          <br/>
      </section>
  <section class="managesub">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" class="frmdown" id="subfrm">
          <div class="field">
            <label>Select Exam:</label>
            <p>
              <select name="selex" id="selex" required>
                <option value="" >Select Exam</option>
                <?php echo"$exout"; ?>
              </select>
            </p>
          </div>  
        </form>

    <section class="alladm">
        <h3> TimeTable Info. </h3>

        <div class="info">
            <table border="1" id="vtable">
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Published Date </th>
                        <th> File Option </th>
                    </tr>
                </thead>

                <tbody id="tableData"></tbody>

             </table>
      </section>
    </section>

    </main>
  </body>

  <script src="../Admin/jsfile.js"></script>

    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    $(document).ready(function() {

        $('#selex').change(function() {
            var exmId = $('#selex').val();
            if (exmId) {
                $.ajax({
                    type: 'POST',
                    url: 'get_timetable.php',
                    data: {exm_Id: exmId},
                    success: function(response) {
                        $('#tableData').html(response);
                    }
                });
            }
        });


    });


    </script>


</html>
