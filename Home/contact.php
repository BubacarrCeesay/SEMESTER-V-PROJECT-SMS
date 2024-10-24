
<?php

session_start();


$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}

if(isset($_POST['submit'])){

    $fname = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['pnumber'];
    $msg = $_POST['message'];


    $qr="INSERT INTO contactform(name, email, contact, message) VALUES ('$fname','$email','$contact','$msg')";

    $res=mysqli_query($con, $qr);

        if ($res) {

            echo"<script>alert('Form Submitted Successfully!... ✅ Thanks For Contacting Us');</script>";

        } else {
            
            echo"<script>alert('Form Not Submitted .... ⚠️ Something went wrong ');</script>";
        }


  

}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact</title>
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
          <li><a class="active" href="contact.php">Contact</a></li>
          <li>
            <a href="enroll.php">Enrollment</a>
          </li>
          <li>
            <a href="#">Login &nbsp;<i class="fas fa-caret-down"></i></a>
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
        <section class="cntup">
        <div class="overlay"></div>
        <h1>Contact Us</h1>
      </section>
        <section class="contact">
            <section class="quick-contact">
                <h1>Quick Contact</h1>
                <p class="text">Please feel free to contact our friendly staff for any enquiry.</p>
                <div class="details">
                    <p>
                    <i class="fa-solid fa-location-dot"></i>No.4 Dumos Street,
                    Fajikunda, KMC ,The Gambia
                    </p>
                    <p class="loc">
                        <i class="fa-regular fa-envelope"></i
                        ><a href="mailto:BobzeHospital@gmail.com"
                        >info@bobzess.com</a
                        >
                    </p>
                    <p><i class="fa-solid fa-phone"></i>+220 3122713 / +1 7459915614</p>
                <div>
                <div class="map">
                    <h1>Find Us👇⬇️!</h1>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31046.581716072847!2d-16.703102569319785!3d13.423298304815397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xec2999be5f62631%3A0xda70288c4de74e0f!2sNusrat%20Senior%20Secondary%20School!5e0!3m2!1sen!2sin!4v1722019903514!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </section>

            <section class="contact-form">
                <h1>Contact Form</h1>

                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                    <label>
                        Full Name <br/> <input type="text" placeholder="Enter Your Name" name="name" required>
                    </label>
                    <br/>
                    </br>
                    <label>
                        Email<br/> <input type="email" placeholder="Enter Your Email" name="email" required>
                    </label>
                    <br/>
                    </br>
                    <label>
                        Phone Number<br/> <input type="text" placeholder="Enter Phone Number" name="pnumber" required>
                    </label>
                    <br/>
                    </br>
                    <label>
                        Enter Message<br/> <textarea placeholder="Enter Your Message"  rows=8 cols=35 name="message" required></textarea>
                    </label>
                    <br/>
                    </br>

                    <input class="contact-form-submit" type="submit" value="Send Message" name="submit" id="consubmit"/>

                </form>
            </section>
        </section>
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
          <i class="fa-solid fa-location-dot"></i>No.4 Dumos Street, Fajikunda,
          KMC ,The Gambia
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
