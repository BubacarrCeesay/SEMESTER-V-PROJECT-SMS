
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apply As Teacher</title>
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

      <div class="nav">
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li>
            <a class="active" href="#"
              >Register &nbsp; <i class="fas fa-caret-down"></i
            ></a>
            <div class="drop_down">
              <ul>
                <li><a href="enroll.php">Enroll Student</a></li>
                
              </ul>
            </div>
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
    </header>

    <main>
      <section class="frmup">
        <h1>Teacher Application FORM</h1>
        <p>** All Fields Are <span>Required</span> **</p>
      </section>

      <form action="#" method="#">
        <section class="frmdown">
          <div class="field">
            <label>First Name :</label>
            <p>
              <i class="fa-solid fa-user"></i>
              <input type="text" name="fname" />
            </p>
          </div>

          <div class="field">
            <label>Last Name :</label>
            <p>
              <i class="fa-solid fa-image-portrait"></i>
              <input type="text" name="lname" />
            </p>
          </div>

          <div class="field">
            <label>Email :</label>
            <p>
              <i class="fa-regular fa-envelope"></i>
              <input type="email" name="email" />
            </p>
          </div>

          <div class="field">
            <label>Address :</label>
            <p>
              <i class="fa-solid fa-location-dot"></i>
              <input type="text" name="address" />
            </p>
          </div>

          <div class="field">
            <label>Username :</label>
            <p>
              <i class="fa-solid fa-user-tie"></i>
              <input type="text" name="uname" />
            </p>
          </div>

          <div class="field">
            <label>Password :</label>
            <p>
              <i class="fa-solid fa-lock"></i>
              <input type="text" name="pswrd" />
            </p>
          </div>

          <div class="field">
            <label>Contact :</label>
            <p>
              <i class="fa-solid fa-phone"></i>
              <input type="text" name="contact" />
            </p>
          </div>

          <div class="field">
            <label>D.O.B :</label>
            <p>
              <i class="fa-regular fa-calendar-days"></i>
              <input type="date" name="dob" />
            </p>
          </div>

          <div class="field">
            <label>Gender :</label>
            <p>
              <i class="fa-solid fa-person-half-dress"></i>
              <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Class :</label>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="class" required>
                <option value="">Apply for Class</option>
                <option value="seven">Seven &nbsp; (7th)</option>
                <option value="eight">Eight &nbsp; (8th)</option>
                <option value="nine">Nine &nbsp; (9th)</option>
              </select>
            </p>
          </div>

          <div class="field">
            <label>Previous School Name (If Any):</label>
            <p>
              <i class="fa-solid fa-school"></i>
              <input type="text" name="prevschool" />
            </p>
          </div>

          <div class="field">
            <label>Resume :</label>
            <p>
              <i class="fa-solid fa-file"></i>
              <input type="file" name="prevmrks" />
            </p>
          </div>

          <div class="field">
            <label>Profile Picture :</label>
            <p>
              <i class="fa-regular fa-file"></i>
              <input type="file" name="profpic" />
            </p>
          </div>

          <div class="field">
            <label>Course :</label>
            <p>
              <i class="fa-solid fa-book"></i>
              <select name="subject" required>
                <option value="">Select Subject</option>

              </select>
            </p>
          </div>
        </section>

        <p class="sbtfrm">
          <input type="submit" value="Submit Application" name="enroll" />
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
</html>
