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
$electiveID=$_POST['electiveID'];
$electiveName=$_POST['electiveName'];
$f_id=$_POST['f_id'];
$sem=$_POST['sem'];

$querycheck = mysqli_query($conn,"SELECT * FROM electives WHERE electiveID = '$electiveID' and acad_year='$acad_year' and dept_id='$dept_id'");
$countrows = mysqli_num_rows($querycheck);
if($countrows == 1)
{
  $sql2 = "UPDATE electives SET electiveName='$electiveName',f_id='$f_id',sem='$sem' WHERE electiveID='$electiveID' and acad_year='$acad_year' and dept_id='$dept_id'";
  if ($conn->query($sql2) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
if($countrows==0){
  $sql = "INSERT INTO electives values('{$electiveID}','{$electiveName}','{$f_id}','{$dept_id}','{$sem}','{$acad_year}')";
   if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}



exit();
}



if(isset($_POST['delete'])){

$electiveID=$_POST['electiveID'];


$sql = "DELETE FROM electives where electiveID='{$electiveID}' and dept_id='$dept_id' and acad_year='$acad_year'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


exit();
}




session_destroy();
?>




