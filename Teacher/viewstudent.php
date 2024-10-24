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
    $tid=$row['id'];
    $lname=$row['lastname'];

    $profile=$row['profile'];

}



}

$qr = "SELECT * FROM class ORDER BY id";
$res = mysqli_query($con, $qr);
$classout = "";

while ($rw = mysqli_fetch_assoc($res)) {
    $classout .= "<option value='" . $rw['id'] . "'>" . $rw['name'] . "</option>";
}


if (isset($_POST['action']) && $_POST['action'] == 'fetch_data') {
    $limit = 8;

    $pagenumber = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $class = isset($_POST['class']) ? intval($_POST['class']) : null;
    $div = isset($_POST['division']) ? intval($_POST['division']) : null;

    $initial = ($pagenumber - 1) * $limit;

    $whereClause = "";
    if ($class && $div) {
        $whereClause = "WHERE classId=$class AND divId=$div";
    }

    $getQuery = "SELECT * FROM student $whereClause ORDER BY rollno LIMIT $initial, $limit";
    $rslt = mysqli_query($con, $getQuery);
    
    $totalRows = mysqli_num_rows($rslt);

    $allStudentsQuery = "SELECT * FROM student $whereClause";
    $totalRecords = mysqli_num_rows(mysqli_query($con, $allStudentsQuery));

    $totalPages = ceil($totalRecords / $limit);

    $output = getData($getQuery);

    echo json_encode([
        'output' => $output,
        'totalPages' => $totalPages,
        'currentPage' => $pagenumber,
    ]);

    exit();
}

function getData($sql)
{
    global $con;
    $output = "";

    $r = mysqli_query($con, $sql);
    if (mysqli_num_rows($r) > 0) {
        while ($rs = mysqli_fetch_array($r)) {
            $prf = $rs['profile'];
            $roll = $rs['rollno'];
            $em = $rs['email'];
            $sid = $rs['id'];
            $cl = $rs['classId'];
            $di = $rs['divId'];
            $gen = $rs['gender'];
            $ad = $rs['address'];
            $fullname = $rs['firstname'] . " " . $rs['lastname'];

            $classResult = mysqli_query($con, "SELECT name FROM class WHERE id=$cl");
            $divisionResult = mysqli_query($con, "SELECT div_name FROM division WHERE id=$di AND classId=$cl");

            $className = $classResult ? mysqli_fetch_assoc($classResult)['name'] : '';
            $divisionName = $divisionResult ? mysqli_fetch_assoc($divisionResult)['div_name'] : '';

            $output .= "
                <tr>
                    <td>$sid</td>
                    <td>$roll</td>
                    <td><img src='../Student/files/$prf' alt='' /></td>
                    <td>$fullname</td>
                    <td>$em</td>
                    <td>$className</td>
                    <td>$divisionName</td>
                    <td>$ad</td>
                    <td>$gen</td>
                    <td><a href='stuinfo.php?viewid=$sid'><button id='app'>View<i class='fa-regular fa-eye'></i></button></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                </tr>
            ";
        }
    }

    else{
        $output.="
                    <tr>
                        <td colspan='10'><h4> Class And Division Is Empty</h4></td>
                    </tr>       
        ";
    }


      return $output;


}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher | View Student</title>
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
          <a href="#" class="prof-btn"  id="active"
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
        <h1>VIEW MY STUDENTS</h1>
          <hr/>
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
          <input type="submit" value="Filter Record" name="filter" />
        </p>
        </form>
    </section>
    <hr/>
    <section class="alladm">
        <h3>LIST OF STUDENTS</h3>
        <div class="info" id="infohght">
            <table border="1" id="vtable">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> Roll No. </th>
                        <th> Profile </th>
                        <th> Full Name </th>
                        <th> Email </th>
                        <th> Class </th>
                        <th> Division </th>
                        <th> Address </th>
                        <th> Gender </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody id="tableData">
                    <tr>
                        <td colspan="10"><h4>Select Class And Division To Display Records</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="pagination" id="paginationLinks"></div>
    </section>
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

            if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="empty") {
                echo "showAlert('⚠️ Class and Division Is Empty!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="notdeleted") {
                echo "showAlert('⚠️ Error, Student Not Added!');";
                unset($_SESSION['update_success']);
            }

            else if (isset($_SESSION['update_success']) && $_SESSION['update_success']=="deleted") {
                echo "showAlert('✅ Student Deleted Successfully!');";
                unset($_SESSION['update_success']);
            }

            ?>
        };
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(document).ready(function () {


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

            $('#filterform').submit(function (e) {
                e.preventDefault();
                fetchData();
            });


            $(document).on('click', '.page-link', function () {
                const page = $(this).data('page');
                fetchData(page);
            });

            function fetchData(page = 1) {
                const classId = $('#class').val();
                const divisionId = $('#division').val();
                $.ajax({
                    type: 'POST',
                    url: 'viewstudent.php',
                    data: {
                        action: 'fetch_data',
                        class: classId,
                        division: divisionId,
                        page: page
                    },
                    success: function (response) {
                        const data = JSON.parse(response);
                        $('#tableData').html(data.output);
                        generatePagination(data.totalPages, data.currentPage);
                    }
                });
            }

            function generatePagination(totalPages, currentPage) {
                let pagination = "";
                for (let i = 1; i <= totalPages; i++) {
                    pagination += `<a href="javascript:void(0);" class="page-link" data-page="${i}">${i}</a>`;
                }
                $('#paginationLinks').html(pagination);
            }
        });
    </script>

</body>
</html>

</html>
