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

$qr = "SELECT * FROM division where classteacher='$tid'";
$res = mysqli_query($con, $qr);

while ($rw = mysqli_fetch_assoc($res)) {
    $div=$rw['id'];
    $cls=$rw['classId'];
}


?>

<?php

$limit=8;

$getQuery="SELECT *
FROM student
INNER JOIN parent ON student.id = parent.studentId
where student.classId='$cls' and student.divId='$div'";

$rslt=mysqli_query($con,$getQuery);

$totalrows=mysqli_num_rows($rslt);

$totalpage=ceil($totalrows / $limit);

if(!isset($_GET['page'])){
    $pagenumber=1;
}

else{
    $pagenumber=intval($_GET['page']);
}

$inital=($pagenumber-1) * $limit;


$getQuery="select * from parent limit $inital,$limit";

$showout=getData($getQuery);



function getData($sql){

    $con=mysqli_connect("localhost","root","","sms",3307);
    if(!$con)
    {
        die("Connection Failed");
    }

    $output="";

    $r=mysqli_query($con,$sql);

    if(mysqli_num_rows($r) >0){
        while($rs= mysqli_fetch_array($r)){

            $prf=$rs['profile'];
            $ct=$rs['contact'];
              $em=$rs['email'];
            $sid=$rs['id'];
              $gen=$rs['gender'];
              $ad=$rs['address'];
            $fullname=$rs['firstname']." ".$rs['lastname'];

            $stud=$rs['studentId'];

            $qs="select * from student where id=$stud";

            $rq=mysqli_query($con,$qs);

            if(mysqli_num_rows($rq)==1){
                while($rsq= mysqli_fetch_array($rq)){
                    $studen=$rsq['id']." => ".$rsq['firstname']." ".$rsq['lastname'];
                }
            }

            $output.="
            <tr>
            <td>$sid</td>
            <td><img src='../Parent/files/$prf' alt='' /></td>
            <td>$fullname</td>
            <td><a href='mailto:$em'>$em</a></td>
            <td>$ct</td>
            <td>$gen</td>
            <td><a href='stuinfo.php?viewid=$stud'>$studen</a></td>
                     <td><a href='parentinfo.php?viewid=$sid'><button id='app'>View<i class='fa-regular fa-eye'></i></button></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
            </tr>
            ";            
        }

    }

    else{
        $output.="
                    <tr>
                        <td colspan='8'><h4> No Classroom Is Assigned To This Teacher </h4></td>
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
    <title>Teacher | View Parent</title>
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
            ><i class="fa-solid fa-children"></i> Parent
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">
            <li>
              <a href="viewparent.php"><i class="fa-regular fa-eye"></i></i> View Parent</a>
              
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
              <a href="managesyll.php"><i class="fa-regular fa-note-sticky"></i> Manage Syllabus</a>   
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

        <li>
          <a href="mailbox.php"
            ><i class="fa-solid fa-gear"></i> Settings</a
          >
        </li>
        
      </ul>
    </nav>
    <main class="main">
      <section  class="head">
        <h1>VIEW PARENT</h1>
          <hr/>
      </section>

      <section class="alladm">
        <h3>LIST OF PARENTS</h3>

        <div class="info">
            <table border="1" id="vtable">
                <th> ID </th>
                <th> Profile </th>
                <th> Full Name </th>
                <th> Email </th>
                <th> Contact </th>
                <th> Gender </th>
                <th> Student </th>
                <th> Action </th>

                <?php echo"$showout"; ?>

             </table>

        </div>
             <div class="pagination">
                <<
             <?php
                for($page_curr=1 ; $page_curr <= $totalpage; $page_curr++){
                    
                    echo"<a href='viewparent.php?page=$page_curr'>".$page_curr.'</a>';
                }
             ?>
                >>
             </div>
      </section>
    </main>
  </body>

  <script src="../Admin/jsfile.js"></script>

</html>

</html>
