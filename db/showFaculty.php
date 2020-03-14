
<?php
session_start();
if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];
}else{
  $dept_id=$_POST['dept_id'];
}

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


<table id="f_5" class="table table-bordered">
  <thead>
    <tr>
      <th width="80px">Faculty ID</th>
      <th width="100px">First Name</th>
      <th width="100px">Middle Name</th>
      <th width="100px">Last Name</th>
      <th width="220px">Email ID</th>
      <th width="80px">Password</th>
      
      <th width="50px">Actions</th>
    </tr>
    <?php 

    $sql = "SELECT * FROM faculty where dept_id='$dept_id'";
    $result = $conn->query($sql);                     
    while($row=$result->fetch_assoc()): ?>
      
      <tr>
        <td width="80px" id="f_id"><?= $row['f_id'] ?></td>
        <td width="100px"id="f_fname"><?= $row['fname'] ?></td>
        <td width="100px"id="f_mname"><?= $row['mname'] ?></td>
        <td width="100px"id="f_lname"><?= $row['lname'] ?></td>
        <td width="220px" id="f_email"><?= $row['email'] ?></td>
        <td width="80px"id="f_password"><?= $row['pass'] ?></td>
        
        
        <td>  <a id="add5"class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
          <a id="edit5"class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
          <a id="delete5"class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a></td>
        </tr>                    
      <?php endwhile; ?>
    </thead>

    <tbody>
      
      
    </tbody>
  </table>
  