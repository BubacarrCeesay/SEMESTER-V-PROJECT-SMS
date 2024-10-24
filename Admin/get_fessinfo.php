<?php
$con=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if (!$con) {
    die("Connection Failed");
}

if (isset($_POST['class_id'])) {
    $class = $_POST['class_id'];

    $query = "select * from fees where classId = '$class'";

    $result = mysqli_query($con, $query);

    $output="";

    if(mysqli_num_rows($result)>0){

        while($val=mysqli_fetch_array($result)){

            $amount=$val['amount'];

                    $qtn="select * from class where id=$class";
                        $rtn=mysqli_query($con,$qtn);


                        if(mysqli_num_rows($rtn) > 0){
                            $ron= mysqli_fetch_array($rtn);
                            $clsname=$ron['name'];
                        }  


                    $output.="
                        <tr>
                        <td>$clsname</td>
                        <td>$$amount</td>
                        </tr>
                    ";
        }
    }

            else{

                    $output.="
                            <tr>
                            <td colspan='2'>Class Fees Not Added!</td>
                            </tr>
                        ";  

            }

    echo"$output";
}
?>

