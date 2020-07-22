<?php 
session_start();
include ('../config/db_config.php');
if(isset($_SESSION['dept_id'])){
  $dept_id=$_SESSION['dept_id'];
}else{
  $dept_id=$_POST['dept_id'];
}

include ('../config/db_config.php');
$year=$_POST['year'];
$sem=$_POST['sem'];


?>

<table id="6" class="table table-bordered">
  <thead>
    <tr>  
      <th style="text-align: center;">Course Code</th>
      <th style="text-align: center;">Course Name</th>
      <th style="text-align: center;">Course Type</th>
      <th style="text-align: center;">Overall Average</th>
    </tr>

    <?php 
    $sql1 = "SELECT DISTINCT c_name , course_code FROM subject where acad_year='$year' and sem='$sem' and dept_id='$dept_id'";
    $res1= $conn->query($sql1);
while($row1=$res1->fetch_assoc()){
	$c_name=$row1['c_name'];
  	$c_code=$row1['course_code'];

  	if($c_code[0]=='L')
    	$c=$c_code[0];
	elseif ($c_code[0]=='T' and $c_code[1]=='H') 
    	$c='TH';
	else
    	$c='TU';

  	$sumOfResponses = 0;
  	$sql2 = "SELECT response FROM response_endsem WHERE acad_year='$year' AND course_code='$c_code'";
  	$res2= $conn->query($sql2);
  	while($row2=$res2->fetch_assoc()){
  		$sumOfResponses = $sumOfResponses + $row2['response'];
  	}

  	$sql3 = "SELECT response FROM response_midsem WHERE acad_year='$year' AND course_code='$c_code'";
  	$res3= $conn->query($sql3);
  	while($row3=$res3->fetch_assoc()){
  		$sumOfResponses = $sumOfResponses + $row3['response'];
  	}

  	$noOfResponses=$res2->num_rows + $res3->num_rows;
  	$avg = $sumOfResponses/$noOfResponses;
  	$avg = number_format((float)($avg), 2,'.','');

    ?>

<tr id="swacr">
    
    <td id="ccode"><?= $c_code ?></td>
    <td id="cname"><?= $c_name ?></td>
    <td id="ctype"><?= $c ?></td>
    <td id="average"><?php echo $avg; ?></td>
</tr>

<?php } ?>

</thead>

    <tbody>


    </tbody>
</table>

<!-- Print Table -->
<button id="button_print_swac"  class="btn btn-success" onclick="printDataSummarySWAC()">Print</button>
<script>

  function printDataSummarySWAC()
  {
   var divToPrint=document.getElementById("6");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.document.write("<head><style>@media print{ table{border-collapse: collapse;} table, td, th{ border:1px solid #000; text-align:center;padding-left:20px;padding-right:20px;} </style></head>")
   newWin.print();
   newWin.close();
 }

 $('#button_print_swac').on('click',function(){
  printDataSummary();
});
</script>

<!-- Download as Excel -->
<button id="swac_export_excel"  class="btn btn-success" onclick="swacExport()">Download as excel file</button>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <script type="text/javascript">
        function swacExport() {
            $("#6").table2excel({
                filename: "Overall_Course_feedback.xls"
            });
        }
    </script>

