<?php
session_start();
include ('../config/db_config.php');

$dept_id=$_POST["dept_id"];
$f_id;
if(isset($_POST["Dept_cood"])){
  $Dept_cood=$_POST["Dept_cood"];
  $sql = "UPDATE department SET Dept_cood='$Dept_cood' WHERE dept_id='$dept_id'";
  if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
else{
  $sql = "SELECT Dept_cood FROM department where dept_id='$dept_id'";
  $result = $conn->query($sql);                     
  while($row=$result->fetch_assoc()){
    $f_id=$row["Dept_cood"];
  }
  $sql2 = "SELECT fname,mname,lname FROM faculty where f_id='$f_id'";
  $result2 = $conn->query($sql2);                     
  while($row2=$result2->fetch_assoc()){
    echo "Current Department Coordinator is ".$row2['fname']." ".$row2['mname']." ".$row2['lname'];
    }
                    
                    
}





  ?>