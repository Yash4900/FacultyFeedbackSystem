<script type="text/javascript">

  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
</script>
<?php
session_start();

include ('../config/db_config.php');

$class=$_SESSION['class'];
$section=$_SESSION['section'];
$batch=$_SESSION['batch'];
$roll_no=$_SESSION['roll_no'];
$sem=$_SESSION["sem"];

// $class = 'MTech Comp';
// $section = 'A';
// $batch = 'A4';
// $roll_no = 1711058;
// $sem = 1;
// $_SESSION['class'] = $class;
// $_SESSION['section'] = $section;
// $_SESSION['batch'] = $batch;
// $_SESSION['roll_no'] = $roll_no;
// $_SESSION['sem'] = $sem;
// $_POST['score'] = 2;
$attendance=0;
$f_id=0;

$dept_id=$_SESSION["dept_id"];

$tname;


$sql = "SELECT acad_year,sem_type,`status` from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
  $acad_year=$r['acad_year'];
  $sem_type=$r['sem_type'];
  $status = $r['status'];
}



if(isset($_POST["flag"])){
  $roll_no=$_SESSION["roll_no"];
  if($status==0){
   $sql = "UPDATE student SET flag0=1 WHERE roll_no='$roll_no' and acad_year='$acad_year'";
   if ($conn->query($sql) === TRUE){
    echo "<b style='font-size:20px;'>Thank you for the Feedback!</b>";
  } else{
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}else if($status==1){
 $sql = "UPDATE student SET flag1=1 WHERE roll_no='$roll_no' and acad_year='$acad_year'";
 if ($conn->query($sql) === TRUE){
  echo "<b style='font-size:20px;'>Thank you for the Feedback!</b>";
} else{
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}
}

}


else if(isset($_POST['score'])){

  $q_id=$_POST['q_id'];
  $score=$_POST['score'];
  $c_id=$_POST['course_code'];

  // $q_id = 1;
  // $score = 2;
  // $c_id = 'TH_MLFORMTECH';
  
  // $querycheck1 = mysqli_query($conn,"SELECT attendance FROM attendance WHERE course_code = '$c_id' and roll_no =$roll_no");
  // while($row1 = mysqli_fetch_assoc($querycheck1))
  // {
  //   $attendance=$row1["attendance"];


  // }
  $checkIfElective=0;
  if($_SESSION['class']=='LY' or  $_SESSION['class']=='MTech Comp' or $_SESSION['class']=='MTech IT' or $_SESSION['class']=='MTech ETRX' or $_SESSION['class']=='MTech EXTC' or $_SESSION['class']=='MTech Mech'){
    $querycheck = mysqli_query($conn,"SELECT * FROM electives where dept_id='$dept_id' and acad_year='$acad_year' and electiveID='$c_id'");  

    if(mysqli_num_rows($querycheck)>0){
      $checkIfElective=1;
      $f_id = $_POST['f_id'];
      // $query = "SELECT f_id FROM electives where dept_id='$dept_id' and acad_year='$acad_year' and electiveID='$c_id'";
      // $res = $conn->query($query);                     
      // while($r=$res->fetch_assoc()){ 
      //   $f_id=$r['f_id'];
      //   echo $f_id;
      // }
    }

  }

  if($checkIfElective==0){
    $f_id = $_POST['f_id'];
  //   $querycheck2 = mysqli_query($conn,"SELECT f_id FROM courses_faculty WHERE course_code = '$c_id' and class='$class' and section_or_batch='$section'and acad_year='$acad_year'");
  //   $countrows = mysqli_num_rows($querycheck2);
  //   if($countrows==0)
  //   {
  //     $querycheck2 = mysqli_query($conn,"SELECT f_id FROM courses_faculty WHERE course_code = '$c_id' and class='$class' and section_or_batch='$batch' and acad_year='$acad_year'");
  //     while($row2 = mysqli_fetch_assoc($querycheck2))
  //     {
  //       $f_id=$row2["f_id"];


  //     }
  //   }else{
  //    while($row2 = mysqli_fetch_assoc($querycheck2))
  //    {
  //     $f_id=$row2["f_id"];
  //     echo $f_id;

  //   }
  // }
  }


  $sql = "SELECT status from current_state where dept_id='$dept_id'";
  $res = $conn->query($sql);                     
  while($r=$res->fetch_assoc()){ 
    $status=$r['status'];
  }
  if($status==0){

    $sql = "INSERT INTO response_midsem values ('{$acad_year}','{$sem_type}','{$c_id}','$f_id','{$q_id}',$roll_no,'{$score}') ";
    if ($conn->query($sql) === TRUE){
      echo "Record Updated successfully";
    } else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }else{
    $sql = "INSERT INTO response_endsem values ('{$acad_year}','{$sem_type}','{$c_id}','$f_id','{$q_id}',$roll_no,'{$score}') ";
    if ($conn->query($sql) === TRUE){
      echo "Record Updated successfully";
    } else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

}

else if(isset($_POST["comment"])){
  $comment=$_POST['comment'];
  $c_id=$_POST['course_code'];

  // $querycheck1 = mysqli_query($conn,"SELECT attendance FROM attendance WHERE course_code = '$c_id' and roll_no =$roll_no");
  // while($row1 = mysqli_fetch_assoc($querycheck1))
  // {
  //   $attendance=$row1["attendance"];

  // }
  $checkIfElective=0;
  if($_SESSION['class']=='LY' or  $_SESSION['class']=='MTech Comp' or $_SESSION['class']=='MTech IT' or $_SESSION['class']=='MTech ETRX' or $_SESSION['class']=='MTech EXTC' or $_SESSION['class']=='MTech Mech'){
    $querycheck = mysqli_query($conn,"SELECT * FROM electives where dept_id='$dept_id' and acad_year='$acad_year' and electiveID='$c_id'");  

    if(mysqli_num_rows($querycheck)>0){
      $checkIfElective=1;
      $f_id = $_POST['f_id'];
      // $query = "SELECT f_id FROM electives where dept_id='$dept_id' and acad_year='$acad_year' and electiveID='$c_id'";
      // $res = $conn->query($query);                     
      // while($r=$res->fetch_assoc()){ 
      //   $f_id=$r['f_id'];
      // }
    }

  }

  if($checkIfElective==0){
    $f_id = $_POST['f_id'];
  //   $querycheck2 = mysqli_query($conn,"SELECT f_id FROM courses_faculty WHERE course_code = '$c_id' and class='$class' and section_or_batch='$section'and acad_year='$acad_year'");
  //   $countrows = mysqli_num_rows($querycheck2);
  //   if($countrows==0)
  //   {
  //     $querycheck2 = mysqli_query($conn,"SELECT f_id FROM courses_faculty WHERE course_code = '$c_id' and class='$class' and section_or_batch='$batch' and acad_year='$acad_year'");
  //     while($row2 = mysqli_fetch_assoc($querycheck2))
  //     {
  //       $f_id=$row2["f_id"];


  //     }
  //   }else{
  //    while($row2 = mysqli_fetch_assoc($querycheck2))
  //    {
  //     $f_id=$row2["f_id"];
  //     //echo $f_id;

  //   }
  // }
  }


  $sql = "SELECT status from current_state where dept_id='$dept_id'";
  $res = $conn->query($sql);                     
  while($r=$res->fetch_assoc()){ 
    $status=$r['status'];
  }
  if($status==0){

    $sql = "INSERT INTO comment_midsem values ('{$acad_year}','{$sem_type}','{$c_id}','$f_id',$roll_no,'{$comment}') ";
    if ($conn->query($sql) === TRUE){
      echo "Record Updated successfully";
    } else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }else{
    $sql = "INSERT INTO comment_endsem values ('{$acad_year}','{$sem_type}','{$c_id}','$f_id','$roll_no','{$comment}') ";
    if ($conn->query($sql) === TRUE){
      echo "Record Updated successfully";
    } else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

?>