
<?php
session_start();
include ('../config/db_config.php');
if(isset($_SESSION['dept_id'])){
	$dept_id=$_SESSION['dept_id'];
}else{
	$dept_id=$_POST['dept_id'];
}

if(isset($_POST['saveChanges'])){ 

	$new1=$_POST["cur_status"];
	$new2=$_POST["sem_type"];
	$new3=$_POST["acad_year"];
	$new4=$_POST["start_time"];
	$new5=$_POST["end_time"];

	$sql = "UPDATE current_state SET status='$new1', sem_type='$new2', acad_year='$new3', start_time='$new4', end_time='$new5' where dept_id='$dept_id'";
	if ($conn->query($sql) === TRUE){

	} else{

	}
}
/*
if(isset($_POST['changestatus'])){ 

	$s; $new;
	$sql = "SELECT status,acad_year,sem_type FROM current_state where dept_id='$dept_id'";
	$result = $conn->query($sql);                     
	while($row=$result->fetch_assoc()){
		$s=$row['status'];
	}
	
	if($s==0)
		$new=1;
	else
		$new=0;


	$sql = "UPDATE current_state SET status='$new' where dept_id='$dept_id'";
	if ($conn->query($sql) === TRUE){

	} else{
	}
}

if(isset($_POST['changeAcadYear'])){

	$new=$_POST["acad_year"];

	$sql = "UPDATE current_state SET acad_year='$new' where dept_id='$dept_id'";
	if ($conn->query($sql) === TRUE){
	} else{
	}
}

if(isset($_POST['changeStartTime'])){

	$new=$_POST["start_time"];

	$sql = "UPDATE current_state SET start_time='$new' where dept_id='$dept_id'";
	if ($conn->query($sql) === TRUE){
	} else{
	}
}

if(isset($_POST['changeEndTime'])){

	$new=$_POST["end_time"];

	$sql = "UPDATE current_state SET end_time='$new' where dept_id='$dept_id'";
	if ($conn->query($sql) === TRUE){
	} else{
	}
}

if(isset($_POST['changeSemType'])){

	$s; $new;
	$sql = "SELECT status,acad_year,sem_type FROM current_state where dept_id='$dept_id'";
	$result = $conn->query($sql);                     
	while($row=$result->fetch_assoc()){		
		$s=$row["sem_type"];
	}

	if($s=="Odd")
		$new="Even";
	else
		$new="Odd";


	$sql = "UPDATE current_state SET sem_type='$new' where dept_id='$dept_id'";
	if ($conn->query($sql) === TRUE){
	} else{
	}
}
*/

$sql = "SELECT status,acad_year,sem_type, start_time, end_time FROM current_state where dept_id='$dept_id'";
$result = $conn->query($sql);                     
while($row=$result->fetch_assoc()){
	$s=$row['status'];
	$acad_year=$row["acad_year"];
	$sem_type=$row["sem_type"];
	$start_time=$row["start_time"];
	$end_time=$row["end_time"];
	if($s==1){
		$status="End Sem Feedback Activated";
	}else{
		$status="Mid Sem Feedback Activated";
	}

	
}

$eh=substr($end_time,11,2);
$em=substr($end_time,14,2);
$es=substr($end_time,17,2);
$ed=substr($end_time,8,2);
$emo=substr($end_time,5,2);
$ey=substr($end_time,0,4);

$sh=substr($start_time,11,2);
$sm=substr($start_time,14,2);
$ss=substr($start_time,17,2);
$sd=substr($start_time,8,2);
$smo=substr($start_time,5,2);
$sy=substr($start_time,0,4);
?>

<style type="text/css">
	#info {
		width: 80%;
		background-color: white;
		border: 1px solid black;
		border-radius: 0.7vw;
		margin: 2vw auto;
	}

	#info h2 {
		background-color: #800000;
		font-size: 1.5vw;
		font-weight: bold;
		color: white;
		padding: 2vw;
		margin-top: 0;
		margin-bottom: 0;
		border-top-right-radius: 0.7vw;
		border-top-left-radius: 0.7vw;
	}

	#info_table { 
		margin: 1vw auto;
		padding: 1vw;
	}

	#info_table td.norm {
		text-align: right;
		padding: 1vw; 
		font-family: Georgia, serif;
		color: #800000;
		font-weight: 1000;

	}
	.data{
		text-align: left;
		padding: 1vw;
		padding-left: 0;

		font-weight: 1000;
		color: #ff0000;
	}

</style>

<div id="info">
	<h2>System Status</h2><br>
	<table id="info_table">
		<tr>
			<td class="norm" style="color:black;">Academic Year</td>
			<td class="data">
				<select id="acad_year">
					<option value="2019-2020" <?php if($acad_year=="2019-2020"){ echo "selected";}?>>2019-2020</option>
					<option value="2020-2021" <?php if($acad_year=="2020-2021"){ echo "selected";}?>>2020-2021</option>
					<option value="2021-2022" <?php if($acad_year=="2021-2022"){ echo "selected";}?>>2021-2022</option>
					<option value="2022-2023" <?php if($acad_year=="2022-2023"){ echo "selected";}?>>2022-2023</option>
					<option value="2023-2024" <?php if($acad_year=="2023-2024"){ echo "selected";}?>>2023-2024</option>
					<option value="2024-2025" <?php if($acad_year=="2024-2025"){ echo "selected";}?>>2024-2025</option>
					<option value="2025-2026" <?php if($acad_year=="2025-2026"){ echo "selected";}?>>2025-2026</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td class="norm" style="color:black;">Semester Type</td>
			<td class="data">
				Odd
				<input type="radio" name="sem_type" id="odd" value="Odd" <?php if($sem_type=="Odd"){ echo "checked";}?>/>
				Even
				<input type="radio" name="sem_type" id="even" value="Even" <?php if($sem_type=="Even"){ echo "checked";}?>/>
				
			</td>
		</tr>

		<tr>
			<td class="norm" style="color:black;">Current Status</td>
			<td class="data" id="current_status">
				Mid Sem Feedback Activated
				<input type="radio" name="current_status" id="mid" value="mid_sem_feedback" <?php if($status=="Mid Sem Feedback Activated"){ echo "checked";}?>/><br>
				End Sem Feedback Activated
				<input type="radio" name="current_status" id="end" value="end_sem_feedback" <?php if($status=="End Sem Feedback Activated"){ echo "checked";}?>/>
				
			</td>
		</tr>

		<tr>
			<td class="norm" style="color:black;">Start Time of the Form</td>
			<td class="data">
				<!-- <i>Current value: <?php echo $start_time; ?></i> -->
				<!-- <br><br> -->
				Date: 
				<select id="start_year">
					<option value="<?php echo $sy; ?>" selected="selected" ><?php echo $sy; ?></option>
					<option value="2019" >2019</option>
					<option value="2020" >2020</option>
					<option value="2021" >2021</option>
					<option value="2022" >2022</option>
					<option value="2023" >2023</option>
					<option value="2024" >2024</option>
					<option value="2025" >2025</option>
				</select>
				-
				<select id="start_month">
					<option value="<?php echo $smo; ?>" selected="selected"><?php echo $smo; ?></option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				-
				<select id="start_day">
					<option value="<?php echo $sd; ?>" selected="selected"><?php echo $sd; ?></option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>	
				</select>
				
				<br><br>
				Time: 
				<select id="start_hour">
					<option value="<?php echo $sh; ?>" selected="selected"><?php echo $sh; ?></option>
					<option value="00">00</option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
				</select>
				:
				<select id="start_minute">
					<option value="<?php echo $sm; ?>" selected="selected"><?php echo $sm; ?></option>
					<option value="00">00</option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					<option value="32">32</option>
					<option value="33">33</option>
					<option value="34">34</option>
					<option value="35">35</option>
					<option value="36">36</option>
					<option value="37">37</option>
					<option value="38">38</option>
					<option value="39">39</option>
					<option value="40">40</option>
					<option value="41">41</option>
					<option value="42">42</option>
					<option value="43">43</option>
					<option value="44">44</option>
					<option value="45">45</option>
					<option value="46">46</option>
					<option value="47">47</option>
					<option value="48">48</option>
					<option value="49">49</option>
					<option value="50">50</option>
					<option value="51">51</option>
					<option value="52">52</option>
					<option value="53">53</option>
					<option value="54">54</option>
					<option value="55">55</option>
					<option value="56">56</option>
					<option value="57">57</option>
					<option value="58">58</option>
					<option value="59">59</option>
				</select>
				:
				<select id="start_second">
					<option value="<?php echo $ss; ?>" selected="selected"><?php echo $ss; ?></option>
					<option value="00">00</option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					<option value="32">32</option>
					<option value="33">33</option>
					<option value="34">34</option>
					<option value="35">35</option>
					<option value="36">36</option>
					<option value="37">37</option>
					<option value="38">38</option>
					<option value="39">39</option>
					<option value="40">40</option>
					<option value="41">41</option>
					<option value="42">42</option>
					<option value="43">43</option>
					<option value="44">44</option>
					<option value="45">45</option>
					<option value="46">46</option>
					<option value="47">47</option>
					<option value="48">48</option>
					<option value="49">49</option>
					<option value="50">50</option>
					<option value="51">51</option>
					<option value="52">52</option>
					<option value="53">53</option>
					<option value="54">54</option>
					<option value="55">55</option>
					<option value="56">56</option>
					<option value="57">57</option>
					<option value="58">58</option>
					<option value="59">59</option>
				</select>
			</td>
		</tr>

		<tr>
			<td class="norm" style="color:black;">End Time of the Form</td>
			<td class="data" >
				<!-- <i>Current value: <?php echo $end_time; ?></i> -->
				<!-- <br><br> -->
				Date: 
				<select id="end_year">
					<option value="<?php echo $ey; ?>"><?php echo $ey; ?></option>
					<option value="2019" >2019</option>
					<option value="2020" >2020</option>
					<option value="2021" >2021</option>
					<option value="2022" >2022</option>
					<option value="2023" >2023</option>
					<option value="2024" >2024</option>
					<option value="2025" >2025</option>
				</select>
				-
				<select id="end_month">
					<option value="<?php echo $emo; ?>"><?php echo $emo; ?></option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				-
				<select id="end_day">
					<option value="<?php echo $ed; ?>"><?php echo $ed; ?></option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>	
				</select>
				
				<br><br>
				Time: 
				<select id="end_hour">
					<option value="<?php echo $eh; ?>"><?php echo $eh; ?></option>
					<option value="00">00</option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
				</select>
				:
				<select id="end_minute">
					<option value="<?php echo $em; ?>"><?php echo $em; ?></option>
					<option value="00">00</option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					<option value="32">32</option>
					<option value="33">33</option>
					<option value="34">34</option>
					<option value="35">35</option>
					<option value="36">36</option>
					<option value="37">37</option>
					<option value="38">38</option>
					<option value="39">39</option>
					<option value="40">40</option>
					<option value="41">41</option>
					<option value="42">42</option>
					<option value="43">43</option>
					<option value="44">44</option>
					<option value="45">45</option>
					<option value="46">46</option>
					<option value="47">47</option>
					<option value="48">48</option>
					<option value="49">49</option>
					<option value="50">50</option>
					<option value="51">51</option>
					<option value="52">52</option>
					<option value="53">53</option>
					<option value="54">54</option>
					<option value="55">55</option>
					<option value="56">56</option>
					<option value="57">57</option>
					<option value="58">58</option>
					<option value="59">59</option>
				</select>
				:
				<select id="end_second">
					<option value="<?php echo $es; ?>"><?php echo $es; ?></option>
					<option value="00">00</option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					<option value="32">32</option>
					<option value="33">33</option>
					<option value="34">34</option>
					<option value="35">35</option>
					<option value="36">36</option>
					<option value="37">37</option>
					<option value="38">38</option>
					<option value="39">39</option>
					<option value="40">40</option>
					<option value="41">41</option>
					<option value="42">42</option>
					<option value="43">43</option>
					<option value="44">44</option>
					<option value="45">45</option>
					<option value="46">46</option>
					<option value="47">47</option>
					<option value="48">48</option>
					<option value="49">49</option>
					<option value="50">50</option>
					<option value="51">51</option>
					<option value="52">52</option>
					<option value="53">53</option>
					<option value="54">54</option>
					<option value="55">55</option>
					<option value="56">56</option>
					<option value="57">57</option>
					<option value="58">58</option>
					<option value="59">59</option>
				</select>
			</td>
		</tr>

		<tr>
			<td class="norm" colspan="2">
				<button id="status" onclick="saveChanges()" style="margin-right: 45%;">Save Changes</button>
			</td>
		</tr>
	</table>
</div>