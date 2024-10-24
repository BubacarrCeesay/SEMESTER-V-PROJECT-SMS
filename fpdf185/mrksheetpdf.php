<?php
require('fpdf.php');


$conn=mysqli_connect("sql103.infinityfree.com","if0_37580551","dReVORGIWnutzG","if0_37580551_sms");
if(!$conn)
{
    die("Connection Failed");
}


if (isset($_GET['viewid']) && isset($_GET['exmid'])) {
    $student_id = $_GET['viewid'];
    $exam_id=$_GET['exmid'];

            $qd="select * from exam where id=$exam_id";
            $rcl=mysqli_query($conn,$qd);


            if((mysqli_num_rows($rcl) > 0)){
                $rco= mysqli_fetch_array($rcl);
                $exname=strtoupper($rco['name']);
                
            }

    $sql = "SELECT * FROM student WHERE id = '$student_id'";
    
    $r=mysqli_query($conn,$sql);

    if(mysqli_num_rows($r)==1){
        while($rs= mysqli_fetch_array($r)){

            $prf=$rs['profile'];
             $roll=$rs['rollno'];
             $cl=$rs['classId'];
              $di=$rs['divId'];
            $fullname=$rs['firstname']." ".$rs['lastname'];

            $qy="select * from class where id=$cl";
            $rcl=mysqli_query($conn,$qy);

            $qd="select * from division where id=$di and classId=$cl";
            $rd=mysqli_query($conn,$qd);


            if((mysqli_num_rows($rcl) > 0) && (mysqli_num_rows($rd) >0)){
                $rco= mysqli_fetch_array($rcl);
                $rdo= mysqli_fetch_array($rd);
                $dn=$rdo['div_name'];
                $cn=$rco['name'];
            }

        }
    }

        $pdf = new FPDF();
        $pdf->AddPage();
        
        $pdf->SetFont('Arial', 'B', 20);

        $pdf->SetLineWidth(1);
        $pdf->Rect(5, 5, 200, 287, 'D');
        $pdf->Image('logo.png', 10, 10, 30);

        $pdf->Cell(80);
        $pdf->setTextColor(32,16,236);
        $pdf->Cell(30, 15, 'BOBZE SECONDARY SCHOOL', 0, 1, 'C');

        $pdf->Image('logo.png', 168, 10, 30);

        $pdf->Ln(7);

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(80);
        $pdf->setTextColor(32,16,236);
        $pdf->Cell(30, 15, "MARSHEET FOR ".$exname." EXAM", 0, 1, 'C');

        $pdf->Ln(20);

        $pdf->Cell(30);
        $pdf->SetFont('Courier', 'B', 13);
        $pdf->setTextColor(0,0,0);

        $pdf->Cell(8, 10, "ID : ".$student_id, 0, 1, 'R');

        $pdf->Cell(30);
        $pdf->Cell(30, 10, "NAME : ".strtoupper($fullname), 0, 1, 'R');

        try {
            $pdf->Image("../Student/files/".$prf, 150, 50, 50);
        } catch (Exception $e) {
            echo "<script>alert('Error In Generating PDF :>: \\nStudent\'s Profile Picture Should Be A JPEG Or PNG File In Order To Display Marksheet');</script>";
            echo "<script>
            window.close();
            </script>";        
            exit();
        }

        $pdf->Cell(30);
        $pdf->Cell(43, 10, "CLASS : ".strtoupper($cn), 0, 1, 'R');

        $pdf->Cell(30);
        $pdf->Cell(16, 10, "DIVISION : ".strtoupper($dn), 0, 1, 'R');

        $pdf->Cell(30);
        $pdf->Cell(16, 10, "ROLL NO. : ".strtoupper($roll), 0, 1, 'R');

      $pdf->Ln(20);
        $pdf->SetFont('Times', 'B', 13);
  
        $pdf->Cell(60, 10, "SUBJECT",0,0, 'C');
        $pdf->Cell(60, 10, "MARK", 0, 0, 'C');
        $pdf->Cell(60, 10, "GRADE", 0, 1, 'C');

        $pdf->Ln(3);

        $qry="select * from result where studentId=$student_id and examId=$exam_id";

        $fqy=mysqli_query($conn,$qry);

        $totalm=0;
        $n=0;

        $pdf->SetFont('Courier', 'B', 13);

        if(mysqli_num_rows($fqy)>0){
            while($row=mysqli_fetch_array($fqy)){
                $mrk=intval($row['mark']);
                $subid=$row['subjectId'];

                    $qs = "select * from subject where id=$subid";

                    $rs = mysqli_query($conn, $qs);

                    while ($fr = mysqli_fetch_assoc($rs)) {
                        $sname=$fr['name'];
                    }
                $totalm=$totalm+$mrk;
                $n=$n+1;

                if($mrk >=80){
                    $grd="A";
                }
                else if($mrk <80 && $mrk>=70){
                    $grd="B";
                }

                else if($mrk <70 && $mrk>=60){
                    $grd="C";
                }

                else if($mrk <60 && $mrk>=50){
                    $grd="D";
                }

                else if($mrk <50 && $mrk>=40){
                    $grd="E";
                }
                else{
                    $grd="F";
                }

                $pdf->Cell(60, 10, "".$sname, 0, 0, 'C');
                $pdf->Cell(60, 10, "".$mrk, 0, 0, 'C');
                $pdf->Cell(60, 10, "".$grd, 0, 1, 'C');
                $pdf->Ln(3);


            }
        }

        $pdf->SetFont('Arial', 'B', 14);

        $pdf->Ln(20);

        $pdf->Cell(160, 10, "TOTAL MARKS : ".$totalm, 0, 1, 'R');

        $perc=$totalm/$n;

        $pdf->Cell(160, 10, "PERCENTAGE : ".$perc." %", 0, 1, 'R');



        $pdf->Output();

} else {
    echo "No student ID provided!";
}
?>
