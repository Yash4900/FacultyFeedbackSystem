<?php
session_start();
include ('../config/db_config.php');
if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];
}else{
  $dept_id=$_POST['dept_id'];
}


$sql = "SELECT acad_year from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
  $acad_year=$r['acad_year'];
}
if(isset($_POST['insert'])){
$option=$_POST['option'];
$option_no=$_POST['option_no'];
$q_id=$_POST['q_id'];
$course_type=$_POST['course_type'];

/*$question="new";
$q_id="C001_7";
$courseCode="C001";*/
$querycheck = mysqli_query($conn,"SELECT * FROM options WHERE option_no='$option_no' and q_id='$q_id' and acad_year='$acad_year' and course_type='$course_type'");
$countrows = mysqli_num_rows($querycheck);
if($countrows == 1)
{
  $sql2 = "UPDATE options SET `option`='$option' WHERE option_no='$option_no' and q_id='$q_id' and acad_year='$acad_year' and course_type='$course_type'";
  if ($conn->query($sql2) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
if($countrows==0){
 
  $sql = "INSERT INTO options values('{$acad_year}','{$course_type}','{$q_id}','{$option_no}','{$option}')";
   if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

exit();
}


if(isset($_POST['delete'])){

$q_id=$_POST['q_id'];
$option_no=$_POST['option_no'];
$course_type=$_POST['course_type'];

$sql = "DELETE FROM options where q_id='$q_id' and option_no='$option_no' and course_type='$course_type' and acad_year='$acad_year'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

exit();
}


?>




