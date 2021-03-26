<?php
session_start();
include ('../config/db_config.php');
$roll_no=$_POST["roll_no"];
 if(isset($_SESSION['dept_id'])){
   $dept_id=$_SESSION['dept_id'];
   }else{
    $dept_id=$_POST['dept_id'];
   }
$fname=$_POST["fname"];
$mname=$_POST["mname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$password=$_POST["password"];
$class=$_POST["class"];
$sem=$_POST["sem"];
$batch=$_POST["batch"];
$section=$_POST["section"];
$electiveID=$_POST["electiveID"];
$electiveBatchID=$_POST["electiveBatchID"];
$querycheck = mysqli_query($conn,"SELECT * FROM student WHERE roll_no = '$roll_no'");
$countrows = mysqli_num_rows($querycheck);
if($countrows==1){
$sql = "UPDATE student SET fname='$fname',mname='$mname', lname='$lname',email='$email', pass='$password', dept_id='$dept_id',sem='$sem',batch='$batch',section='$section',class='$class',electiveID='$electiveID',electiveBatchID='$electiveBatchID' WHERE roll_no='$roll_no'";
  if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
if($countrows==0){
	$sql = "INSERT INTO student values('{$roll_no}','{$fname}','{$mname}','{$lname}','{$email}','{$password}','{$dept_id}','{$class}','{$sem}','{$batch}','{$section}','{$electiveID}','{$electiveBatchID}',0) ";
   if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


  ?>