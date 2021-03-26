<?php
session_start();
include ('../config/db_config.php');

if(isset($_POST["show"])){
   $sql = "SELECT * FROM inst_cood";
  $result = $conn->query($sql);  
  echo  "<br><b style='font-size:30px;'>Current Institute Coordinator Details<b><br><br>"; 
  while($row=$result->fetch_assoc()){
    echo "<b style='font-size:15px;'>ID: ".$row["id"]."<br>First Name: ".$row["fname"]."<br>Middle Name: ".$row["mname"]."<br>Last Name: ".$row["lname"]."<br>Email: ".$row["email"]."<br>Password: ".$row["pass"]."</b><br>";
  }
}

else{


$inst_cood_id=$_POST["inst_cood_id"];

$fname=$_POST["fname"];
$mname=$_POST["mname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$password=$_POST["password"];

$querycheck = mysqli_query($conn,"SELECT * FROM inst_cood WHERE id = '$inst_cood_id'");
$countrows = mysqli_num_rows($querycheck);
if($countrows==1){
$sql = "UPDATE inst_cood SET fname='$fname',mname='$mname', lname='$lname',email='$email', pass='$password' WHERE id='$inst_cood_id'";
  if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
if($countrows==0){
  $sql = "INSERT INTO inst_cood values('{$inst_cood_id}','{$fname}','{$mname}','{$lname}','{$email}','{$password}') ";
   if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
}


  ?>