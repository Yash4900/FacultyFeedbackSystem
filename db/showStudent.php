
<?php
session_start();

include ('../config/db_config.php');

if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];
}else{
  $dept_id=$_POST['dept_id'];
}




$sql = "SELECT acad_year,sem_type from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
  $acad_year=$r['acad_year'];
  $sem_type=$r['sem_type'];
}

$class=$_POST['class'];
$section=$_POST['section'];

?>


<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../styles/dept_cood_dashboard_style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<table id="stu_4" class="table table-bordered" style="overflow-x:auto;">
  <thead>
    <tr>
      <th width="80vw">Roll no</th>
      <th width="100vw">First Name</th>
      <th width="100vw">Middle Name</th>
      <th width="100vw">Last Name</th>
      <th width="220vw">Email ID</th>
      <th width="80vw">Password</th>
      <th width="50vw">Class</th>
      <th width="50vw">Sem</th>
      <th width="50vw">Div</th>
      <th width="50vw">Batch</th>
      <th width="50vw">Elective/ IDC ID</th>
      <th width="60vw">Elective/ IDC BatchID</th>
      <th width="50vw">Elective/ IDC ID1</th>
      <th width="60vw">Elective/ IDC BatchID1</th>
      <th width="50vw">Elective/ IDC ID2</th>
      <th width="60vw">Elective/ IDC BatchID2</th>
      <th width="50vw">Elective/ IDC ID3</th>
      <th width="60vw">Elective/ IDC BatchID3</th>
      <th width="50vw">Elective/ IDC ID4</th>
      <th width="60vw">Elective/ IDC BatchID4</th>
      <th width="50vw">Elective/ IDC ID5</th>
      <th width="60vw">Elective/ IDC BatchID5</th>
      <th width="50vw">Actions</th>
    </tr>
    <?php 
    if($section=='All')
      $sql = "SELECT * FROM student where dept_id='$dept_id' and class='$class' and acad_year='$acad_year'";
    else
    $sql = "SELECT * FROM student where dept_id='$dept_id' and section='$section' and class='$class' and acad_year='$acad_year'";
    $result = $conn->query($sql);                     
    while($row=$result->fetch_assoc()): if(($sem_type=="Odd"&&((int)$row['sem']%2==1))||($sem_type=="Even"&&((int)$row['sem']%2==0))): ?>
      
      <tr>
        <td width="80vw" id="stu_roll_no"><?= $row['roll_no'] ?></td>
        <td width="100vw"id="stu_fname"><?= $row['fname'] ?></td>
        <td width="100vw"id="stu_mname"><?= $row['mname'] ?></td>
        <td width="100vw"id="stu_lname"><?= $row['lname'] ?></td>
        <td width="220vw" id="stu_email"><?= $row['email'] ?></td>
        <td width="80vw"id="stu_password"><?= $row['pass'] ?></td>
        <td width="50vw" id="stu_class"><?= $row['class'] ?></td>
        <td width="50vw"id="stu_sem"><?= $row['sem'] ?></td>
        <td width="50vw" id="stu_section"><?= $row['section'] ?></td>
        <td width="50vw" id="stu_batch"><?= $row['batch'] ?></td>
        <td width="50vw" id="stu_electiveID"><?= $row['elective_or_IDC_ID'] ?></td>
        <td width="50vw" id="stu_electiveBatchID"><?= $row['elective_or_IDC_BatchID'] ?></td>
        <td width="50vw" id="stu_electiveID1"><?= $row['elective_or_IDC_ID1'] ?></td>
        <td width="50vw" id="stu_electiveBatchID1"><?= $row['elective_or_IDC_BatchID1'] ?></td>
        <td width="50vw" id="stu_electiveID2"><?= $row['elective_or_IDC_ID2'] ?></td>
        <td width="50vw" id="stu_electiveBatchID2"><?= $row['elective_or_IDC_BatchID2'] ?></td>
        <td width="50vw" id="stu_electiveID3"><?= $row['elective_or_IDC_ID3'] ?></td>
        <td width="50vw" id="stu_electiveBatchID3"><?= $row['elective_or_IDC_BatchID3'] ?></td>
        <td width="50vw" id="stu_electiveID4"><?= $row['elective_or_IDC_ID4'] ?></td>
        <td width="50vw" id="stu_electiveBatchID4"><?= $row['elective_or_IDC_BatchID4'] ?></td>
        <td width="50vw" id="stu_electiveID5"><?= $row['elective_or_IDC_ID5'] ?></td>
        <td width="50vw" id="stu_electiveBatchID5"><?= $row['elective_or_IDC_BatchID5'] ?></td>
        <td>  <a id="add4"class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
          <a id="edit4"class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
          <a id="delete4"class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a></td>
        </tr>                    
    <?php endif; endwhile; ?>
    </thead>

    <tbody>
      
      
    </tbody>
  </table>
  