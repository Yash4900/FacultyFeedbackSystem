<?php 
session_start();
include ('../config/db_config.php');
if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];
}else{
  $dept_id=$_POST['dept_id'];
}

include ('../config/db_config.php');
$year=$_POST['year'];
$sem=$_POST['sem'];

$sql = "SELECT `status`,acad_year,sem_type from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
  $status=$r['status'];
  $acad_year=$r['acad_year'];
  $sem_type=$r['sem_type'];
}
?>

<table id="5" class="table table-bordered">
  <thead>
    <tr>
       
      <!-- <th style="text-align: center;">Course Name</th> -->
      <th style="text-align: center;">Faculty ID</th>
      <th style="text-align: center;">Faculty Name</th>
      <th style="text-align: center;">Course Type</th>
      <th style="text-align: center;">Course Name</th>
      <th style="text-align: center;">Mid Sem Average</th>
      <th style="text-align: center;">End Sem Average</th>
      <th style="text-align: center;">Overall Average</th>
      <!-- <th style="text-align: center;">Add More Faculty</th> -->

    </tr>
<?php

if($sem=="Odd"){
  $sql1 = "SELECT DISTINCT f_id , course_code FROM courses_faculty where acad_year='$year' and sem%2='1' and dept_id='$dept_id' and f_id<>'0'";
}
else{
  $sql1 = "SELECT DISTINCT f_id , course_code FROM courses_faculty where acad_year='$year' and sem%2='0' and dept_id='$dept_id' and f_id<>'0'";
}

$res1= $conn->query($sql1);
while($row1=$res1->fetch_assoc()):
  $f_id=$row1['f_id'];
  $course_code=$row1['course_code'];
  $s = "SELECT fname,lname from faculty where f_id='$f_id'";
  $r= $conn->query($s);
while($res=$r->fetch_assoc()){
  $fname=$res['fname'];
  $lname=$res['lname'];
}
$s3 = "SELECT c_name from subject where course_code='$course_code'";
  $r3= $conn->query($s3);
  while($res3=$r3->fetch_assoc()){
    $cname=$res3['c_name'];
}

if($course_code[0]=='L')
    $c=$course_code[0];
elseif ($course_code[0]=='T' and $course_code[1]=='H') 
    $c='TH';
else
    $c='TU';

$avg_mid=0;
$avg_end=0;
$avg=0;

    $sql = "SELECT q_id,question FROM question where course_type='$c' and acad_year='$year'";
    $result = $conn->query($sql);   
    $noOfQues=$result->num_rows;
    while($row=$result->fetch_assoc()):
      $q_id=$row['q_id'];
      $question=$row["question"];

      $s2 = "SELECT `option` FROM options where course_type='$c' and acad_year='$year' and q_id='$q_id'";
        $res2 = $conn->query($s2);   
        $noOfOptions=$res2->num_rows;
        $options=array();
        $optionName=array();
        while($row2=$res2->fetch_assoc()){
          $options[]=0;
          $optionName[]=$row2["option"];
        }



          $m = "SELECT distinct(roll_no) FROM response_midsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;

          $check = "SELECT response,roll_no FROM response_midsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";
          $res = $conn->query($check);   
          while($response=$res->fetch_assoc()){
            $options[(int)$response["response"]-1]++;

          }

          if($q_id==$noOfQues){


            for($g=0;$g<count($options);$g++){

              $avg_mid=$avg_mid+((int)$optionName[$g]*(int)$options[$g]);
            }
            if($noOfStudents > 0)
              $avg_mid=$avg_mid/$noOfStudents;


          }
        



         $m = "SELECT distinct(roll_no) FROM response_endsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";
         $n = $conn->query($m); 
         $noOfStudents=$n->num_rows;

         $check = "SELECT response,roll_no FROM response_endsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";
         $res = $conn->query($check);   
         while($response=$res->fetch_assoc()){
          $options[(int)$response["response"]-1]++;

        }

        if($q_id==$noOfQues){


          for($g=0;$g<count($options);$g++){

            $avg_end=$avg_end+((int)$optionName[$g]*(int)$options[$g]);
          }
          if($noOfStudents>0)
            $avg_end=$avg_end/$noOfStudents;
        }
      
    endwhile;

?>

<tr id="hdsj">
    
    <td id="f_id"><?= $f_id ?></td>
    <td id="fname"><?= $fname.' '.$lname ?></td>
    <td id="ctype"><?= $c ?></td>
    <td id="cname"><?= $cname ?></td>
    <td id="avgmid"><?php if($avg_mid>0){echo $avg_mid;}else{ echo '-';} ?></td>
    <td id="avgend"><?php if($avg_end>0){echo $avg_end;}else{ echo '-';} ?></td>
    <td id="avg"><?php if($avg_mid==0){echo $avg_end;}elseif($avg_end==0){echo $avg_mid;}elseif($avg_mid*$avg_end==0){echo "-";}else{echo ($avg_mid+$avg_end)/2;} ?></td>
</tr>

<?php 
     endwhile;
 ?>
    </thead>

    <tbody>


    </tbody>
  </table>
  <button id="button_print"  class="btn btn-success" onclick="printDataSummary()">Print</button>
<script>
  function printDataSummary()
  {
   var divToPrint=document.getElementById("5");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.document.write("<head><style>@media print{ table{border-collapse: collapse;} table, td, th{ border:1px solid #000; text-align:center;} </style></head>")
   newWin.print();
   newWin.close();
 }

 $('#button_print').on('click',function(){
  printDataSummary();
});


</script>