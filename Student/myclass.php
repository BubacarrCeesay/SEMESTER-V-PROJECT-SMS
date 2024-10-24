
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}

if(isset($_SESSION['student'])){

    $username=$_SESSION['student'];

    $query="select * from student where username='$username'";

    $result=mysqli_query($con, $query);

    while($row=mysqli_fetch_array($result)){
    
    $fname=$row['firstname'];
    $lname=$row['lastname'];
     $sid=$row['id'];
      $did=$row['divId'];
    $email=$row['email'];
    $cont=$row['contact'];
    $addr=$row['address'];

    $profile=$row['profile'];

}
}

?>

<?php


    $sql="select * from division where id='$did'";

    $r=mysqli_query($con,$sql);

    $stuinfo="";
    $subout="";

    if(mysqli_num_rows($r)==1){
        while($rs= mysqli_fetch_array($r)){

            $class=$rs['classId'];
            $name=$rs['div_name'];
             $tid=$rs['classteacher'];

            $qy="select * from class where id=$class";
            $rcl=mysqli_query($con,$qy);


            if(mysqli_num_rows($rcl) > 0){
                $rco= mysqli_fetch_array($rcl);
                $cn=$rco['name'];
            }   
            
            
            $nos=mysqli_query($con,"select * from student where classId=$class and divId=$did order by rollno");

            $totalst=mysqli_num_rows($nos);

            if(mysqli_num_rows($nos) > 0){

                while($rs= mysqli_fetch_array($nos)){
                $fstname=$rs['firstname'];
                $lstname=$rs['lastname'];
                $rn=$rs['rollno'];

                    $stuinfo.="
                    <tr>
                    <td>$rn</td>
                    <td>$fstname</td>
                    <td>$lstname</td>
                    </tr>
                    ";     
                }             

            }  
            
            $nosub=mysqli_query($con,"select * from subject where classId=$class and divId=$did");

            $totalsub=mysqli_num_rows($nosub);

            $qt="select * from teacher where id='$tid'";

            $rt=mysqli_query($con,$qt);

            if(mysqli_num_rows($rt) > 0){
                $rcot= mysqli_fetch_array($rt);
                $tname=$rcot['firstname']." ".$rcot['lastname'];
            }   

            if(isset($tname)){

            }
            else{
                $tname="N\A";
            }
                
                    $subout.="
                    <tr>
                    <td>$cn</td>
                    <td>$name</td>
                    <td>$tname</td>
                    <td>$totalsub</td>
                    <td>$totalst</td>
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
    <title>Student | Class Info </title>
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
          <p class="pson"><i class="fa-solid fa-circle"></i> Student</p>
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
            ><i class="fa-regular fa-user"></i> Student
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
          <a href="#" class="prof-btn" id="active"
            ><i class="fa-solid fa-school"></i> Classroom
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="myclass.php"><i class="fa-solid fa-door-open"></i> Class Info </a>
            </li>
            <li>
              <a href="mysub.php"><i class="fa-solid fa-book"></i> My Subjects</a>
              
            </li>

          </ul>
      </li>

      <li>
          <a href="#" class="prof-btn"
            ><i class="fa-solid fa-chalkboard-user"></i></i> Parent
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">

            <li>
              <a href="viewparent.php"><i class="fa-regular fa-eye"></i></i>My Parent</a>
              
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
              <a href="viewmark.php"><i class="fa-regular fa-eye"></i> View Mark</a>
            </li>
            <li>
              <a href="marksheet.php"><i class="fas fa-print"></i> Marksheet</a>
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
              <a href="studymaterial.php"><i class="fa-regular fa-file-pdf"></i>Study Material</a>
              
            </li>
            <li>
              <a href="assignment.php"><i class="fas fa-file-pdf"></i></i>Assignment</a>
              
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
          <h1>CLASS INFORMATION </h1>
          <hr/>
      </section>
      </section>
            <section class="alladm">
                <h3> Class Summary </h3>

                <div class="info">
                    <table border="1" id="">
                            <tr>
                                <th> Class </th>
                                <th> Division </th>
                                <th> Class Teacher </th>
                                <th> No. Of Student </th>
                                <th> No. Of Subject </th>
                            </tr>
                            <tr>
                                <?php

                                    echo"$subout";

                                ?>
                            </tr>
                    </table>

                <h3> Class Students </h3>

                <div class="info">
                    <table border="1" id="">
                            <tr>
                                <th> Roll Number </th>
                                <th> First Name </th>
                                <th> Last Name </th>
                            </tr>

                            <?php echo"$stuinfo" ?>

                    </table>
            </section>
    </main>
  </body>

  <script src="../Admin/jsfile.js"></script>
</html>
