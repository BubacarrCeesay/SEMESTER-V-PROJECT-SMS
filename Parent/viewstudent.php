
<?php

session_start();

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}

if(isset($_SESSION['parent'])){

    $username=$_SESSION['parent'];

    $query="select * from parent where username='$username'";

    $result=mysqli_query($con, $query);

    while($row=mysqli_fetch_array($result)){
    
    $fname=$row['firstname'];
    $lname=$row['lastname'];
     $pid=$row['id'];
      $sid=$row['studentId'];
    $email=$row['email'];
    $cont=$row['contact'];
    $addr=$row['address'];

    $profile=$row['profile'];

}


    $sql="select * from student where id=$sid";

    $r=mysqli_query($con,$sql);

    if(mysqli_num_rows($r)==1){
        while($rs= mysqli_fetch_array($r)){

            $prf=$rs['profile'];
             $roll=$rs['rollno'];
              $em=$rs['email'];
            $un=$rs['username'];
             $cl=$rs['classId'];
              $di=$rs['divId'];
              $gen=$rs['gender'];
              $ad=$rs['address'];
              $ct=$rs['contact'];
              $dob=$rs['dob'];
            $fullname=$rs['firstname']." ".$rs['lastname'];

            $qy="select * from class where id=$cl";
            $rcl=mysqli_query($con,$qy);

            $qd="select * from division where id=$di and classId=$cl";
            $rd=mysqli_query($con,$qd);


            if((mysqli_num_rows($rcl) > 0) && (mysqli_num_rows($rd) >0)){
                $rco= mysqli_fetch_array($rcl);
                $rdo= mysqli_fetch_array($rd);
                $d=$rdo['div_name'];
                $c=$rco['name'];
            }

        }

        

    }


    $fc="SELECT * FROM feesinvoice where studentId=$sid and classId=$cl";

    $qf=mysqli_query($con,$fc);

    if(mysqli_num_rows($qf)==1){

        $fs="PAID";
    }
    else{
        $fs="NOT PAID";
    }


}


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parent | Student Info. </title>
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
        <img src="../Student/logo.png" alt="#">
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
          <p class="pson"><i class="fa-solid fa-circle"></i> Parent</p>
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
            ><i class="fa-regular fa-user"></i> Parent
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
            ><i class="fa-solid fa-chalkboard-user"></i> Student
            <span class="fas fa-caret-down arrow"></span>
          </a>
          <ul class="sub">

            <li>
              <a href="viewstudent.php"><i class="fa-regular fa-eye"></i></i>Student Info </a>
              
            </li>

            <li>
              <a href="myclass.php"><i class="fa-solid fa-door-open"></i> Class Info </a>
            </li>

            <li>
              <a href="marksheet.php"><i class="fas fa-print"></i> Marksheet</a>
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
          <h1>STUDENT'S INFORMATION </h1>
          <hr/>
      </section>

      <section class="profinfo">
        <div class="left">

        <?php echo"<img src='../Student/files/$prf' alt='' />" ?>


        <h3><span><?php echo"$fullname" ?></span></h3>

        <table border="1">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> Class </th>
                        <th> Division </th>
                        <th> Roll No. </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span><?php echo"$sid" ?></span></th>
                        <td><span><?php echo"$c" ?></span></th>
                        <td><span><?php echo"$d" ?></span></th>
                        <td><span><?php echo"$roll" ?></span></th>
                    </tr>                    
                </tbody>            

        </table>



        </div>

        <div class="right">

                <p>Email : <a href="mailto:<?php echo"$em" ?>"><span id="lnk"><?php echo"$em" ?></span></a></p>

                <p>Contact : <a href="tel:<?php echo"$ct" ?>"><span id="lnk"><?php echo"$ct" ?></span></a></p>

                <p>Username : <span><?php echo"$un" ?></span></a></p>

                <p>Gender : <span><?php echo"$gen" ?></span></a></p>

                <p>Date Of Birth : <span><?php echo"$dob" ?></span></a></p>

                <p>Address : <span><?php echo"$ad" ?></span></a></p>

                <br/><br/>

                <p>FEES STATUS : <span style="color:red; font-weight:bolder;"><?php echo"$fs" ?></span></a></p>


        </div>


      </section>

    </main>
  </body>

  <script src="../Admin/jsfile.js"></script>


 
</html>
