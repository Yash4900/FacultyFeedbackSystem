<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<hr>

<?php
session_start();
include ('../config/db_config.php');
if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];
}else{
  $dept_id=$_POST['dept_id'];
}

$sql = "SELECT dept_name from department where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
  $dept_name = $r['dept_name'];
  if($dept_name == "COMPS")
    $dept_name = "Computer Engineering";
  if($dept_name == "IT")
    $dept_name = "Information Technology";
  if($dept_name == "ETRX")
    $dept_name = "Electronics Engineering";
  if($dept_name == "EXTC")
    $dept_name = "Electronics and Telecommunication Engineering";
  if($dept_name == "MECH")
    $dept_name = "Mechanical Engineering";
  if($dept_name == "S&H")
    $dept_name = "Science and Humanities";
}?>

<p style="text-align: center; color: black; text-align: center; font-size: 24px;  "><strong>K.J. SOMAIYA COLLEGE OF ENGINEERING, MUMBAI</strong></p>
<p style="text-align: center; color: black; text-align: center; font-size: 18px; "><strong>(A Constituent College of Somaiya Vidyavihar University)</strong></p>
<hr>
<p style="text-align: center; color: black; text-align: center; font-size: 18px; "><strong>Department of <?php echo $dept_name; ?></strong></p>
<hr>
<?php
$f_id; $cname; $c_id; $fname; $lname;                
$f_id=$_POST["f_id"];


$sql = "SELECT `status`,acad_year,sem_type from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
  $status=(int)$r['status'];
  $acad_year=$r['acad_year'];
  $sem_type=$r['sem_type'];
}



echo '<p style="text-align: center; font-size: 24px;"><strong>FACULTY FEEDBACK REPORT ('.$acad_year.')</strong></p>';
if($sem_type=="Odd"){
  if($status==0)
    echo '<p style="text-align: center; font-size: 20px;"><strong>Odd Semester (Mid Term) </strong></p>';
  else
    echo '<p style="text-align: center; font-size: 18px;"><strong>Odd Semester (End Term) </strong></p>';
}else{
  if($status==0)
    echo '<p style="text-align: center; font-size: 20px;"><strong>Even Semester (Mid Term) </strong></p>';
  else
    echo '<p style="text-align: center; font-size: 18px;"><strong>Even Semester (End Term) </strong></p>';
}
echo "<hr>";

$s = "SELECT fname,lname from faculty where f_id='$f_id'";
$r= $conn->query($s);
while($res=$r->fetch_assoc()){
  $fname=$res['fname'];
  $lname=$res['lname'];
  echo "<b style='font-size: 18px;'>Faculty Name: </b><strong style='color:#162252; font-size: 16px; '>".$fname." ".$lname."</strong><br><hr><br>";

}

if($sem_type=='Odd')
  $s2 = "SELECT course_code,class,sem,section_or_batch from courses_faculty where f_id='$f_id' and sem in (1,3,5,7) and acad_year='$acad_year' and dept_id='$dept_id'";
else
  $s2 = "SELECT course_code,class,sem,section_or_batch from courses_faculty where f_id='$f_id' and sem in (2,4,6,8) and acad_year='$acad_year' and dept_id='$dept_id'";
$r2= $conn->query($s2);

while($res2=$r2->fetch_assoc()):
  $c_id=$res2['course_code'];
  $class=$res2["class"];
  $sem=$res2["sem"];
  $section_or_batch=$res2["section_or_batch"];
  $a="SELECT roll_no from student where class='$class' and sem='$sem' and (batch='$section_or_batch' or section='$section_or_batch')  and acad_year='$acad_year'";
  $b=$conn->query($a);

  $roll_no=array();
  while($s=$b->fetch_assoc()){
    $roll_no[]=$s["roll_no"];
  }
  ?>

  <?php
  $s3 = "SELECT c_name from subject where course_code='$c_id'";
  $r3= $conn->query($s3);
  while($res3=$r3->fetch_assoc()){
    $cname=$res3['c_name'];
    echo "<b style='font-size: 18px;'>Course Name: </b><strong style='color:#162252;font-size: 16px;'>".$cname."</strong>&nbsp;&nbsp;&nbsp;&nbsp;";
  }
  if($c_id[0]=='L')
    $c=$c_id[0];
  elseif ($c_id[0]=='T') 
    $c="TH";
  
  echo "<b style='font-size: 18px;'>Class: </b><strong style='color:#162252;font-size: 16px;'>".$class."</strong>&nbsp;&nbsp;&nbsp;&nbsp;";
  echo "<b style='font-size: 18px;'>Sem: </b><strong style='color:#162252;font-size: 16px;'>".$sem."</strong>&nbsp;&nbsp;&nbsp;&nbsp;";
  echo "<b style='font-size: 18px;'>Section/ Batch: </b><strong style='color:#162252;font-size: 16px;'>".$section_or_batch."</strong><br><hr>&nbsp;&nbsp;&nbsp;&nbsp;";
  $avg=0;
  ?>
  <table style="border-radius: 5px;"><tr>
    <?php
    $sql = "SELECT q_id,question FROM question where course_type='$c' and acad_year='$acad_year'";
    $result = $conn->query($sql);   
    $noOfQues=$result->num_rows;
    while($row=$result->fetch_assoc()):
      $q_id=$row['q_id'];
      $question=$row["question"];

      ?>


      <!-- <div class="container" style="float: left; width: 40%; height: 350px;">-->


        <?php
        $s2 = "SELECT `option` FROM options where course_type='$c' and acad_year='$acad_year' and q_id='$q_id'";
        $res2 = $conn->query($s2);   
        $noOfOptions=$res2->num_rows;
        $options=array();
        $optionName=array();
        while($row2=$res2->fetch_assoc()){
          $options[]=0;
          $optionName[]=$row2["option"];
        }
        if($status==0){
          $m = "SELECT distinct(roll_no) FROM response_midsem where q_id='$q_id' and course_code='$c_id' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
          
          $check = "SELECT response,roll_no FROM response_midsem where q_id='$q_id' and course_code='$c_id' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
          $res = $conn->query($check);   
          while($response=$res->fetch_assoc()){
            $options[(int)$response["response"]-1]++;

          }

          if($q_id==$noOfQues){


            for($g=0;$g<count($options);$g++){

              $avg=$avg+((int)$optionName[$g]*(int)$options[$g]);
            }
            $avg=$avg/$noOfStudents;


          }
        }
        else{
         $m = "SELECT distinct(roll_no) FROM response_endsem where q_id='$q_id' and course_code='$c_id' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
         $n = $conn->query($m); 
         $noOfStudents=$n->num_rows;

         $check = "SELECT response,roll_no FROM response_endsem where q_id='$q_id' and course_code='$c_id' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
         $res = $conn->query($check);   
         while($response=$res->fetch_assoc()){
          $options[(int)$response["response"]-1]++;

        }

        if($q_id==$noOfQues){


          for($g=0;$g<count($options);$g++){

            $avg=$avg+((int)$optionName[$g]*(int)$options[$g]);
          }
          $avg=$avg/$noOfStudents;


        }
      }

      ?>



      <td style="width: 50%; text-align: center; border:0.5px solid #162252 ;padding: 5px; background-color: #f5f5f5 ">
        <?php echo "<br><b>".$question."</b><br>"; ?>
        <canvas id='<?php echo $c.$cname. $section_or_batch.$q_id ?>' width="50%" height="180" ></canvas> 
      </td>
      <script>
        var my_canvas=document.getElementById(<?php echo json_encode($c.$cname. $section_or_batch.$q_id)?>);
        var gctx=my_canvas.getContext("2d");

        var noOfOptions=<?php echo json_encode($noOfOptions)?>;
        var options=<?php echo json_encode($options)?>;
        var optionName=<?php echo json_encode($optionName)?>;
        var noOfStudents=<?php echo json_encode($noOfStudents)?>;
        var q_id=<?php echo json_encode($q_id)?>;
        var noOfQues=<?php echo json_encode($noOfQues)?>;
        var data=[];
        for(var m=0;m<noOfOptions;m++){
          data[m]=[optionName[m],(options[m]/noOfStudents)*100];
         

        }
       
     

        if(q_id%2==0){
          my_canvas.style.styleFloat="clear";
        }



        var bar_width=30;
var y_gap=30;  // Gap below the graph 
var bar_gap=100; // Gap between Bars including width of the bar
var x= 15; // Margin of graph from left  

y=my_canvas.height -y_gap ;
if(q_id==noOfQues){
  bar_gap=50;
  my_canvas.width=data.length * (  bar_gap)  + x;
}
my_canvas.width=data.length * (  bar_gap)  + x +22;
////////////end of settings ////
gctx.moveTo(x-5,y);
gctx.lineTo(my_canvas.width,y); // Base line of graph 
gctx.stroke();
/// add shadow ///
gctx.shadowColor = '#000000';
gctx.shadowOffsetX=3;
gctx.shadowOffsetY=3;
gctx.shadowBlur = 3;
/////////// Draw the graph ////////

for (i=0;i<data.length;i++){
gctx.shadowColor = '#ffffff'; // remove this line if you shadow on text is required
gctx.font = '15px serif'; // font for base label showing classes 
gctx.textAlign='left';
gctx.textBaseline='top';
gctx.fillStyle= '#162252';
gctx.fillText(data[i][0], x,y+5); // Write base text for classes 

gctx.beginPath();
gctx.lineWidth=2;
y1=y-data[i][1]; // Coordinate for top of the Bar 
x1 = x;    
gctx.font = '12px serif'; // font at top of the bar 
gctx.fillStyle= '#000000';
gctx.fillText(data[i][1].toFixed(1)+"%", x1,y1-20); // text at top of the bar 

gctx.fillStyle= '#2E5090'; // fill Colur of bar  
gctx.shadowColor = '#000000'; // shadow color for bars 
gctx.fillRect(x1,y1,bar_width,data[i][1]);// Filled bar 

x=x+bar_gap

}// end of for loop 

</script>
<?php 
if($q_id==$noOfQues-1){
	echo "</tr></table><table><tr>";
}
else if($q_id%2==0)
{
  echo "</tr><tr>";
}

?>


<?php endwhile;?>
</tr></table>

<?php
echo "<br><p style=' text-align:center;'><b style='font-size: 18px;'>Faculty Evaluation: </b><strong style='color:#162252; font-size: 20px; '>".number_format((float)$avg, 2, '.', '')."</strong></p><br>";


if($status==0){
 $check = "SELECT comment FROM comment_midsem where course_code='$c_id' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
 $res = $conn->query($check);
 echo "<b>Suggestions/ Comments<b><br>";   
while($comment=$res->fetch_assoc()){
    if($comment["comment"]=="" or $comment["comment"] ==" " or $comment["comment"]=="NA" or $comment["comment"]=="na" or $comment["comment"] == "none")
      continue;
    echo "<b>- ".$comment["comment"]."</b><br>";
    
  }
}else{
   $check = "SELECT comment FROM comment_endsem where course_code='$c_id' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
 $res = $conn->query($check);
 echo "<b>Suggestions/ Comments<b><br>";   
while($comment=$res->fetch_assoc()){
    if($comment["comment"]=="" or $comment["comment"] ==" " or $comment["comment"]=="NA" or $comment["comment"]=="na" or $comment["comment"] == "none")
      continue;
    echo "<b>- ".$comment["comment"]."</b><br>";
    
  }
}
echo "<hr><br>";
endwhile;
?>


<!--Electives Report-->
<?php
if($sem_type=='Odd')
  $s2 = "SELECT electiveID,electiveName,sem from electives where f_id='$f_id' and sem%2=1 and acad_year='$acad_year'";
else
  $s2 = "SELECT electiveID,electiveName,sem from electives where f_id='$f_id' and sem%2=0 and acad_year='$acad_year'";
$r2= $conn->query($s2);
while($res2=$r2->fetch_assoc()):
  $electiveID=$res2['electiveID'];

  $sem=$res2["sem"];
  $electiveName=$res2["electiveName"];
  $a="SELECT roll_no from student where sem='$sem' and (elective_or_IDC_ID='$electiveID' or elective_or_IDC_BatchID='$electiveID' or elective_or_IDC_ID1='$electiveID' or elective_or_IDC_ID2='$electiveID' or elective_or_IDC_ID3='$electiveID' or elective_or_IDC_ID4='$electiveID' or elective_or_IDC_ID5='$electiveID' or elective_or_IDC_BatchID1='$electiveID'or elective_or_IDC_BatchID2='$electiveID' or elective_or_IDC_BatchID3='$electiveID' or elective_or_IDC_BatchID4='$electiveID' or elective_or_IDC_BatchID5='$electiveID' )  and acad_year='$acad_year'";
  $b=$conn->query($a);

  $roll_no=array();
  while($s=$b->fetch_assoc()){
    $roll_no[]=$s["roll_no"];
  }
  ?>

  <?php

  echo "<b style='font-size: 18px;'>Course Name: </b><strong style='color:#162252;font-size: 16px;'>".$electiveName."</strong>&nbsp;&nbsp;&nbsp;&nbsp;";
  
  if($electiveID[0]=='L')
    $c=$electiveID[0];
  elseif ($electiveID[0]=='T') 
    $c='TH';
  

  if($sem==1 or $sem==2)
    echo "<b style='font-size: 18px;'>Class: </b><strong style='color:#162252;font-size: 16px;'>Mtech</strong>&nbsp;&nbsp;&nbsp;&nbsp;";
    else if($sem==3 or $sem==4)
    echo "<b style='font-size: 18px;'>Class: </b><strong style='color:#162252;font-size: 16px;'>SY</strong>&nbsp;&nbsp;&nbsp;&nbsp;";
    else if($sem==5 or $sem==6)
   echo "<b style='font-size: 18px;'>Class: </b><strong style='color:#162252;font-size: 16px;'>TY</strong>&nbsp;&nbsp;&nbsp;&nbsp;";
else if($sem==7 or $sem==8)
   echo "<b style='font-size: 18px;'>Class: </b><strong style='color:#162252;font-size: 16px;'>LY</strong>&nbsp;&nbsp;&nbsp;&nbsp;";

 echo "<b style='font-size: 18px;'>Sem: </b><strong style='color:#162252;font-size: 16px;'>".$sem."</strong>&nbsp;&nbsp;&nbsp;&nbsp;";

 $avg=0;
 ?>
 <table style="border-radius: 5px;"><tr>
  <?php
  $sql = "SELECT q_id,question FROM question where course_type='$c' and acad_year='$acad_year'";
  $result = $conn->query($sql);   
  $noOfQues=$result->num_rows;
  while($row=$result->fetch_assoc()):
    $q_id=$row['q_id'];
    $question=$row["question"];

    ?>


    <!-- <div class="container" style="float: left; width: 40%; height: 350px;">-->


      <?php
      $s2 = "SELECT `option` FROM options where course_type='$c' and acad_year='$acad_year' and q_id='$q_id'";
      $res2 = $conn->query($s2);   
      $noOfOptions=$res2->num_rows;
      $options=array();
      $optionName=array();
      while($row2=$res2->fetch_assoc()){
        $options[]=0;
        $optionName[]=$row2["option"];
      }
      if($status==0){
     
        $m = "SELECT distinct(roll_no) FROM response_midsem where q_id='$q_id' and course_code='$electiveID' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
        $n = $conn->query($m); 
        $noOfStudents=$n->num_rows;

        $check = "SELECT response,roll_no FROM response_midsem where q_id='$q_id' and course_code='$electiveID' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
        $res = $conn->query($check);   
        while($response=$res->fetch_assoc()){
          $options[(int)$response["response"]-1]++;

        }

        if($q_id==$noOfQues){


          for($g=0;$g<count($options);$g++){

            $avg=$avg+((int)$optionName[$g]*(int)$options[$g]);
          }
          $avg=$avg/$noOfStudents;


        }
      }
      else{
       $m = "SELECT distinct(roll_no) FROM response_endsem where q_id='$q_id' and course_code='$electiveID' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
       $n = $conn->query($m); 
       $noOfStudents=$n->num_rows;

       $check = "SELECT response,roll_no FROM response_endsem where q_id='$q_id' and course_code='$electiveID' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
       $res = $conn->query($check);   
       while($response=$res->fetch_assoc()){
        $options[(int)$response["response"]-1]++;

      }

      if($q_id==$noOfQues){


        for($g=0;$g<count($options);$g++){

          $avg=$avg+((int)$optionName[$g]*(int)$options[$g]);
        }
        $avg=$avg/$noOfStudents;


      }
    }

    ?>



    <td style="width: 50%; text-align: center; border:0.5px solid #162252 ;padding: 5px; background-color: #f5f5f5 ">
      <?php echo "<br><b>".$question."</b><br>";  ?>
      <canvas id='<?php echo $c.$electiveName. $electiveID.$q_id ?>' width="50%" height="180" ></canvas> 
    </td>
    <script>
      var my_canvas=document.getElementById(<?php echo json_encode($c.$electiveName. $electiveID.$q_id)?>);
      var gctx=my_canvas.getContext("2d");

      var noOfOptions=<?php echo json_encode($noOfOptions)?>;
      var options=<?php echo json_encode($options)?>;
      var optionName=<?php echo json_encode($optionName)?>;
      var noOfStudents=<?php echo json_encode($noOfStudents)?>;
      var q_id=<?php echo json_encode($q_id)?>;
      var noOfQues=<?php echo json_encode($noOfQues)?>;
      var data=[];
      for(var m=0;m<noOfOptions;m++){
        data[m]=[optionName[m],(options[m]/noOfStudents)*100];
        
      }

      if(q_id%2==0){
        my_canvas.style.styleFloat="clear";
      }



      var bar_width=30;
var y_gap=30;  // Gap below the graph 
var bar_gap=100; // Gap between Bars including width of the bar
var x= 15; // Margin of graph from left  

y=my_canvas.height -y_gap ;
if(q_id==noOfQues){
  bar_gap=50;
  my_canvas.width=data.length * (  bar_gap)  + x;
}
my_canvas.width=data.length * (  bar_gap)  + x +22;
////////////end of settings ////
gctx.moveTo(x-5,y);
gctx.lineTo(my_canvas.width,y); // Base line of graph 
gctx.stroke();
/// add shadow ///
gctx.shadowColor = '#000000';
gctx.shadowOffsetX=3;
gctx.shadowOffsetY=3;
gctx.shadowBlur = 3;
/////////// Draw the graph ////////

for (i=0;i<data.length;i++){
gctx.shadowColor = '#ffffff'; // remove this line if you shadow on text is required
gctx.font = '15px serif'; // font for base label showing classes 
gctx.textAlign='left';
gctx.textBaseline='top';
gctx.fillStyle= '#162252';
gctx.fillText(data[i][0], x,y+5); // Write base text for classes 

gctx.beginPath();
gctx.lineWidth=2;
y1=y-data[i][1]; // Coordinate for top of the Bar 
x1 = x;    
gctx.font = '12px serif'; // font at top of the bar 
gctx.fillStyle= '#000000';
gctx.fillText(data[i][1].toFixed(1)+"%", x1,y1-20); // text at top of the bar 

gctx.fillStyle= '#2E5090'; // fill Colur of bar  
gctx.shadowColor = '#000000'; // shadow color for bars 
gctx.fillRect(x1,y1,bar_width,data[i][1]);// Filled bar 

x=x+bar_gap

}// end of for loop 

</script>
<?php 
if($q_id==$noOfQues-1){
  echo "</tr></table><table><tr>";
}
else if($q_id%2==0)
{
  echo "</tr><tr>";
}

?>


<?php endwhile;?>
</tr></table>






<?php echo "<br><p style=' text-align:center;'><b style='font-size: 18px;'>Faculty Evaluation: </b><strong style='color:#162252; font-size: 20px; '>".number_format((float)$avg, 2, '.', '')."</strong></p><br>";


if($status==0){
 $check = "SELECT comment FROM comment_midsem where course_code='$electiveID' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
 $res = $conn->query($check);
 echo "<b>Suggestions/ Comments<b><br>"; 
while($comment=$res->fetch_assoc()){
    if($comment["comment"]=="" or $comment["comment"] ==" " or $comment["comment"]=="NA" or $comment["comment"]=="na" or $comment["comment"] == "none")
      continue;
    echo "<b>- ".$comment["comment"]."</b><br>";
    
  }

}else{
   $check = "SELECT comment FROM comment_endsem where course_code='$electiveID' and f_id='$f_id' and acad_year='$acad_year' and sem_type='$sem_type' and roll_no in(".implode(',',$roll_no).")";
 $res = $conn->query($check);
 echo "<b>Suggestions/ Comments<b><br>";   
   
while($comment=$res->fetch_assoc()){
    if($comment["comment"]=="" or $comment["comment"] ==" " or $comment["comment"]=="NA" or $comment["comment"]=="na" or $comment["comment"] == "none")
      continue;
    echo "<b>- ".$comment["comment"]."</b><br>";
    
  }
}

echo "<hr><br>";
endwhile;
?>


