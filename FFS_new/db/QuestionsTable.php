
<?php
session_start();
$course_type=$_POST['courseCode'];
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

<script type="text/javascript">
var actions31 = '          <a id="add31" class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>\
      <a id="edit31" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>\
      <a id="delete31" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>'
function addnew(button){

    //$(this).attr("disabled", "disabled");
    var id="#"+$(button).parents('table').attr('id');
    var index = $(id+" tbody tr:last-child").index();
    var row = '<tr>' +
    '<td id="option_no"><input type="text" class="form-control" name="option_no" id="option_no"></td>' +
    '<td id="option"><input type="text" class="form-control" name="option" id="option" ></td>' +

    '<td>' + actions31 + '</td>' +
    '</tr>';
    $(id).append(row);   
    $(id+" tbody tr").eq(index + 1).find("#add31, #edit31").toggle();
       // $('[data-toggle="tooltip"]').tooltip();


     }

  </script>


<table id="3" class="table table-bordered">

  <thead>
    
    <?php 
    $sql1 = "SELECT q_id, question FROM question where course_type='$course_type' and acad_year='$acad_year'";
    $result = $conn->query($sql1);                     
    while($row=$result->fetch_assoc()): 
        $q_id = $row['q_id'];
    ?>
    <tr>
      <th style="width: 50px;">Question ID</th>
      <th>Question</th>
      <th>Actions</th>
    </tr>  

      <tr>
        <td id="q_id" style="width: 50px;"><?= $row['q_id'] ?></td>
        <td id="question"><?= $row['question'] ?></td>

        <td>  <a id="add3"class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
          <a id="edit3"class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
          <a id="delete3"class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
        </td>
      </tr> 
      </thead></table>
      <br>
      <table id='<?=$q_id?>' class="table table-bordered">
      <tr>
          <th style="background: #654321">Option ID</th>
          <th style="background: #654321">Option</th>
          <th style="background: #654321">Actions
            <button onclick="addnew(this)" type="button" class="btn btn-info add-new" id="addnew31"><i class="fa fa-plus"></i> Add New</button></th>
        </tr>  
      <?php 
   $sql2 = "SELECT option_no, `option` FROM options where course_type='$course_type' and acad_year='$acad_year' and q_id='$q_id'";
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
  <br><hr><br>
<table id="3" class="table table-bordered"><thead>

    <?php endwhile; ?>
      </thead>   
                
</table>

