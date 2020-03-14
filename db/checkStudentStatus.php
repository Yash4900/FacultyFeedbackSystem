<?php
session_start();
include ('../config/db_config.php');


$roll_no; $fname; $lname;                
if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];
}
else{
  $dept_id=$_POST['dept_id'];
}
$sql = "SELECT acad_year,`status`,sem_type from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
  $acad_year=$r['acad_year'];
  $status = $r['status'];
  $sem = $r["sem_type"];

}

if($sem=="Odd")
  $sem_type=1;
else
  $sem_type=0;


$class=$_POST['class'];
$section=$_POST['section'];

?>

<style>
  .button2{
    background-color: #A0522D; /* Green */
    border: none;
    border-radius: 8px;
    color: white;
    padding: 6px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;;
    cursor: pointer;
  }

  .button2:hover {
    background-color: #5cb85c;
  }


</style>

<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>



<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../styles/table_style.css">
<b style="font-size: 20px;">Following students have not given feedback yet</b><br><br>

<table class="table table-bordered" id="myTable2">
  <thead>
    <tr>
      <th width="80px;">Sr. No</th>
      <th width="100px;">Roll No</th>
      <th width="200px;">Student Name</th>
      <th width="200px">Student Email</th>
      <th width="300px;"><input type="checkbox" id="source"onClick="toggle2(this)" />Mail</th>
    </tr>




    <?php
    if($status==0):
     if($section=='All')
      $t="SELECT * from student where dept_id='$dept_id' and flag0=0 and acad_year='$acad_year' and class='$class' and sem%2='$sem_type'";
    else
      $t="SELECT * from student where dept_id='$dept_id' and flag0=0 and acad_year='$acad_year' and class='$class' and section='$section' and sem%2='$sem_type'";
    $u= $conn->query($t);
    $srno=1;
    while($v=$u->fetch_assoc()):
     $roll_no=$v['roll_no'];

     $fname=$v['fname'];
     $lname=$v['lname'];
     $email =$v['email'];
  
   
   



   ?>
   <tr>
    <td><?= $srno ?></td>
    <td id="roll_no"><?= $roll_no ?></td>
    <td><?= $fname." ".$lname ?></td>
    <td id="mail_id"><?= $email?></td>
    <td><input type="checkbox" id="source"onClick="toggleBack2(this)" name="myMail2"/></td>
  </tr>

  <?php 
  $srno++;
endwhile; 
endif;
if($status==1):
 if($section=='All')
      $t="SELECT * from student where dept_id='$dept_id' and flag1=0 and acad_year='$acad_year' and class='$class' and sem%2='$sem_type'";
    else
      $t="SELECT * from student where dept_id='$dept_id' and flag1=0 and acad_year='$acad_year' and class='$class' and section='$section'and sem%2='$sem_type'";
    $u= $conn->query($t);
    $srno=1;
    while($v=$u->fetch_assoc()):
     $roll_no=$v['roll_no'];

     $fname=$v['fname'];
     $lname=$v['lname'];
     $email =$v['email'];


?>
<tr>
    <td><?= $srno ?></td>
    <td id="roll_no"><?= $roll_no ?></td>
    <td><?= $fname." ".$lname ?></td>
    <td id="mail_id"><?= $email?></td>
    <td><input type="checkbox" id="source"onClick="toggleBack2(this)" name="myMail2"/></td>
  </tr>

  <?php 
  $srno++;
endwhile; 
endif;?>
</thead>
</table>
</br></br>

<button  class="button2" onclick="printData()">Print</button>
<br><br>
<span style="float:left;"><i>You can edit content of the mail here:</i></span>
<br>
<table id="mail_message">
  <tr>
    <td contenteditable="true" style="text-align: left;background-color: rgb(206,237,244); height:100px; vertical-align: top; font-size: 17px;">Please fill in the Faculty Feedback forms through the following link https://lms-kjsce.somaiya.edu/facultyfeedback. Using Google Sign In. Thanks & Regards, Faculty Feedback Committee, KJSCE.</td>
  </tr>
</table>

<span style="float:left;"><i>Add cc here(comma separated):</i></span>
<br>
<table id="get_cc">
  <tr>
    <td contenteditable="true" style="text-align: left;background-color: rgb(228,228,228);"></td>
  </tr>
</table>

<script>
  function printData()
  {
   var divToPrint=document.getElementById("myTable2");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.document.write("<head><style>@media print{ table{border-collapse: collapse;} table, td, th{ border:1px solid #000; } th:nth-child(5){display:none;} td:nth-child(5){display:none;} td:nth-child(2), td:nth-child(1){text-align:center} }</style></head>")
   newWin.print();
   newWin.close();
 }

 $('.button2').on('click',function(){
  printData();
});


</script>
