  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


  <table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th width="60px;" style="text-align: center;">Faculty ID</th>
        <th width="80px;" style="text-align: center;">Faculty Name</th>
        
        <th width="80px;" style="text-align: center;">Detailed Report</th>
        <th width="80px;" style="text-align: center;">Save Report</th>
        <!--<th width="40px;"><input type="checkbox" id="source"onClick="toggle(this)" />Mail Report</th>-->
      </tr>



      <?php
      session_start();
      include ('../config/db_config.php');



      $f_id; $cname; $c_id; $fname; $lname;                
      if(isset($_SESSION['dept_id'])){
        $dept_id=$_SESSION['dept_id'];
      }else{
        $dept_id=$_POST['dept_id'];
      }
      $sql = "SELECT acad_year,sem_type from current_state where dept_id='$dept_id'";
      $res = $conn->query($sql);                     
      while($r=$res->fetch_assoc()){ 
        $acad_year=$r['acad_year'];
        $sem_type = $r['sem_type'];

      }





/*$s = "SELECT fname,lname from faculty where f_id='$f_id'";
$r= $conn->query($s);
while($res=$r->fetch_assoc()){
$fname=$res['fname'];
$lname=$res['lname'];
echo "Faculty Name: ".$fname." ".$lname."<br><br>";
$_SESSION['reportUser']=$fname." ".$lname;
}*/


  #$t="SELECT * from faculty where dept_id='$dept_id'";
if($sem_type=="Odd")
$t = "SELECT distinct(f_id) from courses_faculty where dept_id='$dept_id' and sem%2=1 and acad_year = '$acad_year'";
if($sem_type=="Even")
$t = "SELECT distinct(f_id) from courses_faculty where dept_id='$dept_id' and sem%2=0 and acad_year = '$acad_year'";
$arr =[];
$u= $conn->query($t);
while($v=$u->fetch_assoc()):
 $f_id=$v['f_id'];
 if($f_id!="0"):
$arr[]=$f_id;
 $s = "SELECT fname,lname from faculty where f_id='$f_id'";
 $r= $conn->query($s);
 while($res=$r->fetch_assoc()){
  $fname=$res['fname'];
  $lname=$res['lname'];

}?>
<tr>
  <td id="f_id" style="text-align: center; font-size: 18px;"><?= $f_id ?></td>
  <td style="text-align: left; font-size:18px;"><?= $fname." ".$lname ?></td>


  <td style="text-align: center;"><button class="btn btn-danger" id="viewReport">View</button></td><td style="text-align: center;"><button class="btn btn-danger"id="downloadReport">Save</button></td><!--<td><input class="myCheckbox" name="myMail" type="checkbox" id="mailReport" onchange="toggleBack(this)"></td>--></tr>

  <?php
endif;
endwhile;
if($sem_type=="Odd")
$t = "SELECT distinct(f_id) from electives where dept_id='$dept_id' and sem%2=1 and acad_year = '$acad_year'";
if($sem_type=="Even")
$t = "SELECT distinct(f_id) from electives where dept_id='$dept_id' and sem%2=0 and acad_year = '$acad_year'";

$u= $conn->query($t);
while($v=$u->fetch_assoc()):
 $f_id=$v['f_id'];
 if($f_id!="0" ):
  if(!(in_array($f_id,$arr))):
 $s = "SELECT fname,lname from faculty where f_id='$f_id'";
 $r= $conn->query($s);
 while($res=$r->fetch_assoc()){
  $fname=$res['fname'];
  $lname=$res['lname'];

}?>
<tr>
  <td id="f_id" style="text-align: center; font-size: 18px;"><?= $f_id ?></td>
  <td style="text-align: left; font-size:18px;"><?= $fname." ".$lname ?></td>


  <td style="text-align: center;"><button class="btn btn-danger" id="viewReport">View</button></td><td style="text-align: center;"><button class="btn btn-danger"id="downloadReport">Save</button></td><!--<td><input class="myCheckbox" name="myMail" type="checkbox" id="mailReport" onchange="toggleBack(this)"></td>--></tr>

  <?php
endif;
endif;
endwhile;

?>

</thead>
</table>
<script>
function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
sortTable();
</script>
