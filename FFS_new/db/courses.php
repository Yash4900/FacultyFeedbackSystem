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
$c_name=$_POST['c_name'];
$c_id=$_POST['c_id'];
$sem=$_POST['sem'];
$class=$_POST["class"];


$querycheck = mysqli_query($conn,"SELECT * FROM subject WHERE course_code = '$c_id' and dept_id='$dept_id' and acad_year='$acad_year'");
echo "Hello";
$countrows = mysqli_num_rows($querycheck);
if($countrows == 1)
{

  $sql2 = "UPDATE subject SET c_name='$c_name',dept_id='$dept_id',sem='$sem',class='$class' WHERE course_code='$c_id' and acad_year='$acad_year' and dept_id='$dept_id'";
  if ($conn->query($sql2) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
if($countrows==0){

  $sql = "INSERT INTO subject values('{$c_name}','{$c_id}','{$dept_id}','{$sem}','{$class}','{$acad_year}')";
   if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}



exit();
}



if(isset($_POST['delete'])){

$c_id=$_POST['c_id'];


$sql = "DELETE FROM subject where course_code='{$c_id}' and dept_id='$dept_id' and acad_year='$acad_year'";
$sql2 = "DELETE FROM courses_faculty where course_code='{$c_id}' and dept_id='$dept_id' and acad_year='$acad_year'";
if ($conn->query($sql2) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


exit();
}




session_destroy();
?>




