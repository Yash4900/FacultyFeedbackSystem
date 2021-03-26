
<?php
session_start();
include ('../config/db_config.php');
if(isset($_SESSION['dept_id'])){
	$dept_id=$_SESSION['dept_id'];
}else{
	$dept_id=$_POST['dept_id'];
}




$sql2="SELECT course_code,c_name from subject where dept_id='$dept_id'";
$res2=$conn->query($sql2);
while($r2=$res2->fetch_assoc()):
	?>
	
	
	<option data-value=<?= $r2["course_code"] ?>><?php echo $r2["c_name"];?></option>
<?php endwhile; 

?>