<?php
session_start();
include ('../config/db_config.php');
if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];
}else{
  $dept_id=$_GET['dept_id'];
}
$sql = "SELECT acad_year from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
  $acad_year=$r['acad_year'];
}

$class=$_GET["class"];
$sem=$_GET["sem"];
$section=$_GET["section"];


$sql2="SELECT dept_name from department where dept_id='$dept_id'";
$result2 = $conn->query($sql2);  
while($row2=$result2->fetch_assoc()){
	$dept_name=$row2["dept_name"];
}

//The name of the CSV file that will be downloaded by the user.
$fileName = $dept_name." ".$class." ".$section.".csv";

//Set the Content-Type and Content-Disposition headers.
header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="' . $fileName . '"');

$courses=array();
$courses[]=" ";
$sql1="SELECT course_code from subject where class='$class' and sem='$sem' and acad_year='$acad_year' and dept_id='$dept_id'";

$result1 = $conn->query($sql1); 
$noOfCourses=$result1->num_rows; 
while($row1=$result1->fetch_assoc()){
	
	$courses[]=$row1["course_code"];
	
}

/*A multi-dimensional array containing our CSV data*/
$data=array();
$data[]=$courses;
$sql="SELECT roll_no from student where class='$class' and section='$section' and acad_year='$acad_year' and dept_id='$dept_id'";
$result = $conn->query($sql);  
while($row=$result->fetch_assoc()){
	$roll_no=$row["roll_no"];
	$data[]=array($roll_no);
}


//Open up a PHP output stream using the function fopen.
$fp = fopen('php://output', 'w');

//Loop through the array containing our CSV data.
foreach ($data as $row) {
    //fputcsv formats the array into a CSV format.
    //It then writes the result to our output stream.
	fputcsv($fp, $row);
}

//Close the file handle.
fclose($fp);