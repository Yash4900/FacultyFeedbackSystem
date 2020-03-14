<?php
session_start();
include ('../config/db_config.php');

if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];

}else{
  $dept_id=$_POST['dept_id'];
}

if(isset($_POST["f_id"])){
$f_id=$_POST["f_id"];
$sql = "DELETE FROM faculty where f_id='{$f_id}' and dept_id='$dept_id'";
  if ($conn->query($sql) === TRUE){
    echo "Record Deleted successfully";
  } else{
    echo "Error: " . $sql. "<br>" . $conn->error;
  }

}

  ?>