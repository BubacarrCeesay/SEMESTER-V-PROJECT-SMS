

<?php

$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$con)
{
    die("Connection Failed");
}


$classout = "";

$qr = "SELECT * FROM admin";
$res = mysqli_query($con, $qr);
$classout.="<option style='color:red;font-weight:bold;' value=''>ADMIN</option>";
while ($rw = mysqli_fetch_assoc($res)) {
    $classout .= "<option value='admin'>Admin</option>";
}

$qr = "SELECT * FROM teacher ORDER BY id";
$res = mysqli_query($con, $qr);
$classout.="<option style='color:red;font-weight:bold;' value=''>TEACHERS</option>";
while ($rw = mysqli_fetch_assoc($res)) {
    $classout .= "<option value='" . $rw['id'] . "'>" .$rw['firstname']." ".$rw['lastname'].""."</option>";
}

$qr = "SELECT * FROM parent ORDER BY id";
$res = mysqli_query($con, $qr);
$classout.="<option style='color:red;font-weight:bold;' value=''>PARENTS</option>";
while ($rw = mysqli_fetch_assoc($res)) {
    $classout .= "<option value='" . $rw['id'] . "'>" .$rw['id']." => ". $rw['firstname']." ".$rw['lastname'].""."</option>";
}

$qr = "SELECT * FROM student ORDER BY id";
$res = mysqli_query($con, $qr);
$classout.="<option style='color:red;font-weight:bold;' value=''>STUDENTS</option>";
while ($rw = mysqli_fetch_assoc($res)) {
    $classout .= "<option value='" . $rw['id'] . "'>" .$rw['id']." => ". $rw['firstname']." ".$rw['lastname'].""."</option>";
}



$mailout="

              <h3>Compose New Mail</h3>
              <section>
                  <form method='post' class='frmdown' id='mailfrm' enctype='multipart/form-data'>
                        <div class='field'>
                          <label>Select Receiver:</label>
                          <p>
                            <select name='receiver' required>
                              <option value=''>Select Receiver</option>
                              $classout;
                            </select>
                          </p>
                        </div>  

                      <div class='field'>
                        <label>Subject:</label>
                        <p>
                          <input type='text' name='sub' placeholder='Enter Subject' required/>
                        </p>
                      </div>

                      <div class='field'>
                        <label>Attach A File (Optional):</label>
                        <p>
                          <input type='file' name='attch' />
                        </p>
                      </div>


                      <div class='field'>
                        <label>Message:</label>

                            <textarea name='msg' rows='10' placeholder='Enter Message' ></textarea>

                      </div>

                        <p class='sbtfrm' id='filsub'>
                            <input type='submit' value='Send' name='send' />
                        </p>
                      
                  </form>
              </section>        


";


echo"$mailout";
?>
