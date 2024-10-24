
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
      $cls=$row['classId'];
      $rollno=$row['rollno'];
    $email=$row['email'];
    $cont=$row['contact'];
    $addr=$row['address'];
    $fullname=$fname." ".$lname;

    $profile=$row['profile'];

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


<?php 


if(isset($_POST['fetch'])){

    $examId = intval($_POST['selex']);

    $sql="select * from result where classId=$cls and divId=$did and examId=$examId";

    $qr=mysqli_query($con,$sql);

    $sum=0;

    while($r=mysqli_fetch_array($qr)){
        if(intval($r['studentId'])==intval($sid)){
            $sum=$sum+1;
        }
    }


    $outfetch="";
    $qsub="select * from subject where classId=$cls and divId=$did";
    $fqsub=mysqli_query($con,$qsub);

    $nos=mysqli_num_rows($fqsub);

    if($nos == $sum){
            $outfetch.="
            <tr>
            <td>$rollno</td>
            <td>$fullname</td>
            <td><a href='../fpdf185/mrksheetpdf.php?viewid=$sid&exmid=$examId' target='_blank'><button id='app'>View <i class='fa-regular fa-eye'></i></button></a></td>
            </tr>
            ";            
    }

    else{
            $outfetch.="
            <tr>
            <td colspan='3'>Marks Of All Subject Are Not Yet Inserted </td>
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
    <title>Student | Marksheet </title>
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
          <a href="#" class="prof-btn"
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
          <a href="#" class="prof-btn" id="active"
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
          <h1>MARKSHEET </h1>
          <hr/>
          <br/>
      </section>

      <section>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="frmdown">

          <div class="field">
            <label>Select Exam :</label>
            <p>
              <select name="selex" id="selex" required>
                <option value="" >Select Exam</option>
                <?php echo"$exout"; ?>
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
        <h3><?php 
        if(isset($minfo)){
                echo"$minfo"; 
        }
        else{
            echo"";
        }   
        ?></h3>

        <div class="info">
            <table border="1" id="vtable">

                <th> Roll No. </th>
                <th> Student Name </th>
                <th> Action </th>

                <?php 
                if(isset($outfetch)){
                echo"$outfetch"; 
                }
                else{
                echo"";
                }
                ?>

             </table>

        </div>

      </section>

    </main>
  </body>
 <script src="../Admin/jsfile.js"></script>
</html>
