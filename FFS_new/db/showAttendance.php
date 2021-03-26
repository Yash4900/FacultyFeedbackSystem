
<?php
session_start();


if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];
}else{
  $dept_id=$_POST['dept_id'];
}
$class=$_POST["class"];
$sem=$_POST["sem"];
$section=$_POST["section"];
include ('../config/db_config.php');



?>


<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../styles/dept_cood_dashboard_style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<table id="studentAttTable" class="table table-bordered" style="overflow-x:auto;">
  <thead>
    <tr>
      <th width="80vw">Roll no</th>
      <th width="100vw">First Name</th>
      <th width="100vw">Middle Name</th>
      <th width="100vw">Last Name</th>

      <?php 
      
      $courses=array();
      $sql1="SELECT course_code,c_name from subject where class='$class' and sem='$sem' and dept_id='$dept_id'";

      $result1 = $conn->query($sql1); 
      $noOfCourses=$result1->num_rows; 
      while($row1=$result1->fetch_assoc()):
        $courses[]=$row1["course_code"];?>
        <th><?= $row1['course_code']."-".$row1["c_name"] ?></td>
        <?php endwhile;?>

        <th width="50vw">Actions</th>
      </tr>

      <?php 
      $sql = "SELECT * FROM student where dept_id='$dept_id' and class='$class' and sem='$sem' and section='$section'";
      $result = $conn->query($sql);                     
      while($row=$result->fetch_assoc()):
        $roll_no=$row['roll_no']; ?>

        <tr>
          <td width="80vw" id="stu_roll_no"><?= $row['roll_no'] ?></td>
          <td width="100vw"id="stu_fname"><?= $row['fname'] ?></td>
          <td width="100vw"id="stu_mname"><?= $row['mname'] ?></td>
          <td width="100vw"id="stu_lname"><?= $row['lname'] ?></td>
          <?php 
          for($i=0;$i<count($courses);$i++):
            $course_code=$courses[$i];
            $sql2 = "SELECT attendance FROM attendance where roll_no='$roll_no' and course_code='$course_code'";
            $result2 = $conn->query($sql2);
            if($result2->num_rows>0):                     
              while($row2=$result2->fetch_assoc()): ?>
                <td id=<?=$course_code?>><?= $row2['attendance'] ?></td> 
              <?php endwhile;endif;

              if($result2->num_rows==0):?>
                <td>--</td>
                <?php
              endif;
            endfor;?>
            


            <td>  <a id="add6"class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
              <a id="edit6"class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
             
            </tr>                    
          <?php endwhile; ?>
        </thead>

        <tbody>


        </tbody>
      </table>
