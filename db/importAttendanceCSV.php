<?php
session_start();
include ('../config/db_config.php');

$fileName = $_FILES["file"]["tmp_name"];

if ($_FILES["file"]["size"] > 0) {
//Open the file.
	$fileHandle = fopen($fileName, "r");

//Loop through the CSV rows.
	$i=0;
	while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
    //Dump out the row for the sake of clarity.
		if($i==0){
			var_dump($row);
			$courses=$row;
			$i++;

		}else if($i>0){
			var_dump($row);
			$roll_no=$row[0];
			for($x=1;$x<count($courses);$x++){
				$course_code=$courses[$x];
				$a=$row[$x];
				$querycheck = mysqli_query($conn,"SELECT * FROM attendance WHERE course_code = '$course_code' and roll_no='$roll_no'");
				$countrows = mysqli_num_rows($querycheck);
				if($countrows == 1)
				{
					$sql2 = "UPDATE attendance SET attendance='$a' WHERE course_code='$course_code' and roll_no='$roll_no'";
					if ($conn->query($sql2) === TRUE){

					} else{

					}
				}
				if($countrows==0){
					$sql = "INSERT INTO attendance values('{$roll_no}','{$course_code}','{$a}') ";
					if ($conn->query($sql) === TRUE){

					} else{

					}
				}

			}
			$i++;
		}



	}

}
?>