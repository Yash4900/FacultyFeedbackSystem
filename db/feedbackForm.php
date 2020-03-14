<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include ('../config/db_config.php');
$roll_no=$_SESSION['roll_no'];
$course_code=$_POST['course_code'];
$f_id = $_POST['f_id'];
$sem=$_SESSION["sem"];

$dept_id=$_SESSION["dept_id"];
$class=$_SESSION["class"];
$section=$_SESSION["section"];
$batch=$_SESSION["batch"];

$sql = "SELECT start_time,end_time,`status` from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
	$start_time=$r["start_time"];
	$end_time=$r["end_time"];
	$status = $r["status"];
}
$currentTime=date("Y-m-d")." ".date("H:i:s");
if(strtotime($currentTime)>strtotime($end_time)){
	
	echo "<b style='font-size:20px;'>This form has stopped accepting responses. Contact administrator for further queries</b>";
	exit();
}
if(strtotime($currentTime)<strtotime($start_time)){
	
	echo "<b style='font-size:20px;'>This form is not open yet. Contact administrator for further queries</b>";
	
	exit();
}
$flag=0;
if($status==0){
	$sql_student = "SELECT flag0 FROM student WHERE roll_no = '$roll_no'";
	$result_student = $conn->query($sql_student);

	while($row = $result_student->fetch_assoc()) {
		$flag=$row['flag0'];
	}


}else if($status==1){
	$sql_student = "SELECT flag1 FROM student WHERE roll_no = '$roll_no'";
	$result_student = $conn->query($sql_student);

	while($row = $result_student->fetch_assoc()) {
		$flag=$row['flag1'];
	}

}


if($flag==0):

	?>


	<script
	src="https://code.jquery.com/jquery-3.4.1.min.js"
	integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../styles/student_dashboard_style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="../styles/feedbackForm_style.css">
	<script type="text/javascript">
		$(document).ready(function(){
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
			$('.list-group-item').click(function() {

				$(this).find('input').prop('checked', true)    
			});



		});
	</script>
	<?php 
	$sql = "SELECT acad_year from current_state where dept_id='$dept_id'";
	$res = $conn->query($sql);                     
	while($r=$res->fetch_assoc()){ 
		$acad_year=$r['acad_year'];
	}
	$sem=$_SESSION["sem"];
	$dept_id=$_SESSION["dept_id"];
	$querycheck = mysqli_query($conn,"SELECT * FROM electives WHERE electiveID = '$course_code' and   acad_year='$acad_year'");


	
	if(mysqli_num_rows($querycheck)>0){
		$query = "SELECT electiveName FROM electives where  acad_year='$acad_year' and electiveID='$course_code' and f_id = '$f_id'";

		$res = $conn->query($query);                     
		while($r=$res->fetch_assoc()){
			$c_name=$r['electiveName'];
			//$f_id=$r['f_id'];
		}

		$fac_name_query = "SELECT fname, lname FROM faculty where f_id='$f_id'";
		$res_name_query = $conn->query($fac_name_query);
		while($res_name=$res_name_query->fetch_assoc()){
			$fname=$res_name['fname'];
			$lname=$res_name['lname'];
		}
	}
	
	else{
		$query = "SELECT c_name FROM subject where sem='$sem' and dept_id='$dept_id' and acad_year='$acad_year' and course_code='$course_code'";
		$res = $conn->query($query);                     
		while($r=$res->fetch_assoc()){ 

			$c_name=$r['c_name'];


		}
		
		// $fac_query = "SELECT f_id FROM courses_faculty where course_code='$course_code' and class='$class' and (section_or_batch='$section' or section_or_batch='$batch') and acad_year='$acad_year'";
		// $res_fac_query = $conn->query($fac_query);                     
		// while($re=$res_fac_query->fetch_assoc()){
		// 	$f_id=$re['f_id'];
		// }
		
		$fac_name_query = "SELECT fname, lname FROM faculty where f_id='$f_id'";
		$res_name_query = $conn->query($fac_name_query);
		while($res_name=$res_name_query->fetch_assoc()){
			$fname=$res_name['fname'];
			$lname=$res_name['lname'];
		}
	}
	?>
	<form name="myForm" method="post">
		<div class="table-title" id="form_ques">
			<div class="panel panel-primary" style="font-size: 20px; background-color: #add8e6; padding: 5px;" > 
				&nbsp; &nbsp; <b id="course_name">Course Name: <?= $c_name ?></b>
				&nbsp; &nbsp; <b>Faculty: <?= $fname ?></b>&nbsp;<b><?= $lname ?></b>
			</div>

			<?php 
			if($course_code[0]=='L')
				$c=$course_code[0];
			elseif ($course_code[0]=='T') 
				$c='TH';


			$sql = "SELECT q_id,question FROM question where course_type='$c'  and acad_year='$acad_year'";
			$result = $conn->query($sql);   
			$noOfQues=$result->num_rows;                   
			while($row=$result->fetch_assoc()): 
				$q_id=$row["q_id"];?>
				<div class="container" align="left" style="width: 80%;" id="answer" >
					<div class="row">
						<br/>
						<div class="panel panel-primary">
							<div class="panel-heading" > 
								<p  style="text-align: left; font-size: 20px; margin: 0em; font-family: sans-serif">Question:&nbsp;<b id="q_id"><?= $row['q_id'] ?></b></p> <br>  
								<p id="question" style="text-align: left; font-size: 20px; margin-top: -20px; word-break: keep-all; font-family: sans-serif"> <?= $row['question']." *" ?></p>

							</div><!--.panel-heading-->

							<div class = "panel-body">
								<h4>Your Answer</h4>
							</div>
							<?php if($q_id==$noOfQues):?>
								<ul class = "list-group" >
									<?php
									$sql2 = "SELECT option_no,`option` FROM options where course_type='$c' and q_id=$q_id  and acad_year='$acad_year'";
									$result2 = $conn->query($sql2) or die($conn->error);?>
									<li >
										<div class="checkbox" ><b> Min &nbsp;&nbsp;</b>              
											<?php while($row2=$result2->fetch_assoc()): 
												$option_no=$row2["option_no"];

												$option=$row2["option"];?>
												<label class="radio-inline">
													<input id="radio" type="radio" value="<?php echo $option_no;?>" name=<?= $row['q_id'] ?> required/><?php echo $option;?>
												</label>



												<?php endwhile;?><b> &nbsp;&nbsp;Max </b> 
											</div>
										</li>
									</ul>
								<?php endif;?>
								<?php if($q_id<$noOfQues):?>
									<ul class = "list-group" >
										<?php
										$sql2 = "SELECT option_no,`option` FROM options where course_type='$c' and q_id=$q_id and acad_year='$acad_year'";
										$result2 = $conn->query($sql2) or die($conn->error);

										while($row2=$result2->fetch_assoc()): 
											$option_no=$row2["option_no"];

											$option=$row2["option"];?>
											<li class = "list-group-item">
												<div class="checkbox" >
													<input id="radio" type="radio" value="<?php echo $option_no;?>" name=<?= $row['q_id'] ?> required/>
													<label for="radio">
														<?php echo $option;?>               
													</label>
												</div>
											</li>
										<?php endwhile;?>
									</ul>
								<?php endif;?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<div class="container" align="left" style="width: 80%;" id="comment" >
					<div class="row">
						<br/>
						<div class="panel panel-primary">
							<div class="panel-heading" > 
								<br>
								<p id="question" style="text-align: left; font-size: 20px; margin-top: -20px; word-break: keep-all; font-family: sans-serif">Any suggestions/comment?</p>

							</div><!--.panel-heading-->

							<div class = "panel-body">
								<h4>Your Answer</h4>
							</div>

							<ul class = "list-group" >
								<?php
								$sql2 = "SELECT option_no,`option` FROM options where course_type='$c' and q_id=$q_id and acad_year='$acad_year'";
								$result2 = $conn->query($sql2) or die($conn->error);?>
								<li >

									<input type="text" style=" border: none; border-bottom: 1px #5480CD solid; width: 90%; height: 12%; padding: 5px; margin-left: 3%;" name="stu_comment">
									<br><br>
								</li>
							</ul>


						</div>
					</div>
				</div>

			</form><br><br><hr><br>
			<?php 
			echo "<button type='submit' style='width:200px; height:50px; font-size:20px;' class='btn btn-primary'  onclick='validateForm()' id='next'>SAVE AND NEXT</button>";

		endif;
		if($flag==1){

			echo "<b style='font-size:20px;'>You have already submitted Feedback</b>"; 
		}?>