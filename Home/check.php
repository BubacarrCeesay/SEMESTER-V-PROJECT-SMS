
<?php

session_start();


$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}


?>

<?php

if(isset($_POST['enroll'])){

    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $pswrd = $_POST['pswrd'];


    $sql="SELECT * from enroll where email='$email' and username='$uname' and password='$pswrd'";

    $qc=mysqli_query($con,$sql);

    if(mysqli_num_rows($qc)==1){
        while($rw=mysqli_fetch_array($qc)){
            $fb=$rw['feedback'];
            $st=$rw['status'];
        }

        echo"<script>alert('Application Status : $st \\nFeedBack : $fb');</script>";
    }

    else{
        echo"<script>alert('Invalid Details ..... ');</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Enroll Student</title>
    <link rel="website icon" type="" href="logo.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="index.css" />
  </head>

  <body>
    <header>
      <div class="logo">
        <a href="home.php"><img src="logo.png" /></a>
      </div>

      <div class="nav" id="nav">
         <i id="close" class="fa-solid fa-xmark"></i>
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li>
            <a class="active" href="enroll.php">Enrollment</a>
          </li>
          <li>
            <a  href="#">Login &nbsp;<i class="fas fa-caret-down"></i></a>
            <div class="drop_down1">
              <ul>
                <li><a href="adminlogin.php">Admin</a></li>
                <li><a href="teacherlogin.php">Teacher</a></li>
                <li><a href="studlogin.php">Student</a></li>
                <li><a href="parentlogin.php">Parent</a></li>
              </ul> 
            </div>
          </li>
        </ul>
      </div>
            <div id="bar">
                <i id="iconbar" class="fa-solid fa-bars"></i>
            </div>
    </header>

    <main>
      <section class="frmup">
        <h1>STATUS CHECKING FORM</h1>
        <p>** All Fields Are <span>Required</span> **</p>
      </section>

      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <section class="frmdown">

          <div class="field">
            <label>Email :</label>
            <p>
              <i class="fa-regular fa-envelope"></i>
              <input type="email" name="email" required/>
            </p>
        </div>

          <div class="field">
            <label>Username :</label>
            <p>
              <i class="fa-solid fa-user-tie"></i>
              <input type="text" name="uname" required/>
            </p>
          </div>

          <div class="field">
            <label>Password :</label>
            <p>
              <i class="fa-solid fa-lock"></i>
              <input type="text" name="pswrd" required/>
            </p>
          </div>

        </section>

        <p class="sbtfrm">
          <input type="submit" value="Check" name="enroll" />
        </p>
      </form>
    </main>

    <footer>
      <section class="up">
        <div class="follow-us">
          <h3>Follow Us</h3>
          <div class="sm-icons">
            <a href="https://www.facebook.com/" target="_blank">
              <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="https://twitter.com/?lang=en-in" target="_blank">
              <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="https://www.instagram.com/?hl=en" target="_blank">
              <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://www.youtube.com/" target="_blank">
              <i class="fa-brands fa-youtube"></i>
            </a>
            <a href="https://web.telegram.org/" target="_blank">
              <i class="fa-brands fa-telegram"></i>
            </a>
          </div>
        </div>
        <div class="useful-links">
          <h3>Quick Links</h3>
          <ul>
            <li><a href="about.php">About Us</a></li>
            <hr />
            <li><a href="contact.php">Contact Us</a></li>
            <hr />
            <li><a href="studlogin.php">Student Login</a></li>
            <hr />
            <li><a href="enroll.php">Enroll Now</a></li>
            <hr />
          </ul>
        </div>
        <div class="contact-footer">
          <h3>Quick Contact</h3>
          <p>
            <i class="fa-solid fa-location-dot"></i>No.4 Dumos Street,
            Fajikunda, KMC ,The Gambia
          </p>
          <p class="loc">
            <i class="fa-regular fa-envelope"></i>
            <a href="mailto:BobzeHospital@gmail.com">info@bobzess.com</a>
          </p>
          <p><i class="fa-solid fa-phone"></i>+220 3122713 / +1 7459915614</p>
        </div>
      </section>
      <section class="down">
        <p class="copyright-info">
          &copy;Bobze Secondary School,2024. All rights reserved.
        </p>
      </section>
    </footer>
  </body>
   <script src="script.js"></script>
</html>
