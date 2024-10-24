<?php
$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if (isset($_POST['class_id']) && isset($_POST['division_id'])) {
    $class = $_POST['class_id'];
    $division = $_POST['division_id'];

    $query = "SELECT * FROM student WHERE classId='$class' AND divId='$division'";
    $result = mysqli_query($con, $query);
        echo"    <section class='markhint'><p>** Please Enter <span>-1</span> If Student Is Absent **</p></section>";
        echo '<table border="1">';
        echo '<tr>
        <th>ID</th><th>Student Name</th><th>Marks</th>
        </tr>';

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $full=$row['firstname']." ".$row['lastname'];
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $full . '</td>';
            echo '<td><input type="number" name="marks[' . $row['id'] . ']" required placeholder=" Enter Mark " max=100 min=-1 style="padding: 7px; width:140px;"></td>';
            echo '</tr>';
        }

        echo '</table>';
          echo'<p class="sbtfrm" id="assbtn">';
          echo'<input type="submit" value="Insert Marks" name="insertmrk" />';
        echo'</p>';
    } else {
        echo '<tr>
        <td colspan="3"> No Student Found Is This Class </td>
        </tr>';

        echo '</table>';
    }
}
?>
