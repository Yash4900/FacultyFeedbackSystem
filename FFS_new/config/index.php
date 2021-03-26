<?php
session_start();
if(isset($_SESSION['role'])){
	if($_SESSION['role']=='dept_cood')
		header("Location: ../dashboards/dept_cood_dashboard.php");
	if($_SESSION['role']=='student')
		header("Location: ../dashboards/student_dashboard.php");

}else{

	header("Location: ../index.php");
}

?>
