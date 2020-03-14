<?php
session_start();
include ('../config/db_config.php');

$dept_id=$_POST["dept_id"];
$f_id;
if(isset($_POST["HOD_ID"])){
  $HOD_ID=$_POST["HOD_ID"];
  $sql = "UPDATE department SET HOD_ID='$HOD_ID' WHERE dept_id='$dept_id'";
  if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
else{
  $sql = "SELECT HOD_ID FROM department where dept_id='$dept_id'";
  $result = $conn->query($sql);                     
  while($row=$result->fetch_assoc()){
    $f_id=$row["HOD_ID"];
  }
  $sql2 = "SELECT fname,mname,lname FROM faculty where f_id='$f_id'";
  $result2 = $conn->query($sql2);                     
  while($row2=$result2->fetch_assoc()){
    echo "Current HOD is ".$row2['fname']." ".$row2['lname'];
    }
                    
                    
}





  ?>