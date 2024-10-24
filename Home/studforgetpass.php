
<?php 

session_start();


$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}

if(isset($_POST['reset']))
{

  $username=$_POST['username'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];

  $error=array();

  if($password != $cpassword){
     $error['teacher']="⚠️ Both Password Does Not Match";
  }

  else{


            $query="select * from student where username='$username' and email='$email'";

            $result=mysqli_query($con, $query);

            if(mysqli_num_rows($result)==1){
                
                $sql="Update student set password='$cpassword' where username='$username' and email='$email'";

                $qry=mysqli_query($con,$sql);

                if($qry){
                     $error['teacher']="✅ Password Is Reset Successfully...";
                }
                else{
                    $error['teacher']="⚠️ Error In Changing Password";
                }
            }
            else{
                $error['teacher']="⚠️ Invalid Username or Email ";
            }
  }

}
else{
    $error['teacher']="** All Fields Are Required **";
}


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
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

    <main>
      <section class="logup">
        <h1>RESET PASSWORD</h1>
        <p><?php echo"$error[teacher]" ?></p>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
          <div class="field">
            <label>Username :</label>
            <div>
              <i class="fa-solid fa-user"></i>
              <input type="text" name="username"  placeholder="Enter Username" required autocomplete="off"/>
            </div>
          </div>

          <div class="field">
            <label>Email :</label>
            <div>
              <i class="fa-solid fa-envelope"></i>
              <input type="email" name="email"  placeholder="Enter Email" required autocomplete="off"/>
            </div>
          </div>

          <div class="field">
            <label>New Password :</label>
            <div>
              <i class="fa-solid fa-lock"></i>
              <input type="password" name="password" placeholder="Enter New Password" required autocomplete="off"/>
            </div>
          </div>

          <div class="field">
            <label>Confirm New Password :</label>
            <div>
              <i class="fa-solid fa-lock"></i>
              <input type="password" name="cpassword" placeholder="Enter Confirm Password" required autocomplete="off"/>
            </div>
          </div>

          <h2><input type="submit" value="RESET" name="reset" /></h2>
        </form>

        <h3><a href="studlogin.php" ><button>BACK TO LOGIN</button></a></h3>

      </section>
    </main>

  </body>
</html>
