
<?php
session_start();

if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];
}else{
  $dept_id=$_POST['dept_id'];
}

include ('../config/db_config.php');

$sql = "SELECT acad_year,sem_type from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
  $acad_year=$r['acad_year'];
  $sem_type = $r['sem_type'];
}

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


<table id="electiveTable" class="table table-bordered">
  <thead>
    <tr>
      <th style="text-align: center; width: 150px;">Elective/ IDC ID</th>
      <th style="text-align: center; width:200px;">Elective/ IDC Name</th>
      <th style="text-align: center; width:100px;">Semester</th>
      <th style="text-align: center;">Faculty</th>
      <th style="text-align: center;">Action</th>
    </tr>
    <?php 

    $sql = "SELECT electiveID,electiveName,f_id,sem FROM electives where dept_id='$dept_id' and acad_year='$acad_year'";
    $result = $conn->query($sql);                     
    while($row=$result->fetch_assoc()): if(($sem_type=="Odd"&&((int)$row['sem']%2==1))||($sem_type=="Even"&&((int)$row['sem']%2==0))):
      $temp=$row['f_id'];
      $sql3="SELECT fname,lname from faculty where f_id='$temp'";
      $res2=$conn->query($sql3);
      while($r2=$res2->fetch_assoc()){
        $f_name=$r2['fname']." ".$r2['lname'];
      }
      ?>
      <tr>
        <td id="electiveID"><?= $row['electiveID'] ?></td>
        <td id="electiveName"><?= $row['electiveName'] ?></td>        
        <td id="sem"><?= $row['sem'] ?></td>
        <td id="f_id"><?= $f_name ?></td>
        <td>  <a id="addElective"class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
          <a id="editElective"class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
          <a id="deleteElective"class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a></td>
        </tr>                    
    <?php endif; endwhile; ?>
    </thead>

    <tbody>


    </tbody>
  </table>
