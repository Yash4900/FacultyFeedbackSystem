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
if(isset($_POST["class"])){
$class=$_POST["class"];
$sql = "DELETE FROM student where class='{$class}' and acad_year='$acad_year' and dept_id='$dept_id'";
  if ($conn->query($sql) === TRUE){
    echo "Records Deleted successfully";
  } else{
    echo "Error: " . $sql. "<br>" . $conn->error;
  }


}

  ?>