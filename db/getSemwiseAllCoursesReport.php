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


?>
<div style="margin: 20px;">
<button id="button_print"  class="btn btn-success" onclick="printDataSummary()" align="center">Print</button>
<script>
  function printDataSummary()
  {
   var divToPrint=document.getElementById("overall_course_feedback_table");
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
<button id="overall_course_export_excel"  class="btn btn-success" align="center">Download as excel file</button>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="../scripts/xlsx.full.min.js"></script>
<script src="../scripts/FileSaver.min.js"></script>
<script type="text/javascript">

var wb = XLSX.utils.table_to_book(document.getElementById("overall_course_feedback_table"),{sheet:"Summary Report"});
var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
function s2ab(s) { 
                var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
                var view = new Uint8Array(buf);  //create uint8array as viewer
                for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
                return buf;    
}
$("#overall_course_export_excel").click(function(){
       saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), '<?php echo $year."_"."$sem"."_Overall_CourseReport"; ?>.xlsx');
});      
//       $( "[id$=sumrep_export_excel]" ).click(function(e) {   
//   window.open('data:application/vnd.ms-excel,' + $('div[id$=summary_report_table]').html());
//   e.preventDefault();
// });
</script>
</div>
<table id="overall_course_feedback_table" class="table table-bordered">
  <thead>
    <tr>  
      <th style="text-align: center;">Course Code</th>
      <th style="text-align: center;">Course Name</th>
      <th style="text-align: center;">Course Type</th>
      <th style="text-align: center;">Mid sem</th>
      <th style="text-align: center;">End sem</th>
      <th style="text-align: center;">Overall Average</th>
    </tr>

    <?php 
    $sql1 = "SELECT DISTINCT c_name , course_code FROM subject where acad_year='$year' and sem='$sem' and dept_id='$dept_id'";
    $res1= $conn->query($sql1);
while($row1=$res1->fetch_assoc()){
	$c_name=$row1['c_name'];
  $course_code=$row1['course_code'];

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

        if($sem=='Both'){
          $m = "SELECT distinct(roll_no) FROM response_midsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";
        }else{
          $m = "SELECT distinct(roll_no) FROM response_midsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";}
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;

        if($sem=='Both'){
          $check = "SELECT response,roll_no FROM response_midsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";
        }else{
          $check = "SELECT response,roll_no FROM response_midsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";}
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
            $e = "SELECT distinct(roll_no) FROM response_endsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";

          }else{
            $e = "SELECT distinct(roll_no) FROM response_endsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";
          }
         $n1 = $conn->query($e); 
         $noOfStudents1=$n1->num_rows;

         if($sem=="Both"){
          $check = "SELECT response,roll_no FROM response_endsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";
         }else{
          $check = "SELECT response,roll_no FROM response_endsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";
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

    ?>

<tr id="swacr">
    
    <td class="ca" id="ccode"><?= $course_code ?></td>
    <td class="ca"  id="cname"><?= $c_name ?></td>
    <td class="ca"  id="ctype"><?= $ct ?></td>
    <td class="ca" id="avgmid"><?php if($avg_mid>0){echo number_format((float)($avg_mid), 2,'.','');}else{ echo '-';} ?></td>
    <td class="ca" id="avgend"><?php if($avg_end>0){echo number_format((float)($avg_end), 2,'.','');}else{ echo '-';} ?></td>
    <td class="ca" id="avg"><?php if($avg_mid==0 && $avg_end>0){echo number_format((float)($avg_end), 2,'.','');}elseif($avg_end==0 && $avg_mid>0){echo number_format((float)($avg_mid), 2,'.','');}elseif($avg_mid+$avg_end==0){echo "-";}else{echo number_format((float)(($avg_end+$avg_mid))/2, 2,'.','');} ?></td>
</tr>

<?php } 

//FOR ELECTIVES
$sqlE = "SELECT electiveID, electiveName FROM electives WHERE acad_year='$year' and sem='$sem' and dept_id='$dept_id'";
$resE= $conn->query($sqlE);
while($rowE=$resE->fetch_assoc()){
  $course_code=$rowE['electiveID'];
  $c_name=$rowE['electiveName'];
  

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

        if($sem=='Both'){
          $m = "SELECT distinct(roll_no) FROM response_midsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";
        }else{
          $m = "SELECT distinct(roll_no) FROM response_midsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";}
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;

        if($sem=='Both'){
          $check = "SELECT response,roll_no FROM response_midsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";
        }else{
          $check = "SELECT response,roll_no FROM response_midsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";}
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
            $e = "SELECT distinct(roll_no) FROM response_endsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";

          }else{
            $e = "SELECT distinct(roll_no) FROM response_endsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";
          }
         $n1 = $conn->query($e); 
         $noOfStudents1=$n1->num_rows;

         if($sem=="Both"){
          $check = "SELECT response,roll_no FROM response_endsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";
         }else{
          $check = "SELECT response,roll_no FROM response_endsem where q_id='$q_id' and course_code='$course_code' and acad_year='$year'";
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
?>

<tr id="swacr">
    
    <td class="ca" id="ccode"><?= $course_code ?></td>
    <td class="ca"  id="cname"><?= $c_name." (Ele/IDC/Au)" ?></td>
    <td class="ca"  id="ctype"><?= $ct ?></td>
    <td class="ca" id="avgmid"><?php if($avg_mid>0){echo number_format((float)($avg_mid), 2,'.','');}else{ echo '-';} ?></td>
    <td class="ca" id="avgend"><?php if($avg_end>0){echo number_format((float)($avg_end), 2,'.','');}else{ echo '-';} ?></td>
    <td class="ca" id="avg"><?php if($avg_mid==0 && $avg_end>0){echo number_format((float)($avg_end), 2,'.','');}elseif($avg_end==0 && $avg_mid>0){echo number_format((float)($avg_mid), 2,'.','');}elseif($avg_mid+$avg_end==0){echo "-";}else{echo number_format((float)(($avg_end+$avg_mid))/2, 2,'.','');} ?></td>
</tr>

<?php } ?>

</thead>

    <tbody>


    </tbody>
</table>

<!-- Print Table -->
<!-- <button id="button_print_swac"  class="btn btn-success" onclick="printDataSummarySWAC()">Print</button>
<script>

  function printDataSummarySWAC()
  {
   var divToPrint=document.getElementById("6");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.document.write("<head><style>@media print{ table{border-collapse: collapse;} table, td, th{ border:1px solid #000; text-align:center;padding-left:20px;padding-right:20px;} </style></head>")
   newWin.print();
   newWin.close();
 }

 $('#button_print_swac').on('click',function(){
  printDataSummary();
});
</script>

Download as Excel
<button id="swac_export_excel"  class="btn btn-success" onclick="swacExport()">Download as excel file</button>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <script type="text/javascript">
        function swacExport() {
            $("#6").table2excel({
                filename: "Overall_Course_feedback.xls"
            });
        }
    </script>
-->
