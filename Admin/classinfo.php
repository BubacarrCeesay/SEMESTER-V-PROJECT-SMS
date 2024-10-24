
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if(isset($_GET['viewid'])){

    $div=$_GET['viewid'];

    $sql="select * from division where id=$div";

    $r=mysqli_query($con,$sql);

    $subout="";

    if(mysqli_num_rows($r)==1){
        while($rs= mysqli_fetch_array($r)){

            $class=$rs['classId'];
            $name=$rs['div_name'];
            $tch=$rs['classteacher'];

            $qy="select * from class where id=$class";
            $rcl=mysqli_query($con,$qy);


            if(mysqli_num_rows($rcl) > 0){
                $rco= mysqli_fetch_array($rcl);
                $cn=$rco['name'];
            }   
            
            $qt="select * from teacher where id=$tch";
            $rt=mysqli_query($con,$qt);


            if(mysqli_num_rows($rt) > 0){
                $ro= mysqli_fetch_array($rt);
                $tn=$ro['firstname']." ".$ro['lastname'];
                $tprof=$ro['profile'];
                $em=$ro['email'];
                $ct=$ro['contact'];
            }   
            
            $nos=mysqli_query($con,"select * from student where classId=$class and divId=$div");

            $totals=mysqli_num_rows($nos);

            $nosub=mysqli_query($con,"select * from subject where classId=$class and divId=$div");

            $totalsub=mysqli_num_rows($nosub);

            $sub=mysqli_query($con,"select * from subject where classId=$class and divId=$div");

            if(mysqli_num_rows($sub) > 0){

                while($rsub=mysqli_fetch_array($sub)){

                    $nm=$rsub['name'];
                    $tna=$rsub['teacherId'];

                    if($tna == 0)
                    {
                        $tnn="N\A";
                    }
                    else{

                        $qtn="select * from teacher where id=$tna";
                        $rtn=mysqli_query($con,$qtn);


                        if(mysqli_num_rows($rtn) > 0){
                            $ron= mysqli_fetch_array($rtn);
                            $tnn=$ron['firstname']." ".$ron['lastname'];
                        }  
                    }

                    $subout.="
                    <tr>
                    <td>$nm</td>
                    <td>$tnn</td>
                    </tr>
                    ";      

                }

            }

            else{
                    $subout.="
                    <tr>
                    <td colspan=2>No Subject Is Assigned Yet</td>
                    </tr>
                    ";                     
            }


        }

}

}

?>

<?php

if (isset($_SESSION['admin'])) {
    $username = $_SESSION['admin'];

    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        $ad_name = $row['fullname'];
        $profile = $row['profile'];
    }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | View Class Info. </title>
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
        <h1> CLASS INFORMATION </h1>
          <hr/>
      </section>

        <section class="profinfo">
            <div class="left">
                <h3> Class Teacher </h3>

            <?php 
            
            if(isset($tprof))
            {

                echo"<img src='../Teacher/files/$tprof' alt='' />";
            }
            else{

            }
          
            
            ?>


            <h3><span><?php
            if(isset($tn))
            {

                 echo"$tn";
            }
            else{
              
               echo"No Class Teacher Is Assign";
            }

            ?>
          </span></h3>


                <p>Email : <a href="mailto:<?php
            if(isset($em))
            {

                 echo"$em";
            }
            else{
              
            }

            ?>"><span id="lnk"><?php
            if(isset($em))
            {

                 echo"$em";
            }
            else{
              
            }

            ?></span></a></p>

                <p>Contact : <a href="tel:<?php
            if(isset($ct))
            {

                 echo"$ct";
            }
            else{
              
            }

            ?>"><span id="lnk"><?php
            if(isset($ct))
            {

                 echo"$ct";
            }
            else{
              
            }

            ?></span></a></p>

                <p><a href="tchinfo.php?viewid=<?php
            if(isset($tch))
            {

                 echo"$tch";
            }
            else{
              
            }

            ?>"><button>View Profile</button></a></p>


            </div>

            <section class="alladm">
                <h3> Class Summary </h3>

                <div class="info">
                    <table border="1" id="">
                            <tr>
                                <th> Class </th>
                                <th> Division </th>
                                <th> No. Of Student </th>
                                <th> No. Of Subject </th> 
                            </tr>
                            <tr>
                                <td> <?php echo"$cn" ?> </td>
                                <td> <?php echo"$name" ?> </td>
                                <td> <?php echo"$totals" ?> </td>
                                <td> <?php echo"$totalsub" ?> </td>
                            </tr>
                    </table>

                <h3> Subjects </h3>

                <div class="info">
                    <table border="1" id="">
                            <tr>
                                <th> Name </th>
                                <th> Subject Teacher </th>
                            </tr>

                            <?php echo"$subout" ?>

                    </table>
            </section>



        </section>






    </main>
  </body>

  <script src="jsfile.js"></script>



</body>
</html>

</html>
