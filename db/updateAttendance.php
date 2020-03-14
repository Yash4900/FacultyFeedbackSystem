<?php
session_start();
include ('../config/db_config.php');

$roll_no=$_POST["roll_no"];
$course_code=$_POST["course_code"];
$a=$_POST["attendance"];

$querycheck = mysqli_query($conn,"SELECT * FROM attendance WHERE course_code = '$course_code' and roll_no='$roll_no'");
$countrows = mysqli_num_rows($querycheck);
if($countrows == 1)
{
	$sql2 = "UPDATE attendance SET attendance='$a' WHERE course_code='$course_code' and roll_no='$roll_no'";
	if ($conn->query($sql2) === TRUE){

	} else{

	}
}
if($countrows==0){
	$sql = "INSERT INTO attendance values('{$roll_no}','{$course_code}','{$a}') ";
	if ($conn->query($sql) === TRUE){

	} else{

	}
}



?>