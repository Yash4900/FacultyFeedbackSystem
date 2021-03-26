<?php
session_start();
$_SESSION["errorMessage"]=0;
include ('../config/db_config.php');

//for Google Sign-In
if(isset($_POST['idtoken'])){

	require_once $google_api_path.'vendor/autoload.php';
	$client = new Google_Client(['client_id' => $CLIENT_ID]); 
	$id_token=$_POST['idtoken'];
	$payload = $client->verifyIdToken($id_token);

	if ($payload) {
		

		$_SESSION['user']=$payload['name'];
		// $_SESSION['pic']=$_POST['pic'];
		$_SESSION['email']=$payload['email'];
		$email=$_SESSION['email'];

		$sql_admin = $conn->prepare("SELECT adminEmail from admintable where adminEmail = ?");
		$sql_admin->bind_param("s",$email);
		$sql_admin->execute();
		$result_admin = $sql_admin->get_result();


		$sql_hod = $conn->prepare("SELECT dept_id FROM hodtable where email = ?");
		$sql_hod->bind_param("s",$email);
		$sql_hod->execute();
		$result_hod = $sql_hod->get_result();


		$sql_faculty = $conn->prepare("SELECT dept_id FROM department where email = ?");
		$sql_faculty->bind_param("s",$email);
		$sql_faculty->execute();
		$result_faculty = $sql_faculty->get_result();


		$sql_student = $conn->prepare("SELECT fname,lname,roll_no,dept_id,batch,class,sem,section FROM student where email = ?");
		$sql_student->bind_param("s",$email);
		$sql_student->execute();
		$result_student = $sql_student->get_result();
		


 		//checking for admin
		if ($result_admin->num_rows > 0) {
			
			$_SESSION['user']="ADMIN";
			$_SESSION['role']="admin";

			header("Location: ../dashboards/admin_dashboard.php");
		}

		//checking for hod
		else if ($result_hod->num_rows > 0) {
			while($row_hod = $result_hod->fetch_assoc()) {
				$dept_id=$row_hod['dept_id'];
			}
			$_SESSION['user']="Head Of Department";
			$_SESSION['role']="dept_hod";
			$_SESSION['dept_id']=$dept_id;
			header("Location: ../dashboards/dept_hod_dashboard.php");
		}

        //checking for dept cood
		else if ($result_faculty->num_rows > 0) {
			while($row_faculty = $result_faculty->fetch_assoc()) {
				$dept_id=$row_faculty['dept_id'];
			}
			$_SESSION['user']="Department Cood";
			$_SESSION['role']="dept_cood";
			$_SESSION['dept_id']=$dept_id;
			header("Location: ../dashboards/dept_cood_dashboard.php");
		}

        //checking for student
		else if($result_student->num_rows>0){
			while($row = $result_student->fetch_assoc()) {
				$_SESSION['dept_id']=$row["dept_id"];
				$_SESSION['batch']=$row["batch"];
				$_SESSION['class']=$row["class"];
				$_SESSION['section']=$row["section"];
				$_SESSION['sem']=$row["sem"];
				$_SESSION['roll_no']=$row["roll_no"];
				$_SESSION['email']=$row["email"];

			}
			$_SESSION['role']="student";
			header("Location: ../dashboards/student_dashboard.php");

		}

        //invalidating for other conditions
		else{
			$_SESSION["errorMessage"]=1;
			header("Location: ../index.php");
			exit();
		}

	}
}
//For normal Sign-In
else{

	$_SESSION['email']=$_POST['email'];
	$password=$_POST['password'];
	$email=$_SESSION['email'];

	$sql_admin = $conn->prepare("SELECT adminEmail from admintable where adminEmail = ? and adminPassword = ?");
	$sql_admin->bind_param("ss",$email,$password);
	$sql_admin->execute();
	$result_admin = $sql_admin->get_result();


	$sql_hod = $conn->prepare("SELECT dept_id FROM hodtable where email = ? and password = ?");
	$sql_hod->bind_param("ss",$email,$password);
	$sql_hod->execute();
	$result_hod = $sql_hod->get_result();


	$sql_faculty = $conn->prepare("SELECT dept_id FROM department where email = ? and password = ?");
	$sql_faculty->bind_param("ss",$email,$password);
	$sql_faculty->execute();
	$result_faculty = $sql_faculty->get_result();


	$sql_student = $conn->prepare("SELECT fname,lname,roll_no,dept_id,batch,class,sem,section FROM student where email = ? and pass = ?");
	$sql_student->bind_param("ss",$email,$password);
	$sql_student->execute();
	$result_student = $sql_student->get_result();

	


    //checking for admin
	if ($result_admin->num_rows > 0) {

		$_SESSION['user']="ADMIN";
		$_SESSION['role']="admin";

		header("Location: ../dashboards/admin_dashboard.php");
	}

	//checking for hod
		else if ($result_hod->num_rows > 0) {
			while($row_hod = $result_hod->fetch_assoc()) {
				$dept_id=$row_hod['dept_id'];
			}
			$_SESSION['user']="Head Of Department";
			$_SESSION['role']="dept_hod";
			$_SESSION['dept_id']=$dept_id;
			header("Location: ../dashboards/dept_hod_dashboard.php");
		}

        //checking for dept cood
	else if ($result_faculty->num_rows > 0) {
		while($row_faculty = $result_faculty->fetch_assoc()) {
			$dept_id=$row_faculty['dept_id'];
		}
		$_SESSION['user']="Department Cood";
		$_SESSION['role']="dept_cood";
		$_SESSION['dept_id']=$dept_id;
		header("Location: ../dashboards/dept_cood_dashboard.php");
	}


        //checking for student
	else if($result_student->num_rows>0){
		while($row_student = $result_student->fetch_assoc()) {
			$_SESSION['dept_id']=$row_student["dept_id"];
			$_SESSION['batch']=$row_student["batch"];
			$_SESSION['class']=$row_student["class"];
			$_SESSION['section']=$row_student["section"];
			$_SESSION['sem']=$row_student["sem"];
			$_SESSION['roll_no']=$row_student["roll_no"];
			$_SESSION['user']=$row_student['fname']." ".$row["lname"];
			$_SESSION['email']=$row_student["email"];


		}
		$_SESSION['role']="student";
		header("Location: ../dashboards/student_dashboard.php");

	}

        //invalidating for other conditions
	else{
		$_SESSION["errorMessage"]=$result_admin;
		header("Location: ../index.php");
		exit();
	}




}




?>