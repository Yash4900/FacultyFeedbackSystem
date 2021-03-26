<?php
session_start();
include ('../config/db_config.php');
if (isset($_POST["importStudent"])) {

	$fileName = $_FILES["file"]["tmp_name"];

	if ($_FILES["file"]["size"] > 0) {

		$fp = fopen($fileName, "r");

		while (($row = fgetcsv($fp, "500", ",")) != FALSE)
		{
			print_r($row);
			$sql = "INSERT INTO student VALUES('" . implode("','", $row) . "',0,0)";
			if (!$conn->query($sql))
			{
				echo '<br>Data Not Inserted<br>';
			}
		}
		fclose($fp);

	}
}
if (isset($_POST["importStudentIDC"])) {

	$fileName = $_FILES["file"]["tmp_name"];

	if ($_FILES["file"]["size"] > 0) {

		$fp = fopen($fileName, "r");

		while (($row = fgetcsv($fp, "500", ",")) != FALSE)
		{
			print_r($row);
			
			$sql = "UPDATE student set elective_or_IDC_ID5 = '$row[4]',elective_or_IDC_BatchID5 = '$row[5]' where roll_no = '$row[0]' and dept_id ='$row[1]' and sem = '$row[2]' and acad_year = '$row[3]'";
			if (!$conn->query($sql))
			{
				echo '<br>Data Not Inserted<br>';
			}
		}
		fclose($fp);

	}
}
if (isset($_POST["importFaculty"])) {

	$fileName = $_FILES["file"]["tmp_name"];

	if ($_FILES["file"]["size"] > 0) {

		$fp = fopen($fileName, "r");

		while (($row = fgetcsv($fp, "500", ",")) != FALSE)
		{
			print_r($row);
			$sql = "INSERT INTO faculty VALUES('" . implode("','", $row) . "')";
			if (!$conn->query($sql))
			{
				echo '<br>Data Not Inserted<br>';
			}
		}
		fclose($fp);

	}
}
?>