<?php
session_start();
include ('../config/db_config.php');
if(isset($_SESSION['dept_id'])){
	$dept_id=$_SESSION['dept_id'];
}else{
	$dept_id=$_POST['dept_id'];
}




$sql="SELECT fname,mname,lname,f_id from faculty where dept_id='$dept_id'";
$res=$conn->query($sql);
while($r=$res->fetch_assoc()):
	?>
	
	<option data-value=<?= $r["f_id"] ?>><?php echo $r["fname"]." ".$r['lname']; ?></option>
<?php endwhile;?>








