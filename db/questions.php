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
$question=$_POST['question'];
$q_id=$_POST['q_id'];
$courseCode=$_POST['courseCode'];

/*$question="new";
$q_id="C001_7";
$courseCode="C001";*/
$querycheck = mysqli_query($conn,"SELECT * FROM question WHERE q_id='$q_id' and acad_year='$acad_year' and course_type='$courseCode'");
$countrows = mysqli_num_rows($querycheck);
if($countrows == 1)
{
  $sql2 = "UPDATE question SET question='$question' WHERE q_id='$q_id' and acad_year='$acad_year'  and course_type='$courseCode'";
  if ($conn->query($sql2) === TRUE){
    //echo "Record Updated successfully";
  } else{
    //echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}
if($countrows==0):
 
  $sql = "INSERT INTO question values('{$courseCode}','{$q_id}','{$question}','{$acad_year}') ";
   if ($conn->query($sql) === TRUE){
    //echo "Record Updated successfully";
  } else{
    //echo "Error: " . $sql . "<br>" . $conn->error;
  }

?>
  <table id='<?=$q_id?>' class="table table-bordered">
      <tr>
          <th style="background: #654321">Option ID</th>
          <th style="background: #654321">Option</th>
          <th style="background: #654321">Actions
            <button onclick="addnew(this)" type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button></th>
        </tr>  
      <?php 
   $sql2 = "SELECT option_no, `option` FROM options where course_type='$courseCode' and acad_year='$acad_year' and q_id='$q_id'";
    $res2 = $conn->query($sql2);
    while($row2=$res2->fetch_assoc()):
    ?>
    <tr>
          <td id="option_no"><?= $row2['option_no'] ?></td>
          <td id="optionn"><?= $row2['option'] ?></td>
          <td>
          <a id="add31"class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
          <a id="edit31"class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
          <a id="delete31"class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
          </td>
        </tr>
    <?php endwhile; ?>  
  </table>
  <?php
endif;

exit();
}


if(isset($_POST['delete'])){

$q_id=$_POST['q_id'];
$course_type=$_POST['course_type'];
$sql = "DELETE FROM question where q_id='{$q_id}' and acad_year='$acad_year' and course_type='$course_type'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

exit();
}


?>




