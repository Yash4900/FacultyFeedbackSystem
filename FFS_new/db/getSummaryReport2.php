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

$cs;$el;$tot;
?>

<!-- Print Table -->
<div id="7_">
<div style="margin: 20px;">
<button id="button_print"  class="btn btn-success" onclick="printDataSummary()" align="center">Print</button>
<script>
  function printDataSummary()
  {
   var divToPrint=document.getElementById("7");
   if(divToPrint.style.display!="none"){
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.document.write("<head><style>@media print{ table{border-collapse: collapse;} table, .ca, th{ border:1px solid #000; text-align:center;} .la{ border:1px solid #000; text-align:left;}</style></head>")
   newWin.print();
   newWin.close();
   }else{
   	alert("Table is empty");
   }
 }

 $('#button_print').on('click',function(){
  printDataSummary();
});
</script>

<!-- Download as Exccel -->
<button id="sumrep_export_excel"  class="btn btn-success" align="center">Download as excel file</button>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="../scripts/xlsx.full.min.js"></script>
<script src="../scripts/FileSaver.min.js"></script>
<script type="text/javascript">

var wb = XLSX.utils.table_to_book(document.getElementById("7"),{sheet:"Summary Report"});
var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
function s2ab(s) { 
                var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
                var view = new Uint8Array(buf);  //create uint8array as viewer
                for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
                return buf;    
}
$("#sumrep_export_excel").click(function(){
       saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), '<?php echo $year."_"."$sem"."_Sem_SummaryReport"; ?>.xlsx');
});      
//       $( "[id$=sumrep_export_excel]" ).click(function(e) {   
//   window.open('data:application/vnd.ms-excel,' + $('div[id$=summary_report_table]').html());
//   e.preventDefault();
// });
</script>
</div>
<div id="summary_report_table">
<table id="7" class="table table-bordered">
  <thead>
      <tr>
       
      <!-- <th style="text-align: center;">Course Name</th> -->
      <th style="text-align: center;">Faculty ID</th>
      <th style="text-align: center;">Faculty Name</th>
      <th style="text-align: center;">Course Type</th>
      <th style="text-align: center;">Course Name</th>
      <th style="text-align: center;">Class</th>
      <?php if($sem=="Both"){ ?>
      <th style="text-align: center;">Sem</th>  
      <?php } ?>
      <th style="text-align: center;">Div/Batch</th>
      <th style="text-align: center;">Mid Sem</th>
      <th style="text-align: center;">End Sem</th>
      <th style="text-align: center;">Average</th>
      <!-- <th style="text-align: center;">Add More Faculty</th> -->

    </tr>

    
<?php

// fetching all faculty name
$sql1 = "SELECT f_id, fname, lname FROM faculty WHERE (dept_id='$dept_id' OR dept_id='6') and f_id<>'0'";
$res1= $conn->query($sql1);
while($row1=$res1->fetch_assoc()){
	$f_id=$row1['f_id'];
	$fname=$row1['fname'];
	$lname=$row1['lname'];

// fetching course details that faculty teaches
	if($sem=="Odd"){
   $sql2 = "SELECT course_code, class, section_or_batch, sem FROM courses_faculty WHERE f_id='$f_id' and sem%2='1' and acad_year='$year' AND dept_id='$dept_id'";
}elseif($sem=="Even"){
   $sql2 = "SELECT course_code, class, section_or_batch, sem FROM courses_faculty WHERE f_id='$f_id' and sem%2='0' and acad_year='$year' AND dept_id='$dept_id'";
}elseif($sem=="Both"){
	$sql2 = "SELECT course_code, class, section_or_batch, sem FROM courses_faculty WHERE f_id='$f_id' and acad_year='$year' AND dept_id='$dept_id' and (sem%2='0' OR sem%2='1')";
}
	
	$res2= $conn->query($sql2);


// fetching elective details that faculty teaches
if($sem=="Odd"){
   $sql6 = "SELECT electiveID, electiveName, sem FROM electives WHERE f_id='$f_id' and sem%2='1' and acad_year='$year' and dept_id='$dept_id'";
}elseif($sem=="Even"){
   $sql6 = "SELECT electiveID, electiveName, sem FROM electives WHERE f_id='$f_id' and sem%2='0' and acad_year='$year' and dept_id='$dept_id'";
}elseif($sem=="Both"){
	$sql6 = "SELECT electiveID, electiveName, sem FROM electives WHERE f_id='$f_id' and acad_year='$year' and dept_id='$dept_id' and (sem%2='0' OR sem%2='1')";
}
$res2= $conn->query($sql2);
$res6= $conn->query($sql6);


	$cs = $res2->num_rows;
	$el = $res6->num_rows;
	$tot = $cs+$el; //total number of courses + electives that faculty teaches
	if($tot>0){
	?>
  <!-- faculty id and name rowspan -->
		<tr id="hdsj">
			<td class="ca" id="f_id"  rowspan="<?php echo $tot; ?>"><?= $f_id ?></td>
		  <td class="la" id="fname" rowspan="<?php echo $tot; ?>"><?= $fname.' '.$lname ?></td>
	<?php
	}

  // running the query and fetching one by one all courses details
	while($row2=$res2->fetch_assoc()){
		$course_code = $row2['course_code'];
		$class = $row2['class'];
		$section_or_batch = $row2['section_or_batch'];
    $s = $row2['sem'];

		$s3 = "SELECT c_name from subject where course_code='$course_code'";
		$r3= $conn->query($s3);
	while($res3=$r3->fetch_assoc()){
	  $cname=$res3['c_name'];
	}

	if($course_code[0]=='L'){
    $c=$course_code[0];
    $ct = 'Lab';
  }
  elseif ($course_code[0]=='T'){
    $c='TH';
    if($course_code[1]=='H'){
      $ct = 'Theory';
    }else{
      $ct = 'Tutorial';
    }
  } 

  // calculating score
	$pre = 2;
	$avg_mid=0;
	$avg_end=0;
	$avg=0;

    $sql = "SELECT q_id, question FROM question where course_type='$c' and acad_year='$year'";
    $result = $conn->query($sql);   
    $noOfQues=$result->num_rows;
    while($row=$result->fetch_assoc()):
      $q_id=$row['q_id'];
      $question=$row["question"];

      $s2 = "SELECT `option` FROM options where course_type='$c' and acad_year='$year' and q_id='$q_id'";
        $re2 = $conn->query($s2);   
        $noOfOptions=$re2->num_rows;
        $options=array();
        $options2=array();
        $optionName=array();
        while($r2=$re2->fetch_assoc()){
          $options[]=0;
          $options2[]=0;
          $optionName[]=$r2["option"];
        }

// $rno = array();
// $rolls = "SELECT roll_no FROM student WHERE class='$class' AND (batch='$section_or_batch' OR section='$section_or_batch')";
// $result = $conn->query($rolls); 
// while($roll=$result->fetch_assoc()){
//   $rno[] = $roll["roll_no"];

        if($sem=='Both'){
        	$m = "SELECT distinct(roll_no) FROM response_midsem where roll_no IN (SELECT roll_no FROM student WHERE class='$class' and (batch='$section_or_batch' OR section='$section_or_batch')) AND q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and (sem_type='Odd' OR sem_type='Even')";
        }else{
          $m = "SELECT distinct(roll_no) FROM response_midsem where roll_no IN (SELECT roll_no FROM student WHERE class='$class' and (batch='$section_or_batch' OR section='$section_or_batch')) AND q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";}
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;

        if($sem=='Both'){
        	$check = "SELECT response,roll_no FROM response_midsem where roll_no IN (SELECT roll_no FROM student WHERE class='$class' and (batch='$section_or_batch' OR section='$section_or_batch')) AND q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and (sem_type='Odd' OR sem_type='Even')";
        }else{
          $check = "SELECT response,roll_no FROM response_midsem where roll_no IN (SELECT roll_no FROM student WHERE class='$class' and (batch='$section_or_batch' OR section='$section_or_batch')) AND q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";}
          $res = $conn->query($check);   
          while($response=$res->fetch_assoc()){
            $options[(int)$response["response"]-1]++;

          }

          if($q_id==$noOfQues){
            for($g=0;$g<count($options);$g++){
              $avg_mid=$avg_mid+((int)$optionName[$g]*(int)$options[$g]);
            }
            if($noOfStudents > 0)

            {
              $avg_mid=$avg_mid/$noOfStudents;
            }
          }
        

          if($sem=="Both"){
          	$e = "SELECT distinct(roll_no) FROM response_endsem where roll_no IN (SELECT roll_no FROM student WHERE class='$class' and (batch='$section_or_batch' OR section='$section_or_batch')) AND q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and (sem_type='Odd' OR sem_type='Even')";

          }else{
          	$e = "SELECT distinct(roll_no) FROM response_endsem where roll_no IN (SELECT roll_no FROM student WHERE class='$class' and (batch='$section_or_batch' OR section='$section_or_batch')) AND q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";
          }
         $n1 = $conn->query($e); 
         $noOfStudents1=$n1->num_rows;

         if($sem=="Both"){
         	$check = "SELECT response,roll_no FROM response_endsem where roll_no IN (SELECT roll_no FROM student WHERE class='$class' and (batch='$section_or_batch' OR section='$section_or_batch')) AND q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and (sem_type='Odd' OR sem_type='Even')";
         }else{
         	$check = "SELECT response,roll_no FROM response_endsem where roll_no IN (SELECT roll_no FROM student WHERE class='$class' and (batch='$section_or_batch' OR section='$section_or_batch')) AND q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";
         }
         $res = $conn->query($check);   
         while($response=$res->fetch_assoc()){
          $options2[(int)$response["response"]-1]++;

        }

        if($q_id==$noOfQues){


          for($g=0;$g<count($options);$g++){

            $avg_end=$avg_end+((int)$optionName[$g]*(int)$options2[$g]);
          }
        }
          if($noOfStudents1>0){
            $avg_end=$avg_end/$noOfStudents1;
        }
        endwhile;
    if($noOfStudents1+$noOfStudents>0){
    $avg=($avg_mid+$avg_end)/2;
  }
  if($cs>0){
?>
  <!-- printing details -->
    <td class="la" id="ctype"><?php echo $ct; ?></td>
    <td class="la" id="cname"><?= $cname ?></td>
    <td class="la" id="class"><?= $class ?></td>
    <?php if($sem=="Both"){ ?>
    <td class="la" id="semType"><?php if($s%2==1){echo "Odd";}else{echo "Even";} ?></td> 
    <?php } ?>
    <td class="la" id="div_batch"><?= $section_or_batch ?></td>
    <td class="ca" id="avgmid"><?php if($avg_mid>0){echo number_format((float)($avg_mid), 2,'.','');}else{ echo '-';} ?></td>
    <td class="ca" id="avgend"><?php if($avg_end>0){echo number_format((float)($avg_end), 2,'.','');}else{ echo '-';} ?></td>
    <td class="ca" id="avg"><?php if($avg_mid==0 && $avg_end>0){echo number_format((float)($avg_end), 2,'.','');}elseif($avg_end==0 && $avg_mid>0){echo number_format((float)($avg_mid), 2,'.','');}elseif($avg_mid+$avg_end==0){echo "-";}else{echo number_format((float)(($avg_end+$avg_mid))/2, 2,'.','');} ?></td>
    </tr>

<?php
		}
	}

	
// THE ABOVE PROCEDURE FOR ELECTIVES

while($row6=$res6->fetch_assoc()){
	$cname = $row6['electiveName'];
	$course_code = $row6['electiveID'];
	$s = $row6['sem'];
	if($course_code[0]=='L'){
		$c=$course_code[0];
    $ct = 'Lab';
    $section_or_batch = $course_code[strlen($course_code)-1];
	}
	elseif ($course_code[0]=='T'){
		$c='TH';
    if($course_code[1]=='H'){
      $ct = 'Theory';
      $section_or_batch = '-';
    }else{
      $ct = 'Tutorial';
      $section_or_batch = $course_code[strlen($course_code)-1];
    }
	}	

  //finding out class using semester
  if($dept_id==6){
    $class='FY';
  }else{
    if($s==1 || $s==2){
      $class='MTech';
    }else if($s==3 || $s==4){
      $class='SY';
    }else if($s==5 || $s==6){
      $class='TY';
    }else{
      $class='LY';
    }
  }
  
  //calculating score
	$pre = 2;
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
        $re2 = $conn->query($s2);   
        $noOfOptions=$re2->num_rows;
        $options=array();
        $options2=array();
        $optionName=array();
        while($r2=$re2->fetch_assoc()){
          $options[]=0;
          $options2[]=0;
          $optionName[]=$r2["option"];
        }


        if($sem=='Both'){
        	$m = "SELECT distinct(roll_no) FROM response_midsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and (sem_type='Odd' OR sem_type='Even')";
        }else{
          $m = "SELECT distinct(roll_no) FROM response_midsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";}
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;

        if($sem=='Both'){
        	$check = "SELECT response,roll_no FROM response_midsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and (sem_type='Odd' OR sem_type='Even')";
        }else{
          $check = "SELECT response,roll_no FROM response_midsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";}
          $res = $conn->query($check);   
          while($response=$res->fetch_assoc()){
            $options[(int)$response["response"]-1]++;

          }

          if($q_id==$noOfQues){


            for($g=0;$g<count($options);$g++){

              $avg_mid=$avg_mid+((int)$optionName[$g]*(int)$options[$g]);
            }
            if($noOfStudents > 0)

            {
              $avg_mid=$avg_mid/$noOfStudents;
            }
          }
        

          if($sem=="Both"){
          	$e = "SELECT distinct(roll_no) FROM response_endsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and (sem_type='Odd' OR sem_type='Even')";

          }else{
          	$e = "SELECT distinct(roll_no) FROM response_endsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";
          }
         $n1 = $conn->query($e); 
         $noOfStudents1=$n1->num_rows;

         if($sem=="Both"){
         	$check = "SELECT response,roll_no FROM response_endsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and (sem_type='Odd' OR sem_type='Even')";
         }else{
         	$check = "SELECT response,roll_no FROM response_endsem where q_id='$q_id' and course_code='$course_code' and f_id='$f_id' and acad_year='$year' and sem_type='$sem'";
         }
         $res = $conn->query($check);   
         while($response=$res->fetch_assoc()){
          $options2[(int)$response["response"]-1]++;

        }

        if($q_id==$noOfQues){


          for($g=0;$g<count($options);$g++){

            $avg_end=$avg_end+((int)$optionName[$g]*(int)$options2[$g]);
          }
        }
          if($noOfStudents1>0){
            $avg_end=$avg_end/$noOfStudents1;
        }
        endwhile;
    if($noOfStudents1+$noOfStudents>0){
    $avg=($avg_mid+$avg_end)/2;
  }
  if($el>0){
?>
    <!-- printing details -->
    <td class="la" id="ctype"><?php echo $ct; ?></td>
    <td class="la" id="cname"><?= $cname." "."(Ele/IDC/Au)" ?></td>
    <td class="la" id="class"><?= $class ?></td>
    <?php if($sem=="Both"){ ?>
    <td class="la" id="semType"><?php if($s%2==1){echo "Odd";}else{echo "Even";} ?></td> 
    <?php } ?>
    <td class="la" id="div_batch"><?= $section_or_batch ?></td>
    <td class="ca" id="avgmid"><?php if($avg_mid>0){echo number_format((float)($avg_mid), 2,'.','');}else{ echo '-';} ?></td>
    <td class="ca" id="avgend"><?php if($avg_end>0){echo number_format((float)($avg_end), 2,'.','');}else{ echo '-';} ?></td>
    <td class="ca" id="avg"><?php if($avg_mid==0 && $avg_end>0){echo number_format((float)($avg_end), 2,'.','');}elseif($avg_end==0 && $avg_mid>0){echo number_format((float)($avg_mid), 2,'.','');}elseif($avg_mid+$avg_end==0){echo "-";}else{echo number_format((float)(($avg_end+$avg_mid))/2, 2,'.','');} ?></td>
    </tr>
<?php
	}
}
}
?>

</thead>
<tbody>
</tbody>
</table>
</div>
</div>