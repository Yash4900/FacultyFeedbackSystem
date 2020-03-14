<?php
session_start();
if($_SESSION["role"]!="student"){
	header("Location: ../index.php");
}
$dept_id=$_SESSION['dept_id'];
$sem=$_SESSION['sem'];
$roll_no=$_SESSION['roll_no'];
$class = $_SESSION['class'];
$batch = $_SESSION['batch'];
$section = $_SESSION['section'];

include ('../config/db_config.php');

$courses=[]; $given=0; $faculty = [];

$sql = "SELECT `status`,acad_year from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
	$acad_year=$r['acad_year'];
	$status=$r['status'];

}

$query = "SELECT course_code FROM subject where sem='$sem' and class='$class' and dept_id='$dept_id' and acad_year='$acad_year'";
$res = $conn->query($query);                     
while($r=$res->fetch_assoc()){ 
	$course_code=$r['course_code'];
  $fac_query = "SELECT f_id FROM courses_faculty where course_code='$course_code' and class='$class' and (section_or_batch='$section' or section_or_batch='$batch') and acad_year='$acad_year' and dept_id='$dept_id'";
  $res_fac_query = $conn->query($fac_query);                     
  while($re=$res_fac_query->fetch_assoc()){
    $f_id=$re['f_id'];
    if($status==0){
      $m = "SELECT * FROM response_midsem where  course_code='$course_code' and f_id = '$f_id'and acad_year='$acad_year' and roll_no='$roll_no'";
      $n = $conn->query($m); 
      $noOfStudents=$n->num_rows;

    }
    else{
      $m = "SELECT * FROM response_endsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
      $n = $conn->query($m); 
      $noOfStudents=$n->num_rows;

    }
    if($noOfStudents==0){
      $faculty[] = $f_id;
      $courses[]=$course_code;

    }else{
      $given++;
    }
  }


}

if($_SESSION['class']=='SY' or $_SESSION['class']=='LY'or $_SESSION['class']=='TY' or $_SESSION['class']=='MTech Comp' or $_SESSION['class']=='MTech IT' or $_SESSION['class']=='MTech ETRX' or $_SESSION['class']=='MTech EXTC' or $_SESSION['class']=='MTech Mech'){
  $query = "SELECT elective_or_IDC_ID,elective_or_IDC_BatchID,elective_or_IDC_ID1,elective_or_IDC_BatchID1,elective_or_IDC_ID2,elective_or_IDC_BatchID2,elective_or_IDC_ID3,elective_or_IDC_BatchID3,elective_or_IDC_ID4,elective_or_IDC_BatchID4,elective_or_IDC_ID5,elective_or_IDC_BatchID5 FROM student where dept_id='$dept_id' and acad_year='$acad_year' and roll_no='$roll_no'";
  $res = $conn->query($query);  
  if($res->num_rows>0){
  while($r=$res->fetch_assoc()){ 
    if(!is_null($r['elective_or_IDC_ID'])){
      $course_code=$r['elective_or_IDC_ID'];

      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }

      }
    }

    if(!is_null($r['elective_or_IDC_BatchID'])){
      $course_code=$r['elective_or_IDC_BatchID'];
      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }


      }
    }
    if(!is_null($r['elective_or_IDC_ID1'])){
      $course_code=$r['elective_or_IDC_ID1'];

      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }

      }
    }

    if(!is_null($r['elective_or_IDC_BatchID1'])){
      $course_code=$r['elective_or_IDC_BatchID1'];
      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }


      }
    }
    if(!is_null($r['elective_or_IDC_ID2'])){
      $course_code=$r['elective_or_IDC_ID2'];

      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }

      }
    }

    if(!is_null($r['elective_or_IDC_BatchID2'])){
      $course_code=$r['elective_or_IDC_BatchID2'];
      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }


      }
    }
    if(!is_null($r['elective_or_IDC_ID3'])){
      $course_code=$r['elective_or_IDC_ID3'];

      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }

      }
    }

    if(!is_null($r['elective_or_IDC_BatchID3'])){
      $course_code=$r['elective_or_IDC_BatchID3'];
      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }


      }
    }
    if(!is_null($r['elective_or_IDC_ID4'])){
      $course_code=$r['elective_or_IDC_ID4'];

      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }

      }
    }

    if(!is_null($r['elective_or_IDC_BatchID4'])){
      $course_code=$r['elective_or_IDC_BatchID4'];
      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }


      }
    }
    if(!is_null($r['elective_or_IDC_ID5'])){
      $course_code=$r['elective_or_IDC_ID5'];

      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }

      }
    }

    if(!is_null($r['elective_or_IDC_BatchID5'])){
      $course_code=$r['elective_or_IDC_BatchID5'];
      $fac_query = "SELECT electiveName,f_id FROM electives where  acad_year='$acad_year' and electiveID='$course_code'";
      $res_fac_query = $conn->query($fac_query);                     
      while($re=$res_fac_query->fetch_assoc()){
        $f_id=$re['f_id'];

        if($status==0){
          $m = "SELECT * FROM response_midsem where  course_code='$course_code'and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        else{
          $m = "SELECT * FROM response_endsem where  course_code='$course_code' and f_id = '$f_id' and acad_year='$acad_year' and roll_no='$roll_no'";
          $n = $conn->query($m); 
          $noOfStudents=$n->num_rows;
        }
        if($noOfStudents==0){
           $faculty[] = $f_id;
          $courses[]=$course_code;
        }else{
          $given++;
        }


      }
    }

}
    }

  }
  ?>
  <!DOCTYPE html>
  <html>
  <head>
   <title>Student</title>
   <script
   src="https://code.jquery.com/jquery-3.4.1.min.js"
   integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
   crossorigin="anonymous"></script>
   <link rel="stylesheet" type="text/css" href="../styles/student_dashboard_style.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

   <!-- For localhost or xip-->
   <!--<meta name="google-signin-client_id" content="716216124877-da5mdpsr4slhan6h122h1l1ktjbmbqko.apps.googleusercontent.com">-->

   <!-- For LMS-->
   <meta name="google-signin-client_id" content="976607952832-72obg31hpdohd31tnusnv2e3t3jqm832.apps.googleusercontent.com">
   <script src="https://apis.google.com/js/platform.js" async defer></script>

   <script type="text/javascript">


    function signOut() {
     var r = confirm("Log out from Faculty Feedback System?");
     if (r == true) {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {

       document.location.href = '../db/logout.php';

     });

      auth2.disconnect();
    }
  }
  function onLoad() {
   gapi.load('auth2', function() {
    gapi.auth2.init();

  });
 }

 var courses=[];
 var faculty=[];
 courses=<?php echo json_encode($courses);?>;
faculty=<?php echo json_encode($faculty);?>;
 var given=<?php echo json_encode($given);?>;




 var count=0;
 if(count<courses.length){
   $("[id=form_ques]").empty();
   $("#2").empty();
   $("#table2").empty();
     // alert(courses[count]);

     $.post(
      '../db/feedbackForm.php',
      {
       viewForm:1,
       course_code:courses[count],
       f_id : faculty[count]
     },

     function(result){
       $('#table2').append(result);

     }

     );
     count++;
   }

 </script>

</head>

<body> 
 <!-- <h1 id="h1"> K.J SOMAIYA COLLEGE OF ENGINEERING</h1>
  <h2 id="h2">FACULTY FEEDBACK SYSTEM - DEPARTMENT COORDINATOR DASHBOARD</h2>
  Outer Div starts-->
  <a href="#" class="pull-left visible-md visible-lg">
  	<img id="logo" src="../images/logo.png">
  </a>
  <div class="nav_mobile">
  <!-- <button id="h" onclick="openHome()" ><b>Home</b></button>
  <button id="f" onclick="openFeedback()" ><b>Open Feedback</b></button>
  <button id="l" onclick="signOut()" ><b>Logout</b></button> -->
  <!-- <br><br><br> -->
  
  <script type="text/javascript">
    $(document).ready(function(){
      $("#f").click(function(){
        $("#f").css("background-color","transparent");
        $("#f").css("color","white");
        $("#h").css("background-color","white");
        $("#h").css("color","black");
        $("#l").css("background-color","white");
        $("#l").css("color","black");
      });

      $("#h").click(function(){
        $("#h").css("background-color","transparent");
        $("#h").css("color","white");
        $("#f").css("background-color","white");
        $("#f").css("color","black");
        $("#l").css("background-color","white");
        $("#l").css("color","black");
      });


    });
  </script>
  <div class="header">

  	<ul class="profile-wrapper">
  		<li>
  			<!-- user profile -->
  			<div class="profile">


  				<img src="../images/professor.png" />

  				<!-- more menu -->
  				<ul class="menu">
  					<li><a href="#" onclick="signOut()">Log out</a></li>
  				</ul>
  			</div>
  		</li>
  	</ul>
  	<p id="name">User</p>
  </div>
<!-- 
  <script type="text/javascript">

  	document.getElementById("pic").src=<?php if(isset($_SESSION['pic'])){echo json_encode($_SESSION['pic']); }?>;
  </script> -->

  <script type="text/javascript">
  	document.getElementById("name").innerHTML=<?php echo json_encode($_SESSION['user']); ?>;
  </script> 
  <script type="text/javascript">

    $(document).ready(function(){
      $("#shrunk").hover(function(){
        document.getElementById("expandedinside").style.display = "block";

        var elems = document.getElementsByClassName('a');
        for (var i=0;i<elems.length;i+=1){
          elems[i].style.display = 'block';
        }
        document.getElementById("main").style.width="70vw";
        document.getElementById("outer").style.marginLeft="280px";
        document.getElementById("shrunkinside").style.display="none";
      });

      $("#main").mouseenter(function(){
       document.getElementById("expandedinside").style.display = "none";

       var elems = document.getElementsByClassName('a');
       for (var i=0;i<elems.length;i+=1){
        elems[i].style.display = 'none';
      }
      document.getElementById("shrunkinside").style.display="block";
      document.getElementById("main").style.width="80vw";
      document.getElementById("outer").style.marginLeft="100px";
      document.body.style.backgroundColor = "white";

    });
    });
  </script>
  <div class="container" id="shrunk">
  	<div class="icon-bar" id="shrunkinside">
  		<a id="home" onclick="openNav()"><i>&#8594;</i></a>   
  		<a   onclick="openHome()"><i class="fa fa-home"></i></a> 
  		<a href="#" onclick="openFeedback()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
  		<a href="#" onclick="signOut()"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
  		<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
  	</div>

  </div>
  <div class="container" id="expanded">
  	<div class="icon-bar" id="expandedinside">
  		<a class="a"id="home" onclick="closeNav()"><i>&#8592;</i></a>   
  		<a  class="a"  onclick="openHome()"><span class="fa fa-home" style="margin-right: 10px"></span><span style="font-size: 20px;">Home</span></a>  
  		<a  class="a" onclick="openFeedback()" href="#"><span class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">Give Feedback</span></a>

  		<a  class="a" onclick="signOut()" href="#"><span class="fa fa-sign-out" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">Logout</span></a>
  		<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>


  	</div>

  </div>
  <script type="text/javascript">
  	function openNav() {

  		document.getElementById("expandedinside").style.display = "block";

  		var elems = document.getElementsByClassName('a');
  		for (var i=0;i<elems.length;i+=1){
  			elems[i].style.display = 'block';
  		}
  		document.getElementById("main").style.width="70vw";
  		document.getElementById("outer").style.marginLeft="280px";
  		document.getElementById("shrunkinside").style.display="none";


  	}

  	function closeNav() {

  		document.getElementById("expandedinside").style.display = "none";

  		var elems = document.getElementsByClassName('a');
  		for (var i=0;i<elems.length;i+=1){
  			elems[i].style.display = 'none';
  		}
  		document.getElementById("shrunkinside").style.display="block";
  		document.getElementById("main").style.width="80vw";
  		document.getElementById("outer").style.marginLeft="100px";
  		document.body.style.backgroundColor = "white";
  	}

  	function nextCourse(){



  		document.getElementById(courses[count-1]+"_"+faculty[count-1]).className="badge-success";

  		$("[id=form_ques]").empty();
  		$("#2").empty();
  		$("#table2").empty();

  		if(count<courses.length) {
  			$.post(
  				'../db/feedbackForm.php',
  				{
  					viewForm:1,
  					course_code:courses[count],
            f_id : faculty[count]

  				},

  				function(result){
  					$('#table2').append(result);

  				}

  				);

  			count++;
  		}else{
  			$("[id=form_ques]").empty();
  			$("#2").empty();
  			$("#table2").empty();
  			$.post(
  				'../db/student_courses.php',
  				{
  					flag:1

  				},

  				function(result){
  					$('#table2').append(result);

  				}

  				);
  		}


  	}


  	function openHome(){

  		var div = document.getElementById('info');

  		if (div.style.display == 'block') {
  			div.style.display = 'none';


  		}
  		else {


  			$("#main").children().not(div).css("display","none");
  			div.style.display = 'block';

  		}

  		closeNav();
  	}


  	function openFeedback(){

  		var div = document.getElementById('feedback');

  		if (div.style.display == 'block') {
  			div.style.display = 'none';

  		}
  		else {


  			$("#main").children().not(div).css("display","none");
  			div.style.display = 'block';
  		}

  		closeNav();
  	}


  </script>

  <!--outer division starts-->
  <div id="outer">


  	

    <!--main div starts--> 
    <div id="main" style=" width: 80vw; margin-left: 5vw;">
      <div id="info">
        <h2>Student details</h2><br>
        <table id="info_table">
          <tr>
            <td class="norm">Name:</td>
            <td class="name" id="studentname">nm</td>
            <td class="norm">Roll No:</td>
            <td class="roll_no" id="studentrollno">rn</td>
          </tr>
          <tr>
            <td class="norm">Department:</td>
            <td class="Department" id="studentdepartment">d</td>
            <td class="norm">Class:</td>
            <td class="class" id="studentclass">y</td>
          </tr>
          <tr>
            <td class="norm">Section:</td>
            <td class="section" id="studentsection">b</td>
            <td class="norm">Batch:</td>
            <td class="batch" id="studentbatch">e</td>
          </tr>
        </table>
        <script type="text/javascript">
          var dept;
          switch (parseInt(<?php echo json_encode($_SESSION['dept_id']); ?>,10)) {
            case 1:
            dept = "Computer";
            break;
            case 2:
            dept = "IT";
            break;
            case 3:
            dept = "Electronics";
            break;
            case 4:
            dept = "Electronics & Telecommunications";
            break;
            case 5:
            dept = "Mechanical";
            break;
            case 6:
            dept = "Science & Humanities";
            break;
          }
          document.getElementById("studentname").innerHTML=<?php echo json_encode($_SESSION['user']); ?>;
          document.getElementById("studentrollno").innerHTML=<?php echo json_encode($_SESSION['roll_no']); ?>;
          document.getElementById("studentdepartment").innerHTML=dept;
          document.getElementById("studentclass").innerHTML=<?php echo json_encode($_SESSION['class']); ?>;
          document.getElementById("studentbatch").innerHTML=<?php echo json_encode($_SESSION['batch']); ?>;
          document.getElementById("studentsection").innerHTML=<?php echo json_encode($_SESSION['section']); ?>;


        </script>
        <b style="font-size: 20px;">Your response will stay anonymous</b>
        <button style='width:300px; height:40px; font-size:18px;background-color: #451EB2; margin-bottom: 10px; margin-top: 20px;' class='btn btn-primary' id="proceedToFeedback" onclick='openFeedback()'>PROCEED TO FEEDBACK</button>
        
      </div>






      <div id="feedback">
       <script type="text/javascript">

        for(var j=0;j<given;j++){
         var parent=document.getElementById("feedback");
         var newcontent = document.createElement('span');
         newcontent.className="badge-success";
         newcontent.innerHTML=(j+1);
         parent.appendChild(newcontent);
       }
       var temp=given+1;

       for(var j=0;j<courses.length;j++){
         var parent=document.getElementById("feedback");
         var newcontent = document.createElement('span');
         newcontent.className="badge-warning";
         newcontent.id=courses[j]+"_"+faculty[j];
         newcontent.innerHTML=(temp);
         temp++;
         parent.appendChild(newcontent);
       }

     </script>

     <div class="table-wrapper" id="table2">

     </div>
     <script type="text/javascript">
      if(courses.length==0){
       var parent=document.getElementById("table2");
       parent.innerHTML="<b style='font-size:20px;'>You have already submitted Feedback</b>";
     }
   </script>
   <script type="text/javascript">

    function validateForm(){
     var formsCollection = document.getElementsByTagName("form");
     var counter=0; var ans=0;
     for(var i=0;i<formsCollection.length;i++){

      var answer=$(formsCollection[i]).find("[id=answer]");
      answer.each(function(){
       ans=ans+1;
       var q=$(this).find("#q_id").html();
       var s=$(this).find("input[name="+q+"]:checked").val();
       if(s==null)
       {

       }else{
        counter=counter+1;
      }
    })
    }
    if(counter==ans)
    {
      submitForm();
    }else{
      alert("Attempt All Questions");
      
    }
  }

  function submitForm(){


   var formsCollection = document.getElementsByTagName("form");
   var i=0; var counter=0;


   for(i=0;i<formsCollection.length;i++){


    var temp=$(formsCollection[i]).find("[id=comment]")
    var comment=temp.find("input[name='stu_comment']").val();
    $.post(
      '../db/student_courses.php',
      {
       course_code:courses[count-1],  
       f_id : faculty[count-1],   
       comment:comment
     },

     function(result){


     }

     );
    var c=$(formsCollection[i]).find("#course_name").html(); 


    var j=1;
    var answer=$(formsCollection[i]).find("[id=answer]");
    answer.each(function(){


     var q=$(this).find("#q_id").html();
     var s=$(this).find("input[name="+q+"]:checked").val();


     $.post(
      '../db/student_courses.php',
      {


       course_code:courses[count-1],
       f_id : faculty[count-1] ,         
       q_id:q,
       score:s
     },

     function(result){


     }

     );
   })


  }
  if(i==formsCollection.length)
  {


    nextCourse();

  }


}






</script>
</div>
<!--main div ends--> 
</div>
<!--Outer div ends-->
</div>
</body>
</html>


