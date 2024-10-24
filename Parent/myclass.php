
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

             $cl=$rs['classId'];
              $di=$rs['divId'];

            $qy="select * from class where id=$cl";
            $rcl=mysqli_query($con,$qy);

            $qd="select * from division where id=$di and classId=$cl";
            $rd=mysqli_query($con,$qd);


            if((mysqli_num_rows($rcl) > 0) && (mysqli_num_rows($rd) >0)){
                $rco= mysqli_fetch_array($rcl);
                $rdo= mysqli_fetch_array($rd);
                $dn=$rdo['div_name'];
                $ct=intval($rdo['classteacher']);
                $cn=$rco['name'];
            }

            $nosub=mysqli_query($con,"select * from subject where classId=$cl and divId=$di");

            $totalsub=mysqli_num_rows($nosub);

            $nos=mysqli_query($con,"select * from student where classId=$cl and divId=$di");

            $totals=mysqli_num_rows($nos);

            $tt="select * from teacher where id=$ct";

            $qtt=mysqli_query($con,$tt);

            if(mysqli_num_rows($qtt) == 1){
                $rtt=mysqli_fetch_array($qtt);
                
                $tfn=$rtt['firstname']." ".$rtt['lastname'];
                $tcon=$rtt['contact'];
            }




        }

        

    }

            $subout="";

            $sub=mysqli_query($con,"select * from subject where classId=$cl and divId=$di");

            if(mysqli_num_rows($sub) > 0){

                while($rsub=mysqli_fetch_array($sub)){

                    $nm=$rsub['name'];
                    $sid=$rsub['id'];
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
                    <td>$sid</td>
                    <td>$nm</td>
                    <td>$tnn</td>
                    </tr>
                    ";      

                }

            }

            else{
                    $subout.="
                    <tr>
                    <td colspan=2>No Subject Is Assigned To This Class Yet</td>
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
    <title>Parent | Class Info. </title>
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
                                <th> No. Of Student </th>
                                <th> No. Of Subject </th> 
                                <th> Class Teacher's Name </th> 
                                <th> Class Teacher's Contact </th> 
                            </tr>
                            <tr>
                                <?php

                                if(isset($noclth)){
                                    echo"$noclth";
                                }

                                else{
                                    echo"             
                                            <td> $cn</td>
                                            <td> $dn</td>
                                            <td> $totals</ td>
                                            <td> $totalsub </td>
                                            <td> $tfn </td>  
                                            <td> $tcon </td>                                  
                                    ";
                                }

                                ?>
                            </tr>
                    </table>

                <h3> Class Subjects </h3>

                <div class="info">
                    <table border="1" id="">
                            <tr>
                                <th> Subject Code </th>
                                <th> Name </th>
                                <th> Subject Teacher </th>
                            </tr>

                            <?php echo"$subout" ?>

                    </table>
            </section>

    </main>
  </body>

  <script src="../Admin/jsfile.js"></script>

</html>