<?php
session_start();
include ('../config/db_config.php');
$f_id=$_POST["f_id"];
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

$querycheck = mysqli_query($conn,"SELECT * FROM faculty WHERE f_id = '$f_id'");
$countrows = mysqli_num_rows($querycheck);
if($countrows==1){
$sql = "UPDATE faculty SET fname='$fname',mname='$mname', lname='$lname',email='$email', pass='$password', dept_id='$dept_id' WHERE f_id='$f_id'";
  if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
if($countrows==0){
	$sql = "INSERT INTO faculty values('{$f_id}','{$dept_id}','{$fname}','{$mname}','{$lname}','{$email}','{$password}') ";
   if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


  ?>