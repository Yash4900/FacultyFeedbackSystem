<?php
session_start();
include ('../config/db_config.php');

if(isset($_POST["show"])){
   $sql = "SELECT * FROM principal";
  $result = $conn->query($sql);  
  echo  "<br><b style='font-size:30px;'>Current Principal Details<b><br><br>"; 
  while($row=$result->fetch_assoc()){
    echo "<b style='font-size:15px;'>ID: ".$row["id"]."<br>First Name: ".$row["fname"]."<br>Middle Name: ".$row["mname"]."<br>Last Name: ".$row["lname"]."<br>Email: ".$row["email"]."<br>Password: ".$row["pass"]."</b><br>";
  }
}

else{
  $principal_id=$_POST["principal_id"];

$fname=$_POST["fname"];
$mname=$_POST["mname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$password=$_POST["password"];

$querycheck = mysqli_query($conn,"SELECT * FROM principal WHERE id = '$principal_id'");
$countrows = mysqli_num_rows($querycheck);
if($countrows==1){
$sql = "UPDATE principal SET fname='$fname',mname='$mname', lname='$lname',email='$email', pass='$password' WHERE id='$principal_id'";
  if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
if($countrows==0){
  $sql = "INSERT INTO principal values('{$principal_id}','{$fname}','{$mname}','{$lname}','{$email}','{$password}') ";
   if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
}



  ?>