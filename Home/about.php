<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About</title>
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
          <li><a class="active" href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
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
      <section class="abtup">
        <div class="overlay"></div>
        <h1>About Us</h1>
      </section>
      <section class="info">
        <div class="welcome">
          <h1>Welcome To <span> Bobze Secondary School</span></h1>
          <p>
            Welcome to <b><i>Bobze Secondary School</i></b> where execellence
            meet legacy. Established in <b><i>2003</i></b> , we take pride in
            over a decade of fostering Knowledge and growth. As we contionue our
            journey, we invite you to part of our rich tradition of learning,
            innovation and success. <b><i>BSS</i></b> aims to provide an
            environment which facilitates the development of children in a
            manner that is fun-filled, creative and stimulating.
          </p>

          <p>
            At <b><i>BSS</i></b
            >, we offer quality school education with world-class infrastructure
            facilities. It truly believes in holistic development of their
            children encompassing intellectual, emotional, artistic and physical
            growth… to create global citizens. Sports playground and activities
            are an integral part of the campus. Our school seeks to cultivate a
            sense of National Responsibility through its efforts to develop
            physical education a base for betterment of future generation.
          </p>
        </div>

        <div class="mvf">
          <div class="img">
            <img src="mvf.jpg" alt="" />
          </div>
          <div class="text">
            <div class="mission">
              <div class="icon"><i class="fa-solid fa-users"></i></div>
              <div>
                <h1>Our Mission</h1>
                <p>
                  In <b>BSS</b>, Our mission is to inspire learning, foster
                  critical thinking and nuture well-rounded individuals in a
                  dynamic and inclusive environment.
                </p>
              </div>
            </div>
            <hr />
            <div class="vision">
              <div class="icon"><i class="fa-regular fa-eye"></i></div>
              <div>
                <h1>Our Vision</h1>
                <p>
                  In <b>BSS</b>, Our vision is empowering future leaders through
                  innovative education, personal growth, and community
                  engagement, preparing students for global challenges
                </p>
              </div>
            </div>
            <hr />
            <div class="vision">
              <div class="icon">
                <i class="fa-sharp-duotone fa-solid fa-camera-retro"></i>
              </div>
              <div>
                <h1>Our Focus</h1>
                <p>
                  In <b>BSS</b>, Our focus is dedicated to academic excellence,
                  holistic development, and fostering a culture of curiosity,
                  respect, and lifelong learning in every student
                </p>
              </div>
            </div>
          </div>
        </div>
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
