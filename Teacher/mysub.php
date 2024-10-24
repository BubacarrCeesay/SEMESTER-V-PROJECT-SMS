
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


    $sql="select * from subject where teacherId='$tid'";

    $r=mysqli_query($con,$sql);

    $totalsub=mysqli_num_rows($r);
    $totalst=0;

    $subout="";

    if(mysqli_num_rows($r)>0){
        while($rs= mysqli_fetch_array($r)){

            $class=$rs['classId'];
            $name=$rs['name'];
            $div=$rs['divId'];
            $sid=$rs['id'];

            $qy="select * from class where id=$class";
            $rcl=mysqli_query($con,$qy);


            if(mysqli_num_rows($rcl) > 0){
                $rco= mysqli_fetch_array($rcl);
                $cn=$rco['name'];
            }   

            $qs="select * from student where classId=$class and divId=$div";
            $rs=mysqli_query($con,$qs);

            $totalst=$totalst + mysqli_num_rows($rs);

            $qd="select * from division where id=$div";
            $rd=mysqli_query($con,$qd);



            if(mysqli_num_rows($rd) > 0){
                $ro= mysqli_fetch_array($rd);
                $dn=$ro['div_name'];
            }   
            

                    $subout.="
                    <tr>
                    <td>$sid</td>
                    <td>$name</td>
                    <td>$cn</td>
                    <td>$dn</td>
                    </tr>
                    ";      

        }
}
else{

    $subout="
                    <td colspan=4> <h3 style='color:red;'>You're Not Assigned To Any Subject Yet <h3></td>   
    ";

}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher | My Subjects </title>
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
          <a href="#" class="prof-btn" id="active"
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
          <h1>MY SUBJECTS </h1>
          <hr/>
      </section>
            <section class="alladm">
                <h3> Subjects Summary </h3>

                <div class="info">
                    <table border="1" id="">
                            <tr>
                                <th> Subject Code </th>
                                <th> Name </th>
                                <th> Class </th>
                                <th> Division </th>
                            </tr>

                            <?php echo"$subout" ?>

                    </table>

                    <h3 style="color: black; text-align:right;">Total Subjects =: <span style="color: red;"><?php echo"$totalsub"; ?></span></h3>
                    <h3 style="color: black; text-align:right;">Total Students =: <span style="color: red;"><?php echo"$totalst"; ?></span></h3>
            </section>

    </main>
  </body>

  <script src="../Admin/jsfile.js"></script>

</html>
