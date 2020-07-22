<?php
session_start();
if($_SESSION["role"]!="dept_cood"){
	header("Location: ../index.php");
}
if(isset($_SESSION['dept_id'])){
	$dept_id=$_SESSION['dept_id'];
}else{
	$dept_id=$_POST['dept_id'];
}

include ('../config/db_config.php');

?>
<!DOCTYPE html>
<html>
<head>


	<title>Department Coordinator</title>

	<style type="text/css">
		
	</style>

	<script
	src="https://code.jquery.com/jquery-3.4.1.min.js"
	integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../styles/dept_cood_dashboard_style.css">
	<link rel="shortcut icon" type="image/png" href="../images/logo.png">


	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



	<!-- For localhost or xip-->
	<!--<meta name="google-signin-client_id" content="716216124877-da5mdpsr4slhan6h122h1l1ktjbmbqko.apps.googleusercontent.com">-->

	<!-- For LMS-->
	<meta name="google-signin-client_id" content="976607952832-72obg31hpdohd31tnusnv2e3t3jqm832.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js" async defer></script>

	<script type="text/javascript">
		$(document).ready( function() {
			$.post(
				'../db/status.php',
				{
					showstatus:1
				},

				function(result){

					document.getElementById("message").innerHTML=result;

				}
				);
			$('.dropdown-toggle').dropdown();
		});

		function signOut() {
			var r = confirm("Log out from Faculty Feedback System?");
			if (r == true) {
				var auth2 = gapi.auth2.getAuthInstance();
				auth2.signOut().then(function () {

					location.replace("../db/logout.php");

				});

				auth2.disconnect();
			}
		}
		function onLoad() {
			gapi.load('auth2', function() {
				gapi.auth2.init();

			});
		}

		function toggle(source) {

			$("#myTable input:checkbox[name=myMail]").each(function(){
				$(this).prop('checked', source.checked);

			}
			);
		}
		function toggleBack(child){
			$("#myTable input:checkbox[name=myMail]").each(function(){
				if($(this).prop('checked')==false){
					$("#source").prop("checked", false);
					return false;
				}
				$("#source").prop("checked", true);
			}
			);    

		}

		function toggle2(source) {

			$("#myTable2 input:checkbox[name=myMail2]").each(function(){
				$(this).prop('checked', source.checked);

			}
			);
		}
		function toggleBack2(child){
			$("#myTable2 input:checkbox[name=myMail2]").each(function(){
				if($(this).prop('checked')==false){
					$("#source").prop("checked", false);
					return false;
				}
				$("#source").prop("checked", true);
			}
			);    

		}

		function searchStudent() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("table211");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td1= tr[i].getElementsByTagName("td")[0];
				td2= tr[i].getElementsByTagName("td")[1];
				td3= tr[i].getElementsByTagName("td")[2];
				td4= tr[i].getElementsByTagName("td")[3];
				td5= tr[i].getElementsByTagName("td")[6];
				if (td1) {
					txtValue = td1.textContent || td1.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						if (td2) {
							txtValue = td2.textContent || td2.innerText;
							if (txtValue.toUpperCase().indexOf(filter) > -1) {
								tr[i].style.display = "";
							}else{
								if (td3) {
									txtValue = td3.textContent || td3.innerText;
									if (txtValue.toUpperCase().indexOf(filter) > -1) {
										tr[i].style.display = "";
									}else{
										if (td4) {
											txtValue = td4.textContent || td4.innerText;
											if (txtValue.toUpperCase().indexOf(filter) > -1) {
												tr[i].style.display = "";
											}else{
												if (td5) {
													txtValue = td5.textContent || td5.innerText;
													if (txtValue.toUpperCase().indexOf(filter) > -1) {
														tr[i].style.display = "";
													}else{
														tr[i].style.display="none";
													}
												}
											}
										}
									}
								}

							}

						}

					}    
				}
			}
		}



		function searchFaculty() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput2");
			filter = input.value.toUpperCase();
			table = document.getElementById("table212");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td1= tr[i].getElementsByTagName("td")[0];
				td2= tr[i].getElementsByTagName("td")[1];
				td3= tr[i].getElementsByTagName("td")[2];
				td4= tr[i].getElementsByTagName("td")[3];
				if (td1) {
					txtValue = td1.textContent || td1.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						if (td2) {
							txtValue = td2.textContent || td2.innerText;
							if (txtValue.toUpperCase().indexOf(filter) > -1) {
								tr[i].style.display = "";
							}else{
								if (td3) {
									txtValue = td3.textContent || td3.innerText;
									if (txtValue.toUpperCase().indexOf(filter) > -1) {
										tr[i].style.display = "";
									}else{
										if (td4) {
											txtValue = td4.textContent || td4.innerText;
											if (txtValue.toUpperCase().indexOf(filter) > -1) {
												tr[i].style.display = "";
											}else{
												tr[i].style.display="none";
											}
										}
									}
								}

							}

						}

					}    
				}
			}
		}
	</script>
	<script type="text/javascript">

		$(document).ready(function(){



			$('[data-toggle="tooltip"]').tooltip();
			var actions1 = '          <a id="add1" class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>\
			<a id="edit1" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>\
			<a id="delete1" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>'
			var actions2 = '          <a id="add2" class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>\
			<a id="edit2" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>\
			<a id="delete2" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>'
			var actions3 = '          <a id="add3" class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>\
			<a id="edit3" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>\
			<a id="delete3" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>'
			var actions4 = '          <a id="add4" class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>\
			<a id="edit4" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>\
			<a id="delete4" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>'
			var actions5 = '          <a id="add5" class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>\
			<a id="edit5" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>\
			<a id="delete5" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>'
			var actions6 = '          <a id="addElective" class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>\
			<a id="editElective" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>\
			<a id="deleteElective" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>'

  // Append table with add row form on add new button click

  $("#addnew1").click(function(){

    //$(this).attr("disabled", "disabled");
    var index = $("#1 tbody tr:last-child").index();
    var row = '<tr>' +
    '<td id="c_id"><input type="text" class="form-control" name="c_id" id="c_id"></td>' +
    '<td id="c_name"><input type="text" class="form-control" name="c_name" id="c_name"></td>' +

    '<td>' + actions1 + '</td>' +
    '</tr>';
    $("#1").append(row);   
    $("#1 tbody tr").eq(index + 1).find("#add1, #edit1").toggle();
       // $('[data-toggle="tooltip"]').tooltip();


   });

  $("#addnewElective").click(function(){

    //$(this).attr("disabled", "disabled");
    var index = $("#electiveTable tbody tr:last-child").index();
    var row = '<tr>' +
    '<td id="electiveID"><input type="text" class="form-control" name="electiveID" id="electiveID"></td>' +
    '<td id="electiveName"><input type="text" class="form-control" name="electiveName" id="electiveName"></td>' +
    '<td id="sem"><input type="text" class="form-control" name="sem" id="sem"></td>' +
    '<td id="f_id"><input type="text" list="suggestions" style="width:200px;"  class="form-control" name="f_id" id="f_id"></td>'+
    '<td>' + actions6 + '</td>' +
    '</tr>';
    $("#electiveTable").append(row);   
    $("#electiveTable tbody tr").eq(index + 1).find("#addElective, #editElective").toggle();
       // $('[data-toggle="tooltip"]').tooltip();
   });

  $("#addnew2").click(function(){

    //$(this).attr("disabled", "disabled");
    var index = $("#2 tbody tr:last-child").index();
    var row = '<tr>' +
    '<td id="c_id"><input type="text" class="form-control" name="c_id" id="c_id"></td>' +
    '<td id="c_name"><input type="text" class="form-control" name="c_name" id="c_name"></td>' +
    '<td id="f_id"><input type="text" list="suggestions" class="form-control" name="f_id" id="f_id"></td>'+
    '<td>' + actions2 + '</td>' +
    '</tr>';
    $("#2").append(row);   
    $("#2 tbody tr").eq(index + 1).find("#add2, #edit2").toggle();
       // $('[data-toggle="tooltip"]').tooltip();


   });

  $("#addnew3").click(function(){

    //$(this).attr("disabled", "disabled");
   //var index = $("#table456 table:last-child").index();
   var row = '<table id="3" class="table table-bordered"><thead>   <tr>' +
   '<td id="q_id"><input type="text" class="form-control" name="q_id" id="q_id"></td>' +
   '<td id="question"><input type="text" class="form-control" name="question" id="question" ></td>' +

   '<td>' + actions3 + '</td>' +
   '</tr></thead></table>';
   $("#table456").append(row);   
   $("#table456 table").last().find("#add3, #edit3").toggle();
       // $('[data-toggle="tooltip"]').tooltip();




   });

  $("#addnew4").click(function(){

    //$(this).attr("disabled", "disabled");
    var index = $("#stu_4 tbody tr:last-child").index();
    var row = '<tr>' +
    '<td id="stu_roll_no"><input type="text" class="form-control" name="stu_roll_no" id="stu_roll_no"></td>'+
    '<td id="stu_fname"><input type="text" class="form-control" name="stu_fname" id="stu_fname"></td>'+
    '<td id="stu_mname"><input type="text" class="form-control" name="stu_mname" id="stu_mname"></td>'+
    '<td width="100px"id="stu_lname"><input type="text" class="form-control" name="stu_lname" id="stu_lname"></td>'+
    '<td width="220px" id="stu_email"><input type="text" class="form-control" name="stu_email" id="stu_email"></td>'+
    '<td width="80px"id="stu_password"><input type="text" class="form-control" name="stu_password" id="stu_password"></td>'+
    '<td width="50px" id="stu_class"><input type="text" class="form-control" name="stu_class" id="stu_class"></td>'+
    '<td width="50px"id="stu_sem"><input type="text" class="form-control" name="stu_sem" id="stu_sem"></td>'+
    '<td width="50px" id="stu_section"><input type="text" class="form-control" name="stu_section" id="stu_section"></td>'+
    '<td width="50px" id="stu_batch"><input type="text" class="form-control" name="stu_batch" id="stu_batch"></td>'+
    '<td width="50px" id="stu_electiveID"><input type="text" class="form-control" name="stu_electiveID" id="stu_electiveID"></td>'+
    '<td width="50px" id="stu_electiveBatchID"><input type="text" class="form-control" name="stu_electiveBatchID" id="stu_electiveBatchID"></td>'+
    '<td>' + actions4 + '</td>' +
    '</tr>';
    $("#stu_4").append(row);   
    $("#stu_4 tbody tr").eq(index + 1).find("#add4, #edit4").toggle();
       // $('[data-toggle="tooltip"]').tooltip();


   });

  $("#addnew5").click(function(){

    //$(this).attr("disabled", "disabled");
    var index = $("#f_5 tbody tr:last-child").index();
    var row = '<tr>' +
    '<td id="f_id"><input type="text" class="form-control" name="f_id" id="f_id"></td>'+
    '<td id="f_fname"><input type="text" class="form-control" name="f_fname" id="f_fname"></td>'+
    '<td id="f_mname"><input type="text" class="form-control" name="f_mname" id="f_mname"></td>'+
    '<td width="100px"id="f_lname"><input type="text" class="form-control" name="f_lname" id="f_lname"></td>'+
    '<td width="220px" id="f_email"><input type="text" class="form-control" name="f_email" id="f_email"></td>'+
    '<td width="80px"id="f_password"><input type="text" class="form-control" name="f_password" id="f_password"></td>'+


    '<td>' + actions5 + '</td>' +
    '</tr>';
    $("#f_5").append(row);   
    $("#f_5 tbody tr").eq(index + 1).find("#add5, #edit5").toggle();
       // $('[data-toggle="tooltip"]').tooltip();


   });


  // Add row on add button click
  $(document).on("click", "#add1", function(){

  	var empty = false;
  	var input = $(this).parents("tr").find('input[type="text"]'); 
  	var c_idv=$(this).parents("tr").find('#c_id').val();
  	var c_namev=$(this).parents("tr").find('#c_name').val();

  	if(c_idv=="" || c_namev=="")
  	{
  		var temp=["demo"]; var i=1;
  		input.each(function(){
  			temp[i]=$(this).val();
  			i=i+1;
  		});
  		c_idv=temp[1];
  		c_namev=temp[2];  
  	}
  	var e = document.getElementById("sem");
  	var s=e.options[e.selectedIndex].value;
  	var f = document.getElementById("class");
  	var a=f.options[f.selectedIndex].value;
  	//alert(c_namev+" "+c_idv+" "+a+" "+s);
  	if(e.selectedIndex<=0 || f.selectedIndex<=0 ){
  		alert("Select Semester and Class!");
  	}
  	else{

  		$.post(

  			'../db/courses.php',
  			{
  				insert:1,
  				c_name: c_namev,
  				c_id:c_idv,          
  				class:a,
  				sem:s
  			},

  			function(result){


            //alert("Course Added");
        }

        );

  		input.each(function(){
  			if(!$(this).val()){
  				$(this).addClass("error");
  				empty = true;
  			} else{
  				$(this).removeClass("error");
  			}
  		});
  		$(this).parents("tr").find(".error").first().focus();
  		if(!empty){
  			input.each(function(){
  				$(this).parent("td").html($(this).val());


  			});     
  			$(this).parents("tr").find("#add1, #edit1").toggle();
      //$("#addnew1").removeAttr("disabled");
  }   

}


});



  $(document).on("click", "#addElective", function(){
  	var empty = false;
  	var input = $(this).parents("tr").find('input[type="text"]'); 
  	var electiveID=$(this).parents("tr").find('#electiveID').val();
  	var electiveName=$(this).parents("tr").find('#electiveName').val();
  	var f_id=$(this).parents("tr").find('#f_id').val();
  	var sem=$(this).parents("tr").find('#sem').val();
  	if(electiveID=="" || electiveName=="")
  	{
  		var temp=["demo"]; var i=1;
  		input.each(function(){
  			temp[i]=$(this).val();
  			i=i+1;
  		});
  		electiveIDv=temp[1];
  		electiveNamev=temp[2];
  		sem=temp[3];
  		f_idv=temp[4];  
  	}
  	
  	var  options = document.querySelectorAll('#suggestions option');
  	for(var i = 0; i < options.length; i++) {
  		var option = options[i];

  		if(option.innerText === f_idv) {
  			var value2send = option.getAttribute('data-value');
  			break;
  		}
  	}
  	$.post(

  		'../db/electives.php',
  		{
  			insert:1,
  			electiveID: electiveIDv,
  			electiveName :electiveNamev,
  			f_id:value2send,
  			sem:sem          

  		},

  		function(result){

  			//alert("Elective Added");
  		}

  		);

  	input.each(function(){
  		if(!$(this).val()){
  			$(this).addClass("error");
  			empty = true;
  		} else{
  			$(this).removeClass("error");
  		}
  	});
  	$(this).parents("tr").find(".error").first().focus();
  	if(!empty){
  		input.each(function(){
  			$(this).parent("td").html($(this).val());


  		});     
  		$(this).parents("tr").find("#addElective, #editElective").toggle();
      //$("#addnew1").removeAttr("disabled");
  }   

});


  $(document).on("click", "#add2", function(){
  	var empty = false;
  	var input = $(this).parents("tr").find('input[type="text"]');

  	var c_idv=$(this).parents("tr").find('#c_id').val();
  	var f_idv=$(this).parents("tr").find('#f_id').val();

  	var e = document.getElementById("class2");
  	var s=e.options[e.selectedIndex].value;
  	var f = document.getElementById("section");
  	var a=f.options[f.selectedIndex].value;
  	var t = document.getElementById("sem2");
  	var r=t.options[t.selectedIndex].value;


  	if(c_idv=="" || f_idv=="")
  	{
  		var temp=["demo"]; var i=1;
  		input.each(function(){
  			temp[i]=$(this).val();
  			i=i+1;
  		});
  		c_idv=temp[1];
  		f_idv=temp[3];  
  	}
  //var value2send = document.querySelector("#suggestions_id option[value='"+f_idv+"']").dataset.value;
  var  options = document.querySelectorAll('#suggestions option');
  for(var i = 0; i < options.length; i++) {
  	var option = options[i];

  	if(option.innerText === f_idv) {
  		var value2send = option.getAttribute('data-value');
  		break;
  	}
  }


  //alert(c_idv+" "+value2send);
  if(e.selectedIndex<=0 || f.selectedIndex<=0){
  	alert("Select Class and Section!");
  }
  else{

  	$.post(

  		'../db/allocateFaculty.php',
  		{
  			insert:1,
  			c_id:c_idv,
  			f_id:value2send,          
  			class:s,
  			section:a,
  			sem:r
  		},

  		function(result){
          //window.location.href="http://localhost/FacultyFeedbackSystem/courses.php";
          //alert("Allocated");
      }

      );

  	input.each(function(){
  		if(!$(this).val()){
  			$(this).addClass("error");
  			empty = true;
  		} else{
  			$(this).removeClass("error");
  		}
  	});
  	$(this).parents("tr").find(".error").first().focus();
  	if(!empty){
  		input.each(function(){
  			$(this).parent("td").html($(this).val());
  		});     
  		$(this).parents("tr").find("#add2, #edit2").toggle();
      //$("#addnew2").removeAttr("disabled");
  }   






}



});
  $(document).on("click", "#add3", function(){
  	var empty = false;
  	var input = $(this).parents("tr").find('input[type="text"]'); 
  	var q_idv=$(this).parents("tr").find('#q_id').val();
  	var ques=$(this).parents("tr").find('#question').val();

  	if(q_idv=="" || ques=="")
  	{
  		var temp=["demo"]; var i=1;
  		input.each(function(){
  			temp[i]=$(this).val();
  			i=i+1;
  		});
  		q_idv=temp[1];
  		ques=temp[2];  
  	}
  	var c = document.getElementById("courseCode").value;
  	var  options = document.querySelectorAll('#suggestions_courses option');
  	for(var i = 0; i < options.length; i++) {
  		var option = options[i];

  		if(option.innerText === c) {
  			var e = option.getAttribute('data-value');
  			break;
  		}
  	}

  	//alert(ques+" "+q_idv+" "+e);
  	$.post(

  		'../db/questions.php',
  		{
  			insert:1,
  			question:ques,
  			q_id:q_idv, 
  			courseCode:e         

  		},

  		function(result){
          //window.location.href="http://localhost/FacultyFeedbackSystem/courses.php";
          //alert("Questions added");
          $('#table456').append(result);
      }

      );

  	input.each(function(){
  		if(!$(this).val()){
  			$(this).addClass("error");
  			empty = true;
  		} else{
  			$(this).removeClass("error");
  		}
  	});
  	$(this).parents("tr").find(".error").first().focus();
  	if(!empty){
  		input.each(function(){
  			$(this).parent("td").html($(this).val());


  		});     
  		$(this).parents("tr").find("#add3, #edit3").toggle();
      //$("#addnew3").removeAttr("disabled");
  }   









});

  $(document).on("click", "#add31", function(){
  	var empty = false;
  	var input = $(this).parents("tr").find('input[type="text"]'); 
  	var option_num=$(this).parents("tr").find('#option_no').val();
  	var opt=$(this).parents("tr").find('#option').val();
  	var q_id=$(this).parents("table").attr("id");

  	if(option_num=="" || opt=="")
  	{
  		var temp=["demo"]; var i=1;
  		input.each(function(){
  			temp[i]=$(this).val();
  			i=i+1;
  		});
  		option_num=temp[1];
  		opt=temp[2];  
  	}
  	var c = document.getElementById("courseCode").value;
  	var  options = document.querySelectorAll('#suggestions_courses option');
  	for(var i = 0; i < options.length; i++) {
  		var option = options[i];

  		if(option.innerText === c) {
  			var e = option.getAttribute('data-value');
  			break;
  		}
  	}

  	//alert(opt+" "+option_num+" "+e+" "+q_id);
  	$.post(

  		'../db/options.php',
  		{
  			insert:1,
  			option:opt,
  			option_no:option_num, 
  			course_type:e ,
  			q_id:q_id       

  		},

  		function(result){
  			//alert("Option Added");
  		}

  		);

  	input.each(function(){
  		if(!$(this).val()){
  			$(this).addClass("error");
  			empty = true;
  		} else{
  			$(this).removeClass("error");
  		}
  	});
  	$(this).parents("tr").find(".error").first().focus();
  	if(!empty){
  		input.each(function(){
  			$(this).parent("td").html($(this).val());


  		});     
  		$(this).parents("tr").find("#add31, #edit31").toggle();
  	}   


  });



  $(document).on("click", "#add4", function(){
  	var empty = false;
  	var input = $(this).parents("tr").find('input[type="text"]'); 
  	var temp=["demo"]; var i=1;
  	input.each(function(){
  		temp[i]=$(this).val();
  		i=i+1;
  	});

  	var stu_roll_no=temp[1];
  	var stu_fname=temp[2];
  	var stu_mname=temp[3];
  	var stu_lname=temp[4];
  	var stu_email=temp[5];
  	var stu_password=temp[6];
  	var stu_class=temp[7];
  	var stu_sem=temp[8];
  	var stu_section=temp[9];
  	var stu_batch=temp[10];


  });




  $(document).on("click", "#add4", function(){
  	var empty = false;
  	var input = $(this).parents("tr").find('input[type="text"]'); 
  	var temp=["demo"]; var i=1;
  	input.each(function(){
  		temp[i]=$(this).val();
  		i=i+1;
  	});

  	var stu_roll_no=temp[1];
  	var stu_fname=temp[2];
  	var stu_mname=temp[3];
  	var stu_lname=temp[4];
  	var stu_email=temp[5];
  	var stu_password=temp[6];
  	var stu_class=temp[7];
  	var stu_sem=temp[8];
  	var stu_section=temp[9];
  	var stu_batch=temp[10];
  	var stu_electiveID=temp[11];
  	var stu_electiveBatchID=temp[12];



  	$.post(

  		'../db/updateStudent.php',
  		{
  			insert:1,
  			roll_no:stu_roll_no,
  			fname:stu_fname,
  			mname:stu_mname,
  			lname:stu_lname,
  			email:stu_email,
  			password:stu_password,
  			class:stu_class,
  			sem:stu_sem,
  			section:stu_section,
  			batch:stu_batch,
  			electiveID:stu_electiveID,
  			electiveBatchID:stu_electiveBatchID
  		},

  		function(result){

            //alert("Course Added");
        }

        );


  	input.each(function(){
  		$(this).parent("td").html($(this).val());


  	});     
  	$(this).parents("tr").find("#add4, #edit4").toggle();
      //$("#addnew4").removeAttr("disabled");



  });






  $(document).on("click", "#add5", function(){
  	var empty = false;
  	var input = $(this).parents("tr").find('input[type="text"]'); 
  	var temp=["demo"]; var i=1;
  	input.each(function(){
  		temp[i]=$(this).val();
  		i=i+1;
  	});

  	var f_id=temp[1];
  	var f_fname=temp[2];
  	var f_mname=temp[3];
  	var f_lname=temp[4];
  	var f_email=temp[5];
  	var f_password=temp[6];



  	$.post(

  		'../db/updateFaculty.php',
  		{
  			insert:1,
  			f_id:f_id,
  			fname:f_fname,
  			mname:f_mname,
  			lname:f_lname,
  			email:f_email,
  			password:f_password
  		},

  		function(result){

            //alert("Faculty Updated");
        }

        );


  	input.each(function(){
  		$(this).parent("td").html($(this).val());


  	});     
  	$(this).parents("tr").find("#add5, #edit5").toggle();


  });

  $(document).on("click", "#add6", function(){
  	var empty = false; var rn;
  	var input = $(this).parents("tr").find('input[type="text"]'); 
  	var i=1;
  	input.each(function(){
  		temp=$(this).val();
  		if(i==1){
  			rn=temp;
  		}
  		if(i>4){
  			var attn=$(this).val();
  			var c_id = $(this).parents("td").attr("id");



  			$.post(

  				'../db/updateAttendance.php',
  				{
  					course_code:c_id,
  					attendance:attn,
  					roll_no:rn
  				},

  				function(result){


  				}

  				);

  		}
  		i=i+1;

  	});





  	input.each(function(){
  		$(this).parent("td").html($(this).val());


  	});     
  	$(this).parents("tr").find("#add6, #edit6").toggle();

  });


    // Edit row on edit button click



    $(document).on("click", "#edit1", function(){ 


    	$(this).parents("tr").find("td:not(:last-child)").each(function(){
    		$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');

    	});   
    	$(this).parents("tr").find("#add1, #edit1").toggle();
   // $("#addnew1").attr("disabled", "disabled");
});

    $(document).on("click", "#editElective", function(){ 

    	$(this).parents("tr").find("td:not(:last-child)").each(function(){
    		if($(this).attr('id')=="f_id"){
    			$(this).html('<input type="text" list="suggestions" class="form-control" value="' + $(this).text() + '">');    		
    		}else{
    			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
    		}
    	}); 
    	$(this).parents("tr").find("#addElective, #editElective").toggle();
   // $("#addnew1").attr("disabled", "disabled");
});

    $(document).on("click", "#edit2", function(){ 


    	$(this).parents("tr").find("td:not(#act):not(:last-child)").each(function(){
    		if($(this).attr('id')=="f_id"){
    			if($(this).text()=="Not Assigned"){
    				$(this).html('<input type="text" list="suggestions" class="form-control">');
    			}
    			else{
    				$(this).html('<input type="text" list="suggestions" class="form-control" value="' + $(this).text() + '">');
    			}
    		}else{
    			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
    		}


    	});   
    	$(this).parents("tr").find("#add2, #edit2").toggle();

    });


    $(document).on("click", "#edit3", function(){ 


    	$(this).parents("tr").find("td:not(:last-child)").each(function(){
    		$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');

    	});   
    	$(this).parents("tr").find("#add3, #edit3").toggle();

    });

    $(document).on("click", "#edit31", function(){ 


    	$(this).parents("tr").find("td:not(:last-child)").each(function(){
    		$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');

    	});   
    	$(this).parents("tr").find("#add31, #edit31").toggle();

    });

    $(document).on("click", "#edit4", function(){ 

    	var temp=[];

    	temp[0]='<input type="text" class="form-control" name="stu_roll_no" id="stu_roll_no"';
    	temp[1]='<input type="text" class="form-control" name="stu_fname" id="stu_fname"';
    	temp[2]='<input type="text" class="form-control" name="stu_mname" id="stu_mname"';
    	temp[3]='<input type="text" class="form-control" name="stu_lname" id="stu_lname"';
    	temp[4]='<input type="text" class="form-control" name="stu_email" id="stu_email"';
    	temp[5]='<input type="text" class="form-control" name="stu_password"id="stu_password"';
    	temp[6]='<input type="text" class="form-control" name="stu_class" id="stu_class"';
    	temp[7]='<input type="text" class="form-control" name="stu_sem" id="stu_sem"';
    	temp[8]='<input type="text" class="form-control" name="stu_section"  id="stu_section"';
    	temp[9]='<input type="text" class="form-control" name="stu_batch" id="stu_batch"';    
    	temp[10]='<input type="text" class="form-control" name="stu_electiveID" id="stu_electiveID"';    
    	temp[11]='<input type="text" class="form-control" name="stu_electiveBatchID" id="stu_electiveBatchID"';     

    	var i=0;
    	$(this).parents("tr").find("td:not(:last-child)").each(function(){
    		$(this).html(temp[i]+'value="' + $(this).text() + '">');
    		i=i+1;

    	});   
    	$(this).parents("tr").find("#add4, #edit4").toggle();
   // $("#addnew4").attr("disabled", "disabled");
});

    $(document).on("click", "#edit5", function(){ 

    	var temp=[];

    	temp[0]='<input type="text" class="form-control" name="f_id" id="f_id"';
    	temp[1]='<input type="text" class="form-control" name="f_fname" id="f_fname"';
    	temp[2]='<input type="text" class="form-control" name="f_mname" id="f_mname"';
    	temp[3]='<input type="text" class="form-control" name="f_lname" id="f_lname"';
    	temp[4]='<input type="text" class="form-control" name="f_email" id="f_email"';
    	temp[5]='<input type="text" class="form-control" name="f_password"id="f_password"';


    	var i=0;
    	$(this).parents("tr").find("td:not(:last-child)").each(function(){
    		$(this).html(temp[i]+'value="' + $(this).text() + '">');
    		i=i+1;

    	});   
    	$(this).parents("tr").find("#add5, #edit5").toggle();
    //$("#addnew5").attr("disabled", "disabled");
});

    $(document).on("click", "#edit6", function(){ 


    	$(this).parents("tr").find("td:not(:last-child)").each(function(){
    		$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');

    	});   
    	$(this).parents("tr").find("#add6, #edit6").toggle();

    });
  // Delete row on delete button click
  $(document).on("click", "#delete1", function(){
       //var parent = $(this).parent('tr'); 
               // var c = parent.children('td')[0].innerHTML;
               var c = $(this).parents("tr").find("#c_id").html();    


               $.post(

               	'../db/courses.php',
               	{
               		delete:1,
               		c_id:c
               	},

               	function(result){

            //alert("Course Deleted");
        }

        );
               $(this).parents("tr").remove();
    //$("#addnew1").removeAttr("disabled");
});


  $(document).on("click", "#deleteElective", function(){

  	var c = $(this).parents("tr").find("#electiveID").html();    


  	$.post(

  		'../db/electives.php',
  		{
  			delete:1,
  			electiveID:c
  		},

  		function(result){

  			//alert("Elective Deleted");
  		}

  		);
  	$(this).parents("tr").remove();
    //$("#addnew1").removeAttr("disabled");
});

  $(document).on("click", "#delete2", function(){
  	var e = document.getElementById("class2");
  	var s=e.options[e.selectedIndex].value;
  	var f = document.getElementById("section");
  	var a=f.options[f.selectedIndex].value;
  	var t = document.getElementById("sem2");
  	var r=t.options[t.selectedIndex].value;
  	var c = $(this).parents("tr").find("#c_id").html(); 
  	var d = $(this).parents("tr").find("#f_id").html();  


  	var  options = document.querySelectorAll('#suggestions option');
  	for(var i = 0; i < options.length; i++) {
  		var option = options[i];

  		if(option.innerText === d) {
  			var value2send = option.getAttribute('data-value');
  			break;
  		}
  	}  


  	$.post(

  		'../db/allocateFaculty.php',
  		{
  			delete:1,
  			c_id:c,
  			f_id:value2send,
  			class:s,
  			section:a,
  			sem:r
  		},

  		function(result){

  			//alert("Deleted Allocation");
  		}

  		);
  	//var spannedTD = $(this).parents("tr").find("#f_id").next();
  	var lala = $("#2").find("td[id="+c+"]").attr("rowSpan");
  	$("#2").find("td[id="+c+"]").attr("rowSpan",parseInt(lala)-1);
  	//alert($(spannedTD).attr("rowSpan"));
  	//alert(lala);
  	$(this).parents("tr").remove();
  	var temp=document.getElementById("2")
  	if(temp){
  		temp.parentNode.removeChild(temp);
  	}
  	var e = document.getElementById("class2");
  	var s=e.options[e.selectedIndex].value;
  	var f = document.getElementById("section");
  	var a=f.options[f.selectedIndex].value;
  	var t = document.getElementById("sem2");
  	var r=t.options[t.selectedIndex].value;

  	if(e.selectedIndex<=0 || f.selectedIndex<=0){
  		alert("Select section and class!");
  	}
  	else{
  		$.post(
  			'../db/fillAllocateFacultyTable.php',
  			{
  				table2:1,
  				section:a,
  				class:s,
  				sem:r
  			},

  			function(result){
  				$('#table123').append(result);
  				//alert("Posted");
  			}

  			);

  	}

    //$("#addnew2").removeAttr("disabled");
});

  $(document).on("click", "#delete3", function(){
       //var parent = $(this).parent('tr'); 
               // var c = parent.children('td')[0].innerHTML;
               var q = $(this).parents("tr").find("#q_id").html();    

               var c = document.getElementById("courseCode").value;
               var  options = document.querySelectorAll('#suggestions_courses option');
               for(var i = 0; i < options.length; i++) {
               	var option = options[i];

               	if(option.innerText === c) {
               		var e = option.getAttribute('data-value');
               		break;
               	}
               }
               $.post(

               	'../db/questions.php',
               	{
               		delete:1,
               		q_id:q,
               		course_type:e
               	},

               	function(result){

               		//alert("Question Deleted");
               	}

               	);
               $(this).parents("tr").remove();
               var id="#"+q;
               $(id+" tr").each(function(i,row) {
               	if(i==0)
               		return;
               	var d=$(this).find("#option_no").html();
               	//alert(q+" "+d+" "+e);
               	$.post(

               		'../db/options.php',
               		{
               			delete:1,
               			q_id:q,
               			option_no:d,
               			course_type:e
               		},

               		function(result){

               			//alert("Option Deleted");
               		}

               		);
               	$(this).remove();



               	i++;
               });

               $(id).remove();


           });


  $(document).on("click", "#delete31", function(){


  	var q = $(this).parents("table").attr('id');    
  	var d = $(this).parents("tr").find("#option_no").html();
  	var c = document.getElementById("courseCode").value;
  	var  options = document.querySelectorAll('#suggestions_courses option');
  	for(var i = 0; i < options.length; i++) {
  		var option = options[i];

  		if(option.innerText === c) {
  			var e = option.getAttribute('data-value');
  			break;
  		}
  	}
  	//alert(q+" "+d+" "+e);
  	$.post(

  		'../db/options.php',
  		{
  			delete:1,
  			q_id:q,
  			option_no:d,
  			course_type:e
  		},

  		function(result){

  			//alert("Option Deleted");
  		}

  		);
  	$(this).parents("tr").remove();
    //$("#addnew3").removeAttr("disabled");
});



  $(document).on("click", "#delete4", function(){
       //var parent = $(this).parent('tr'); 
               // var c = parent.children('td')[0].innerHTML;
               var c = $(this).parents("tr").find("#stu_roll_no").html();    


               $.post(

               	'../db/deleteStudent.php',
               	{
               		delete:1,
               		roll_no:c
               	},

               	function(result){

               		//alert("Student Removed");
               	}

               	);
               $(this).parents("tr").remove();
   // $("#addnew4").removeAttr("disabled");
});


  $(document).on("click", "#delete5", function(){
       //var parent = $(this).parent('tr'); 
               // var c = parent.children('td')[0].innerHTML;
               var c = $(this).parents("tr").find("#f_id").html();    


               $.post(

               	'../db/deleteFaculty.php',
               	{
               		delete:1,
               		f_id:c
               	},

               	function(result){

               		//alert("Faculty Removed");
               	}

               	);
               $(this).parents("tr").remove();
    //$("#addnew5").removeAttr("disabled");
});



});
function openLogout(){
	var div=document.getElementById("dropdown-content");
	if(div.style.display=="block"){
		div.style.display="none";
	}else{
		div.style.display="block";
	}
}

</script>

</head>

<body> 



	<datalist id="suggestions">
		<?php
		$sql="SELECT fname,lname,f_id from faculty";
		$res=$conn->query($sql);
		while($r=$res->fetch_assoc()):
			?>
			<option data-value=<?= $r["f_id"] ?>><?php echo $r["fname"]." ".$r['lname']; ?></option>
		<?php endwhile; ?>

	</datalist>
	<datalist id="suggestions_courses">

		<option data-value="TH">Theory</option>
		<option data-value="L">Lab</option>

	</datalist>


 <!-- <h1 id="h1"> K.J SOMAIYA COLLEGE OF ENGINEERING</h1>
  <h2 id="h2">FACULTY FEEDBACK SYSTEM - DEPARTMENT COORDINATOR DASHBOARD</h2>
  Outer Div starts-->
  <a href="#" class="pull-left visible-md visible-lg">
  	<img id="logo" src="../images/logo.png">
  </a>
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

  <!-- <script type="text/javascript">

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
  		<!--<a id="home" onclick="openNav()" ><i>&#8594;</i></a>-->
  		<a title="Home" href="#" onclick="openHome()"><i class="fa fa-home"></i></a>  
  		<a title="Feedback State"href="#" onclick="openState()"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i></a>
  		<a title="Edit Courses"href="#" onclick="openEditCourses()"><i class="fa fa-book" aria-hidden="true"></i></a>
  		<a title="Edit Electives/ IDC"href="#" onclick="openElectives()"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
		<a title="Assign IDC to Students"href="#" onclick="openIDCToStudents()"><i class="fa fa-plus" aria-hidden="true"></i></a>
  		<a title="Allocate Faculty"href="#" onclick="openAllocateFaculty()"><i class="fa fa-users"></i></a> 
  		<a title="Report"href="#" onclick="openReport()"><i class="fa fa-download" aria-hidden="true"></i></i></a>
  		<a title="Student Status"href="#" onclick="openStudentStatus()"><i class="fa fa-envelope-o" aria-hidden="true"></i></i></a>
  		<a title="Edit Questions"href="#" onclick="openAddQues()"><i class="fa fa-question" aria-hidden="true"></i></i></a>
  		<a title="Edit Student"href="#" onclick="openAddStudent()"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
  		<a title="Edit Faculty"href="#" onclick="openAddFaculty()"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
  		<a title="Logout" href="#" onclick="signOut()"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
  		<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
  	</div>

  </div>
  <div class="container" id="expanded">
  	<div class="icon-bar" id="expandedinside">
  		<!--<a class="a"id="home" onclick="closeNav()"><i>&#8592;</i></a>-->    
  		<a  class="a" onclick="openHome()" href="#"><span class="fa fa-home" style="margin-right: 10px"></span><span style="font-size: 20px;">Home</span></a>
  		<a  class="a" onclick="openState()" href="#"><span class="fa fa-caret-square-o-right" style="margin-right: 10px"></span><span style="font-size: 20px;">Status</span></a> 
  		<a  class="a" onclick="openEditCourses()" href="#"><span class="fa fa-book" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">Edit Courses</span></a>
  		<a  class="a" onclick="openElectives()" href="#"><span class="fa fa-file-text-o" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">Edit Electives/ IDC</span></a>
		<a  class="a" onclick="openIDCToStudents()" href="#"><span class="fa fa-plus" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">IDC->Student</span></a>
  		<a  class="a" onclick="openAllocateFaculty()" href="#"><span class="fa fa-users" style="margin-right: 10px"></span><span style="font-size: 20px;">Allocate Faculty</span></a>
  		<a  class="a" onclick="openReport()" href="#"><span class="fa fa-download" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">Report</span></a>
  		<a  class="a" onclick="openStudentStatus()" href="#"><span class="fa fa-envelope-o" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">Student Status</span></a>
  		<a  class="a" onclick="openAddQues()" href="#"><span class="fa fa-question" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">Edit Questions</span></a>
  		<a  class="a" onclick="openAddStudent()" href="#"><span class="fa fa-graduation-cap" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">Edit Student</span></a>
  		<a  class="a" onclick="openAddFaculty()" href="#"><span class="fa fa-user-plus" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">Edit Faculty</span></a>
  		<a  class="a" onclick="signOut()" href="#"><span class="fa fa-sign-out" aria-hidden="true" style="margin-right: 10px"></span><span style="font-size: 20px;">Logout</span></a>
  		<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

  	</div>

  </div>
  <script type="text/javascript">
  	var f;
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
  	function openStudentStatus(){
  		var div = document.getElementById('content1');
  		if (div.style.display == 'block') {
  			$("#table3").empty();
  			div.style.display = 'none';
  		}
  		else {
  			$("#main").children().not(div).css("display","none");
  			div.style.display = 'block';
  			


  		}

  		closeNav();
  	}


  	// function mailStudent(){
  	// 	$("#myTable2 input:checkbox[name=myMail2]").each(function(){
  	// 		if($(this). prop("checked") == true){
  	// 			var temp = $(this).parents("tr").find('#roll_no').text(); 
  	// 			$.post(
  	// 				'../db/reminderMail.php',
  	// 				{
  	// 					roll_no:temp,
  	// 					mailReminder:1
  	// 				},

  	// 				function(result){


  	// 				}

  	// 				);
  	// 		}
  	// 	}
  	// 	);
  	// 	alert("Reminder Mailed");


  	// }
  	function mailStudent(){
  		var msg = document.getElementById("mail_message").rows[0].cells[0].innerHTML;
	var cc = document.getElementById("get_cc").rows[0].cells[0].innerHTML;//get comma separated emailid
	var temp = [];
	$("#myTable2 input:checkbox[name=myMail2]").each(function(){
		if($(this). prop("checked") == true){
			temp.push($(this).parents("tr").find('#mail_id').text());
			
		}
	}
	);
	var t = temp.toString();
	$.post(
		'../db/reminderMail.php',
		{
			mails:t,
			CC:cc,
			message:msg,
			mailReminder:1
		},

		function(result){


		}

		);
	alert("Reminder Mailed");
}
function openHome(){
	$("#main").children().css("display","none");
	closeNav();

}

function openSummaryReport(){
	var div = document.getElementById('summary_rep');


	if (div.style.display == 'block') {
		var temp=document.getElementById("7_")
		if(temp){
			temp.style.display="none";
		}
		div.style.display = 'none';
		// $("#sum_year").val($("#sum_year option:first").val());
		// $("#sum_sem").val($("#sum_sem option:first").val());
	}
	else {

		$("#main").children().not(div).css("display","none");
		var temp=document.getElementById("7_")
		if(temp){
			temp.style.display="none";
		}
		// $("#sum_year").val($("#sum_year option:first").val());
		// $("#sum_sem").val($("#sum_sem option:first").val());
		div.style.display = 'block';
	}
	closeNav();
}

function openSemCourseReport(){
	var div = document.getElementById('semwise_course_rep');


	if (div.style.display == 'block') {
		var temp=document.getElementById("6")
		if(temp){
			temp.style.display="none";
		}
		div.style.display = 'none';
		// $("#sum_year").val($("#sum_year option:first").val());
		// $("#sum_sem").val($("#sum_sem option:first").val());
	}
	else {

		$("#main").children().not(div).css("display","none");
		var temp=document.getElementById("6")
		if(temp){
			temp.style.display="none";
		}
		// $("#sum_year").val($("#sum_year option:first").val());
		// $("#sum_sem").val($("#sum_sem option:first").val());
		div.style.display = 'block';
	}
	closeNav();
}

function openReport(){
	
	var div = document.getElementById('content');
	var btn = document.getElementById('pdf');
	if (div.style.display == 'block') {
		$("#table2").empty();
		div.style.display = 'none';
	}
	else {
		$("#main").children().not(div).css("display","none");
		div.style.display = 'block';
		$("#table2").empty();

		$.post(
			'../db/calculateScore.php',
			{

			},

			function(result){

				$('#table2').append(result);

			}

			);
		$.post(
			'../db/generateReport.php',
			{
				saveAll:1

			},

			function(result){


			}
			);
	}
	closeNav();
}

$(document).on("click", "#view_summary_report", function(){
	$("#back_report").css("display","block");
});
$(document).on("click", "#view_sem_course_report", function(){
	$("#back_semwise_report").css("display","block");
});

// view_sem_course_report
$(document).on("click", "#summary_report", function(){

	$("#table2").empty();
	$("#back").css("display","none");

	$.post(
		'../db/calculateScore.php',
		{
			f_id:f
		},

		function(result){

			$('#table2').append(result);

		}

		);

});



$(document).on("click", "#viewReport", function(){
	var temp = $(this).parents("tr").find('#f_id').text(); 
	$("#view_summary_report").css("display","none");
	$("#view_sem_course_report").css("display","none");
	$("#back").css("display","block");

	$("#table2").empty();



	$.post(
		'../db/viewReport.php',
		{
			f_id:temp
		},

		function(result){
			$('#table2').append(result);

		}

		);



});


$(document).on("click", "#back", function(){

	$("#table2").empty();
	$("#back").css("display","none");
	$("#view_summary_report").css("display","inline");
	$("#view_sem_course_report").css("display","inline");
	

	$.post(
		'../db/calculateScore.php',
		{
			f_id:f
		},

		function(result){

			$('#table2').append(result);

		}

		);

});



$(document).on("click", "#downloadReport", function(){
	var temp = $(this).parents("tr").find('#f_id').text(); 


	var printWindow = window.open( "../db/test.php?f_id="+temp, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
	printWindow.addEventListener('load', function(){

		printWindow.print();
		setTimeout(function () { printWindow.close(); }, 100);
	//printWindow.onfocus=function(){ printWindow.close();}
  	//printWindow.close();
  }, true);




});



function openEditCourses(){
	var div = document.getElementById('Courses');

	if (div.style.display == 'block') {
		var temp=document.getElementById("1")
		if(temp){
			temp.style.display="none";
		}
		div.style.display = 'none';

		$("#sem").val($("#sem option:first").val());
		$("#class").val($("#acadyear option:first").val());

	}
	else {
		$("#main").children().not(div).css("display","none");
		var temp=document.getElementById("1")
		if(temp){
			temp.style.display="none";
		}

		$("#sem").val($("#sem option:first").val());
		$("#class").val($("#class option:first").val());
		div.style.display = 'block';
	}
	closeNav();
}


function openElectives(){
	var div = document.getElementById('Electives');

	if (div.style.display == 'block') {
		document.getElementById("tableElective").innerHTML="";
		
		div.style.display = 'none';

	}
	else {
		$("#main").children().not(div).css("display","none");
		

		div.style.display = 'block';


		$.post(
			'../db/fillElectivesTable.php',
			{
				tableElective:1,

			},

			function(result){
				document.getElementById("tableElective").innerHTML=(result);

			}

			);



	}
	closeNav();
}

function openAllocateFaculty(){
	var div = document.getElementById('allocateFaculty');

	if (div.style.display == 'block') {
		var temp=document.getElementById("2")
		if(temp){
			temp.style.display="none";
		}
		div.style.display = 'none';
		$("#sem2").val($("#sem2 option:first").val());
		$("#class2").val($("#class2 option:first").val());
		$("#section").val($("#section option:first").val());
	}
	else {

		$("#main").children().not(div).css("display","none");
		var temp=document.getElementById("2")
		if(temp){
			temp.style.display="none";
		}
		$("#class2").val($("#class2 option:first").val());
		$("#section").val($("#section option:first").val());
		$("#sem2").val($("#sem2 option:first").val());
		div.style.display = 'block';
	}
	closeNav();
}

function openAddQues(){
	var div = document.getElementById('Questions');

	if (div.style.display == 'block') {
		var temp=document.getElementById("1")
		if(temp){
			temp.style.display="none";
		}
		div.style.display = 'none';

		$("#courseCode").val($("#courseCode option:first").val());

	}
	else {
		$("#main").children().not(div).css("display","none");
		div.style.display = 'block';
	}
	closeNav();
}
function openIDCToStudents(){
	var div = document.getElementById('IDCToStudent');

	if (div.style.display == 'block') {
		
		div.style.display = 'none';

	}
	else {
		$("#main").children().not(div).css("display","none");
		div.style.display = 'block';
	}
	closeNav();
}
function openAddStudent(){
	var div = document.getElementById('Student');

	if (div.style.display == 'block') {
		$("#table211").empty();
		div.style.display = 'none';
	}
	else {
		$("#main").children().not(div).css("display","none");

		div.style.display = 'block';

	}
	closeNav();
}


function openAddFaculty(){
	var div = document.getElementById('Faculty');

	if (div.style.display == 'block') {
		$("#table212").empty();
		div.style.display = 'none';

	}
	else {
		$("#main").children().not(div).css("display","none");
		$("#table212").empty();
		div.style.display = 'block';   

		var temp=document.getElementById("faculty_5")
		if(temp){
			temp.parentNode.removeChild(temp);
		}
		$.post(
			'../db/showFaculty.php',
			{
				table5:1,
			},
			function(result){

				$('#table212').append(result);

			}
			);




	}
	closeNav();
}

function openState(){
	var div = document.getElementById('state');

	if (div.style.display == 'block') {
		div.style.display = 'none';
	}
	else {
		$("#main").children().not(div).css("display","none");

		$.post(
			'../db/status.php',
			{
				showstatus:1
			},

			function(result){

				document.getElementById("message").innerHTML=result;

			}
			);
		div.style.display = 'block';
	}
	closeNav();
}

function downloadAll(){

	window.location.href="../db/download.php";
}

function saveSummary(){

	var temp=[]; var i=0;
	$('#myTable tr').each(function(row, tr){
		temp[i]=$(tr).find('td:eq(0)').text();
		i++;
		temp[i]=$(tr).find('td:eq(1)').text();
		i++;
		temp[i]=$(tr).find('td:eq(2)').text();
		i++;

	});

	$.post(
		'../db/generateReport.php',
		{
			arr:temp,
			summary:1

		},

		function(result){

			//alert("Downloading Summary");
			window.location.href="../db/downloadSummary.php";
		}
		);


}
function mail(){
	$("#myTable input:checkbox[name=myMail]").each(function(){
		if($(this). prop("checked") == true){
			var temp = $(this).parents("tr").find('#f_id').text(); 
			$.post(
				'../db/generateReport.php',
				{
					f_id:temp,
					mail:1
				},

				function(result){


				}

				);
		}
	}
	);
	alert("Reports Mailed");

}

</script>

<!--outer division starts-->
<div id="outer">

	<!--main div starts--> 
	<div id="main" style=" width: 80vw; margin-left: 5vw;">
		<!--content div starts--> 
		<div id="content" class="content">
			<br>
			<button  id="back" style="display: none;" class="btn btn-success">Back</button>

			<button id="view_summary_report" class="btn btn-success" onclick="openSummaryReport()">View Summary Report</button>
			<button id="view_sem_course_report" class="btn btn-success" onclick="openSemCourseReport()">View Sem-Wise All Courses Feedback</button>
			<br><br>
			<br>
			<br>
			<div  id="table2">
			</div>


   <!-- <button  id="summary" style="margin-left: 250px;" onclick="saveSummary()" class="btn btn-success">Download Report Summary</button>
    <button  id="saveAndMail" style="float: right;" onclick="mail()" class="btn btn-success">Mail selected Reports </button>

    <button  id="downloadAll" style="float: left;" onclick="downloadAll()" class="btn btn-success">Download all Reports </button>

-->

</div>
<!--content div ends--> 

<?php 
$sql = "SELECT sem_type from current_state where dept_id='$dept_id'";
$res = $conn->query($sql);                     
while($r=$res->fetch_assoc()){ 
  $sem_type=$r['sem_type'];
}
 ?>


<!-- summary report -->
<div id="summary_rep" style="display: none;">
	<div class="table-wrapper" id="table_summary">
		<div class="table-title">
			<div class="row">
				<button  id="back_report" style="display: none;" class="btn btn-success" onclick="openReport()">Back</button>

				<div class="col-sm-8"><h2><b>Select year and semester</b></h2></div>
				<div class="col-sm-4">
					<!-- <button id="addnew2"type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button> -->
				</div>
			</div>
			
		</div>
		<br>
		<b><label>Year </label>
		<select id = "sum_year" class="select_class2">
			<option value="">Year</option>
			<option value="2019-2020">2019-2020</option>
			<option value="2020-2021">2020-2021</option>
			<option value="2021-2022">2021-2022</option>
			<option value="2022-2023">2022-2023</option>
			<option value="2023-2024">2023-2024</option>
			<option value="2024-2025">2024-2025</option>
			<option value="2025-2026">2025-2026</option>
			<option value="2026-2027">2026-2027</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp; 
		<label>Sem:&nbsp;&nbsp;Odd</label>
		<input type="radio" name="chooseSem" value="Odd" id="semOdd">&nbsp;&nbsp;<label>Even</label>
		<input type="radio" name="chooseSem" value="Even" id="semEven">&nbsp;&nbsp;<label>Both</label>
		<input type="radio" name="chooseSem" value="Both" id="semBoth">
		<!-- <select id="sum_sem" class="select_class2">
			<option value="">Sem</option>
			<option value="Odd">Odd</option>
			<option value="Even">Even</option>
		</select> -->
		</b>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<button id="getSummaryReport">Get Data</button>
		<div id="sum_table"></div>
	</div>
</div> 
<script type="text/javascript">
		$('#getSummaryReport').click(function(){
			var notSel;
			var s_y = document.getElementById("sum_year");
			var s=s_y.options[s_y.selectedIndex].value;
			if(document.getElementById("semOdd").checked){
				var a = "Odd";notSel = false;}else if(document.getElementById("semEven").checked){var a = "Even";notSel = false;}else if(document.getElementById("semBoth").checked){var a = "Both";notSel = false;}else{
				notSel = true;
			}
			// var s_s = document.getElementById("sum_sem");
			// var a=s_s.options[s_s.selectedIndex].value;

			if(s_y.selectedIndex<1 || notSel==true){
				alert("Select Year and Semester!");
			}
			else{
				$("#sum_table").empty();

				$.post(
					'../db/getSummaryReport2.php',
					{
						year:s,
						sem:a
					},

					function(result){

						$('#sum_table').append(result);

					}

					);
				
			}
		});
</script>

<!-- semester wise all courses report -->
<div id="semwise_course_rep" style="display: none;">
	<div class="table-wrapper" id="table_summary">
		<div class="table-title">
			<div class="row">
				<button  id="back_semwise_report" style="display: none;" class="btn btn-success" onclick="openReport()">Back</button>

				<div class="col-sm-8"><h2><b>Select year and semester</b></h2></div>
				<div class="col-sm-4">
					<!-- <button id="addnew2"type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button> -->
				</div>
			</div>
			
		</div>
		<br>
		<b><label>Year </label>
		<select id = "swac_year" class="select_class2">
			<option value="">Year</option>
			<option value="2019-2020">2019-2020</option>
			<option value="2020-2021">2020-2021</option>
			<option value="2021-2022">2021-2022</option>
			<option value="2022-2023">2022-2023</option>
			<option value="2023-2024">2023-2024</option>
			<option value="2024-2025">2024-2025</option>
			<option value="2025-2026">2025-2026</option>
			<option value="2026-2027">2026-2027</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp; 
		<label>Class </label>
		<select id = "swac_class" class="select_class2">
			<option value="">Year</option>
			<option value="FY">FY</option>
			<option value="SY">SY</option>
			<option value="TY">TY</option>
			<option value="LY">LY</option>
			<option value="MTech">MTech</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp; 
		<label>Sem </label>
		<select id="swac_sem" class="select_class2">
			<option value="">Sem</option>
			<option value="1" style="display:none;" id="1">1</option>
			<option value="2" style="display:none;" id="2">2</option>
			<option value="3" style="display:none;" id="3">3</option>
			<option value="4" style="display:none;" id="4">4</option>
			<option value="5" style="display:none;" id="5">5</option>
			<option value="6" style="display:none;" id="6">6</option>
			<option value="7" style="display:none;" id="7">7</option>
			<option value="8" style="display:none;" id="8">8</option>
		</select>
		</b>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<script type="text/javascript">
			$('#swac_class').change(function(){
				document.getElementById('1').style.display = 'none';
				document.getElementById('2').style.display = 'none';
				document.getElementById('3').style.display = 'none';
				document.getElementById('4').style.display = 'none';
				document.getElementById('5').style.display = 'none';
				document.getElementById('6').style.display = 'none';
				document.getElementById('7').style.display = 'none';
				document.getElementById('8').style.display = 'none';
				var swac_c = document.getElementById("swac_class");
				var c=swac_c.options[swac_c.selectedIndex].value;
				if(c=='FY'){
					document.getElementById('1').style.display = 'block';
					document.getElementById('2').style.display = 'block';
				}else if(c=='SY'){
					document.getElementById('3').style.display = 'block';
					document.getElementById('4').style.display = 'block';
				}else if(c=='TY'){
					document.getElementById('5').style.display = 'block';
					document.getElementById('6').style.display = 'block';
				}else if(c=='LY'){
					document.getElementById('7').style.display = 'block';
					document.getElementById('8').style.display = 'block';
				}else{
					document.getElementById('1').style.display = 'block';
					document.getElementById('2').style.display = 'block';
					document.getElementById('3').style.display = 'block';
					document.getElementById('4').style.display = 'block';
				}
			});
		</script>
		<button id="getSemwiseCourseReport" style="background:#A52A2A;color: white; font-size: 16px;padding: 8px 8px;padding-top: 4px;padding-bottom: 4px;text-align: center;margin: 4px 2px;border-radius: 10px;">Get Data</button>
		<div id="swac_table"></div>
	</div>
</div> 
<script type="text/javascript">
		$('#getSemwiseCourseReport').click(function(){

			var swac_y = document.getElementById("swac_year");
			var s=swac_y.options[swac_y.selectedIndex].value;
			var swac_s = document.getElementById("swac_sem");
			var a=swac_s.options[swac_s.selectedIndex].value;

			if(swac_y.selectedIndex<0 || swac_s.selectedIndex<0){
				alert("Select Year and Semester!");
			}
			else{
				$("#swac_table").empty();

				$.post(
					'../db/getSemwiseAllCoursesReport.php',
					{
						year:s,
						sem:a
					},

					function(result){

						$('#swac_table').append(result);

					}

					);
				
			}
		});
</script>


<!--content1 div starts-->

<div id="content1" class="content1">
	<br>
	
	<br>
	<p><b>
		<select id="classOfReminderStudent">
			<option disabled selected value value="base">Choose Class</option>
			<option value="FY_A" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group A</option>
			<option value="FY_B" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group B</option>
			<option value="SY" <?php if($dept_id==6){ ?> hidden <?php } ?>>SY</option>
			<option value="TY" <?php if($dept_id==6){ ?> hidden <?php } ?>>TY</option>
			<option value="LY" <?php if($dept_id==6){ ?> hidden <?php } ?>>LY</option>
			<option value="MTech Comp" <?php if($dept_id!=1){ ?> hidden <?php } ?>>MTech Comp</option>
			<option value="MTech IT" <?php if($dept_id!=2){ ?> hidden <?php } ?>>MTech IT</option>
			<option value="MTech ETRX" <?php if($dept_id!=3){ ?> hidden <?php } ?>>MTech ETRX</option>
			<option value="MTech EXTC" <?php if($dept_id!=4){ ?> hidden <?php } ?>>MTech EXTC</option>
			<option value="MTech Mech" <?php if($dept_id!=5){ ?> hidden <?php } ?>>MTech Mech</option>
		</select>
		<select id="sectionOFReminderStudent">
			<option disabled selected value value="base">Choose Section</option>
			<option value="All">All</option>
			<option value="A" >A</option>
			<option value="B" >B</option>
			<option value="C" <?php if($dept_id!=6){ ?> hidden <?php } ?>>C</option>
			<option value="D" <?php if($dept_id!=6){ ?> hidden <?php } ?>>D</option>
			<option value="E" <?php if($dept_id!=6){ ?> hidden <?php } ?>>E</option>
			<option value="F" <?php if($dept_id!=6){ ?> hidden <?php } ?>>F</option>
			<option value="G" <?php if($dept_id!=6){ ?> hidden <?php } ?>>G</option>
			<option value="H" <?php if($dept_id!=6){ ?> hidden <?php } ?>>H</option>
			<option value="I" <?php if($dept_id!=6){ ?> hidden <?php } ?>>I</option>
			<option value="J" <?php if($dept_id!=6){ ?> hidden <?php } ?>>J</option>										
		</select>
	</b>
	<button id="getDataOfReminderStudent">Get Data</button>
	<script type="text/javascript">
		$('#getDataOfReminderStudent').click(function(){


			var e = document.getElementById("classOfReminderStudent");
			var s=e.options[e.selectedIndex].value;
			var f = document.getElementById("sectionOFReminderStudent");
			var a=f.options[f.selectedIndex].value;

			if(e.selectedIndex<=0 || f.selectedIndex<=0){
				alert("Select section and class!");
			}
			else{
				$("#table3").empty();

				$.post(
					'../db/checkStudentStatus.php',
					{
						class:s,
						section:a
					},

					function(result){

						$('#table3').append(result);

					}

					);
				
			}
		});

	</script>
	<br><br>
	<div  id="table3">
	</div>
	<br><br>
	<button  id="saveAndMail" onclick="mailStudent()" class="btn btn-success">Mail selected Students</button>
</div>
<!--content1 div ends-->
<!--state div starts-->
<div id="state">
	<br><br>
	<p><b id="message"></b></p><br><br>

	<script type="text/javascript">

		function setEndTime(){

			if(confirm("Are you sure about setting the end time of Feedback?")){
				var end_year=document.getElementById("end_year").value;
				var end_month=document.getElementById("end_month").value;
				var end_day=document.getElementById("end_day").value;
				var end_hour=document.getElementById("end_hour").value;
				var end_minute=document.getElementById("end_minute").value;
				var end_second=document.getElementById("end_second").value;

				$.post(
					'../db/status.php',
					{
						changeEndTime:1,
						end_time:end_year+"-"+end_month+"-"+end_day+"  "+end_hour+":"+end_minute+":"+end_second
					},

					function(result){

						document.getElementById("message").innerHTML=result;

					}
					);
			}

		}
		function setStartTime(){

			if(confirm("Are you sure about setting the start time of Feedback?")){
				var start_year=document.getElementById("start_year").value;
				var start_month=document.getElementById("start_month").value;
				var start_day=document.getElementById("start_day").value;
				var start_hour=document.getElementById("start_hour").value;
				var start_minute=document.getElementById("start_minute").value;
				var start_second=document.getElementById("start_second").value;
				$.post(
					'../db/status.php',
					{
						changeStartTime:1,
						start_time:start_year+"-"+start_month+"-"+start_day+"  "+start_hour+":"+start_minute+":"+start_second

					},

					function(result){

						document.getElementById("message").innerHTML=result;

					}
					);
			}

		}
		function changeStatus(){

			if(confirm("Are you sure about changing the period of Feedback?")){
				$.post(
					'../db/status.php',
					{
						changestatus:1
					},

					function(result){

						document.getElementById("message").innerHTML=result;

					}
					);
			}

		}
		function changeAcadYear(){

			if(confirm("Are you sure about changing the academic year?")){
				var acadyear=document.getElementById("acad_year").value;
				$.post(
					'../db/status.php',
					{
						changeAcadYear:1,
						acad_year:acadyear
					},

					function(result){

						document.getElementById("message").innerHTML=result;

					}
					);
			}

		}
		function changeSemType(){

			if(confirm("Are you sure about changing the semester type?")){
				$.post(
					'../db/status.php',
					{
						changeSemType:1
					},

					function(result){

						document.getElementById("message").innerHTML=result;

					}
					);
			}
		}

		function saveChanges(){
			if(confirm("Are you sure about saving the changes?")){

				var endyear=document.getElementById("end_year").value;
				var endmonth=document.getElementById("end_month").value;
				var endday=document.getElementById("end_day").value;
				var endhour=document.getElementById("end_hour").value;
				var endminute=document.getElementById("end_minute").value;
				var endsecond=document.getElementById("end_second").value;

				var startyear=document.getElementById("start_year").value;
				var startmonth=document.getElementById("start_month").value;
				var startday=document.getElementById("start_day").value;
				var starthour=document.getElementById("start_hour").value;
				var startminute=document.getElementById("start_minute").value;
				var startsecond=document.getElementById("start_second").value;

				var acadyear=document.getElementById("acad_year").value;
				
				if(document.getElementById("odd").checked){
					var semtype = "Odd";
				}
				else{
					var semtype = "Even";
				}

				if(document.getElementById("end").checked){
					var curstatus = 1;
				}
				else{
					var curstatus = 0;
				}
			} 

			$.post(
				'../db/status.php',
				{
					saveChanges:1,

					sem_type:semtype,

					cur_status:curstatus,

					end_year:endyear,
					end_month:endmonth,
					end_day:endday,
					end_hour:endhour,
					end_minute:endminute,
					end_second:endsecond,

					start_year:startyear,
					start_month:startmonth,
					start_day:startday,
					start_hour:starthour,
					start_minute:startminute,
					start_second:startsecond,

					end_time: endyear+"-"+endmonth+"-"+endday+"  "+endhour+":"+endminute+":"+endsecond,
					start_time: startyear+"-"+startmonth+"-"+startday+"  "+starthour+":"+startminute+":"+startsecond,

					acad_year:acadyear

				},

				function(result){

					document.getElementById("message").innerHTML=result;

				}
				);
		}
	</script>

</div>
<!--state div ends-->

<!--courses div starts--> 


<div id="Courses">


	<div id="table1" class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-8" style="text-align: center;"><b style="font-size: 25px;">Course Details</b></div>
				<div class="col-sm-4">
					<button id="addnew1" type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
				</div>
			</div>
		</div>
		<br><br>
		<b>Precede the course codes with "TH_" for theory courses, "L_" for Lab courses and "TU_" for tutorials</b>
		<br><br>
		<p>
			<b>
				<select id="class" class="select_class">
					<option disabled selected value value="base">Choose Class</option>
					<option value="FY_A" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group A</option>
					<option value="FY_B" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group B</option>
					<option value="SY" <?php if($dept_id==6){ ?> hidden <?php } ?>>SY</option>
					<option value="TY" <?php if($dept_id==6){ ?> hidden <?php } ?>>TY</option>
					<option value="LY" <?php if($dept_id==6){ ?> hidden <?php } ?>>LY</option>
					<option value="MTech Comp" <?php if($dept_id!=1){ ?> hidden <?php } ?>>MTech Comp</option>
					<option value="MTech IT" <?php if($dept_id!=2){ ?> hidden <?php } ?>>MTech IT</option>
					<option value="MTech ETRX" <?php if($dept_id!=3){ ?> hidden <?php } ?>>MTech ETRX</option>
					<option value="MTech EXTC" <?php if($dept_id!=4){ ?> hidden <?php } ?>>MTech EXTC</option>
					<option value="MTech Mech" <?php if($dept_id!=5){ ?> hidden <?php } ?>>MTech Mech</option>

				</select>
				
				<script type="text/javascript">
					$(".select_class").change( function() {
						document.getElementById('fy1').style.display = 'none';
						document.getElementById('sy1').style.display = 'none';
						document.getElementById('ty1').style.display = 'none';
						document.getElementById('ly1').style.display = 'none';
						document.getElementById('fy2').style.display = 'none';
						document.getElementById('sy2').style.display = 'none';
						document.getElementById('ty2').style.display = 'none';
						document.getElementById('ly2').style.display = 'none';
						var op = $(this).children("option:selected").val();
						if(op=='FY_A'||op=='FY_B')
						{
							document.getElementById('fy1').style.display = 'block';
							document.getElementById('fy2').style.display = 'block';
						}
						else if(op=='SY')
						{
							document.getElementById('sy1').style.display = 'block';
							document.getElementById('sy2').style.display = 'block';
						}
						else if(op=='TY')
						{
							document.getElementById('ty1').style.display = 'block';
							document.getElementById('ty2').style.display = 'block';

						}
						else if(op=='LY')
						{
							document.getElementById('ly1').style.display = 'block';
							document.getElementById('ly2').style.display = 'block';
						}
						else
						{
							document.getElementById('fy1').style.display = 'block';
							document.getElementById('fy2').style.display = 'block';
						}
					});
				</script>

				<select id="sem">
					<option disabled selected value value="base">Choose Semester</option>
					<option value="1" id="fy1" style="display: none;">Semester 1</option>
					<option value="2" id="fy2" style="display: none;">Semester 2</option>
					<option value="3" id="sy1" style="display: none;">Semester 3</option>
					<option value="4" id="sy2" style="display: none;">Semester 4</option>
					<option value="5" id="ty1" style="display: none;">Semester 5</option>
					<option value="6" id="ty2" style="display: none;">Semester 6</option>
					<option value="7" id="ly1" style="display: none;">Semester 7</option>
					<option value="8" id="ly2" style="display: none;">Semester 8</option>
				</select>
			</b>
			<button id="getData">Get Data</button>
			<div id="frame">
				<script type="text/javascript">
					$('#getData').click(function(){
              //$("#data").html('Loading...');
              var temp=document.getElementById("1")
              if(temp){
              	temp.parentNode.removeChild(temp);
              }
              var e = document.getElementById("sem");
              var s=e.options[e.selectedIndex].value;
              var f = document.getElementById("class");
              var a=f.options[f.selectedIndex].value;

              if(e.selectedIndex<=0 || f.selectedIndex<=0){
              	alert("Select Semester and Class!");
              }
              else{
              	//alert(a+" "+s);
              	$.post(
              		'../db/fillCoursesTable.php',
              		{
              			table1:1,
              			class:a,
              			sem:s
              		},

              		function(result){
              			$('#table1').append(result);

              		}

              		);

              }
          });

      </script>
  </div>
</p>
</div>
</div>

<!--Courses div ends-->



<!--Electives div starts-->
<div id="Electives">
	<div  class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-8" style="text-align: center;"><b style="font-size: 25px;">Electives/ IDC Details</b></div>
				<div class="col-sm-4">
					<button id="addnewElective" type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
				</div>
			</div>
		</div>
		<br><br>
		<b>Precede the course codes with "TH_" for theory courses and "L_" for Lab courses</b>
		<br><br>
		<div id="tableElective">
		</div>
		


	</div>
	
</div>
<!--Electives ends-->
<!-- Assign electives to students-->
<div id="IDCToStudent">
<div class="tab-pane" style="text-align: center;">
		<h2><b>Assign IDC to Student</b></h2>
			<p><h3>Upload CSV file to load student data<br><br>
			<a href="../skeletonCSV/studentIDC_skeleton.csv" download="student.csv">Download Skeleton CSV</a></h3></p>
			<form class="form-style-9" enctype="multipart/form-data" id="stu_form" style="text-align: center;">
				<label class="field-style field-full align-none"><h3>Choose CSV File</h3></label><br><br>
				<input type="file" name="file"id="stuIDC_file" accept=".csv" style="display: inline-block;"><br>
				<button type="button" id="submitcsvIDC" name="importStudent" value="1" class="btn-primary">Import</button>
			</form>
</div>
<script type="text/javascript">
		$(document).ready(function () {

			$("#submitcsvIDC").click(function (event) {
				event.preventDefault();
				var fd = new FormData();
				var files = $('#stuIDC_file')[0].files[0];
				fd.append('file',files);
				fd.append('importStudentIDC',1);

				$.ajax({
					url: '../db/importCSV.php',
					type: 'post',
					data: fd,
					contentType: false,
					processData: false,
					success: function(response){
						if(response != 0){
							alert("uploaded");
						}else{
							alert('file not uploaded');
						}
					},
				});

			}); 
		});
</script>
</div>
<!-- Assign electives to students ends-->
<!--Allocate Faculty div starts-->
<div id="allocateFaculty">
	<div class="table-wrapper" id="table123">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-8"><h2><b>Allocation Details</b></h2></div>
				<div class="col-sm-4">
					<!-- <button id="addnew2"type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button> -->
				</div>
			</div>
		</div>
		<p><b>
			<select id="class2" class="select_class2">
				<option disabled selected value value="base">Choose Class</option>
				<option value="FY_A" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group A</option>
				<option value="FY_B" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group B</option>
				<option value="SY" <?php if($dept_id==6){ ?> hidden <?php } ?>>SY</option>
				<option value="TY" <?php if($dept_id==6){ ?> hidden <?php } ?>>TY</option>
				<option value="LY" <?php if($dept_id==6){ ?> hidden <?php } ?>>LY</option>
				<option value="MTech Comp" <?php if($dept_id!=1){ ?> hidden <?php } ?>>MTech Comp</option>
				<option value="MTech IT" <?php if($dept_id!=2){ ?> hidden <?php } ?>>MTech IT</option>
				<option value="MTech ETRX" <?php if($dept_id!=3){ ?> hidden <?php } ?>>MTech ETRX</option>
				<option value="MTech EXTC" <?php if($dept_id!=4){ ?> hidden <?php } ?>>MTech EXTC</option>
				<option value="MTech Mech" <?php if($dept_id!=5){ ?> hidden <?php } ?>>MTech Mech</option>
			</select>
			<script type="text/javascript">
				$(".select_class2").change( function() {
					document.getElementById('fy1_2').style.display = 'none';
					document.getElementById('sy1_2').style.display = 'none';
					document.getElementById('ty1_2').style.display = 'none';
					document.getElementById('ly1_2').style.display = 'none';
					document.getElementById('fy2_2').style.display = 'none';
					document.getElementById('sy2_2').style.display = 'none';
					document.getElementById('ty2_2').style.display = 'none';
					document.getElementById('ly2_2').style.display = 'none';
					var op = $(this).children("option:selected").val();
					if(op=='FY_A'||op=='FY_B')
					{
						document.getElementById('fy1_2').style.display = 'block';
						document.getElementById('fy2_2').style.display = 'block';
					}
					else if(op=='SY')
					{
						document.getElementById('sy1_2').style.display = 'block';
						document.getElementById('sy2_2').style.display = 'block';
					}
					else if(op=='TY')
					{
						document.getElementById('ty1_2').style.display = 'block';
						document.getElementById('ty2_2').style.display = 'block';

					}
					else if(op=='LY')
					{
						document.getElementById('ly1_2').style.display = 'block';
						document.getElementById('ly2_2').style.display = 'block';
					}
					else
					{
						document.getElementById('fy1_2').style.display = 'block';
						document.getElementById('fy2_2').style.display = 'block';
					}
				});
			</script>

			<select id="sem2">
				<option disabled selected value value="base">Choose Semester</option>
				<option value="1" id="fy1_2" style="display: none;">Semester 1</option>
				<option value="2" id="fy2_2" style="display: none;">Semester 2</option>
				<option value="3" id="sy1_2" style="display: none;">Semester 3</option>
				<option value="4" id="sy2_2" style="display: none;">Semester 4</option>
				<option value="5" id="ty1_2" style="display: none;">Semester 5</option>
				<option value="6" id="ty2_2" style="display: none;">Semester 6</option>
				<option value="7" id="ly1_2" style="display: none;">Semester 7</option>
				<option value="8" id="ly2_2" style="display: none;">Semester 8</option>
			</select>
			<select id="section">
				<option disabled selected value value="base">Choose Section</option>
				<option value="All">All</option>
				<option value="A" >A</option>
				<option value="B" >B</option>
				<option value="C" <?php if($dept_id!=6){ ?> hidden <?php } ?>>C</option>
				<option value="D" <?php if($dept_id!=6){ ?> hidden <?php } ?>>D</option>
				<option value="E" <?php if($dept_id!=6){ ?> hidden <?php } ?>>E</option>
				<option value="F" <?php if($dept_id!=6){ ?> hidden <?php } ?>>F</option>
				<option value="G" <?php if($dept_id!=6){ ?> hidden <?php } ?>>G</option>
				<option value="H" <?php if($dept_id!=6){ ?> hidden <?php } ?>>H</option>
				<option value="I" <?php if($dept_id!=6){ ?> hidden <?php } ?>>I</option>
				<option value="J" <?php if($dept_id!=6){ ?> hidden <?php } ?>>J</option>	
				<option value="A1">A1</option>
				<option value="A2">A2</option>
				<option value="A3">A3</option>
				<option value="A4" <?php if($dept_id==6){ ?> hidden <?php } ?>>A4</option>
				<option value="B1">B1</option>
				<option value="B2">B2</option>
				<option value="B3">B3</option>
				<option value="B4" <?php if($dept_id==6){ ?> hidden <?php } ?>>B4</option>
				<option value="C1" <?php if($dept_id!=6){ ?> hidden <?php } ?>>C1</option>
				<option value="C2" <?php if($dept_id!=6){ ?> hidden <?php } ?>>C2</option>
				<option value="C3" <?php if($dept_id!=6){ ?> hidden <?php } ?>>C3</option>
				<option value="D1" <?php if($dept_id!=6){ ?> hidden <?php } ?>>D1</option>
				<option value="D2" <?php if($dept_id!=6){ ?> hidden <?php } ?>>D2</option>
				<option value="D3" <?php if($dept_id!=6){ ?> hidden <?php } ?>>D3</option>
				<option value="E1" <?php if($dept_id!=6){ ?> hidden <?php } ?>>E1</option>
				<option value="E2" <?php if($dept_id!=6){ ?> hidden <?php } ?>>E2</option>
				<option value="E3" <?php if($dept_id!=6){ ?> hidden <?php } ?>>E3</option>
				<option value="F1" <?php if($dept_id!=6){ ?> hidden <?php } ?>>F1</option>
				<option value="F2" <?php if($dept_id!=6){ ?> hidden <?php } ?>>F2</option>
				<option value="F3" <?php if($dept_id!=6){ ?> hidden <?php } ?>>F3</option>
				<option value="G1" <?php if($dept_id!=6){ ?> hidden <?php } ?>>G1</option>
				<option value="G2" <?php if($dept_id!=6){ ?> hidden <?php } ?>>G2</option>
				<option value="G3" <?php if($dept_id!=6){ ?> hidden <?php } ?>>G3</option>
				<option value="H1" <?php if($dept_id!=6){ ?> hidden <?php } ?>>H1</option>
				<option value="H2" <?php if($dept_id!=6){ ?> hidden <?php } ?>>H2</option>
				<option value="H3" <?php if($dept_id!=6){ ?> hidden <?php } ?>>H3</option>
				<option value="I1" <?php if($dept_id!=6){ ?> hidden <?php } ?>>I1</option>
				<option value="I2" <?php if($dept_id!=6){ ?> hidden <?php } ?>>I2</option>
				<option value="I3" <?php if($dept_id!=6){ ?> hidden <?php } ?>>I3</option>
				<option value="J1" <?php if($dept_id!=6){ ?> hidden <?php } ?>>J1</option>
				<option value="J2" <?php if($dept_id!=6){ ?> hidden <?php } ?>>J2</option>
				<option value="J3" <?php if($dept_id!=6){ ?> hidden <?php } ?>>J3</option>
			</select>
		</b>
		<button id="getData2">Get Data</button>
		<script type="text/javascript">
			$('#getData2').click(function(){
              //$("#data").html('Loading...');
              var temp=document.getElementById("2")
              if(temp){
              	temp.parentNode.removeChild(temp);
              }
              var e = document.getElementById("class2");
              var s=e.options[e.selectedIndex].value;
              var f = document.getElementById("section");
              var a=f.options[f.selectedIndex].value;
              var t = document.getElementById("sem2");
              var r=t.options[t.selectedIndex].value;

              if(e.selectedIndex<=0 || f.selectedIndex<=0){
              	alert("Select section and class!");
              }
              else{
              	$.post(
              		'../db/fillAllocateFacultyTable.php',
              		{
              			table2:1,
              			section:a,
              			class:s,
              			sem:r
              		},

              		function(result){
              			$('#table123').append(result);
              			//alert("Posted");
              		}

              		);

              }
          });

      </script>
  </p>
</div>
</div>
<!--Allocate Faculty div ends-->



<!--Questions div starts--> 


<div id="Questions" style="text-align: center;">



	<div id="table456" class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-8"><h2><b>Questions Details</b></h2></div>
				
			</div>
		</div>
		<p>
			<input id="courseCode" type="text" name="Course_Code" list="suggestions_courses"  placeholder="Course Type" />
			<button id="getData3">Get Data</button>


			<script type="text/javascript">
				$('#getData3').click(function(){

					var c = document.getElementById("courseCode").value;
					var  options = document.querySelectorAll('#suggestions_courses option');
					for(var i = 0; i < options.length; i++) {
						var option = options[i];

						if(option.innerText === c) {
							var value2send = option.getAttribute('data-value');
							break;
						}
					}



					$.post(
						'../db/QuestionsTable.php',
						{
							table3:1,
							courseCode:value2send
						},

						function(result){
							//alert("Posted");
							$('#table456').append(result);

						}

						);


				});

			</script>

		</p>
	</div>
	<div class="col-sm-4">
		<button id="addnew3" style="align-self: center; margin-left: 400px;" type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
	</div>
</div>

<!--Questions div ends-->

<!--Student div starts-->
<div style="width: 100%" id="Student">
	<div style="width: 100%"class="col-md-6">
		<div style="width: 100%" class="panel with-nav-tabs panel-forms">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab1_student" data-toggle="tab"><h2>View<h2></a></li>
						<li><a href="#tab2_student" data-toggle="tab"><h2>Add</h2></a></li>
						<li><a href="#tab3_student" data-toggle="tab"><h2>Remove</h2></a></li>
						<!-- <li><a href="#tab4_student" data-toggle="tab"><h2>Import Attendance</h2></a></li>
							<li><a href="#tab5_student" data-toggle="tab"><h2>View Attendance</h2></a></li> -->
						</ul>
					</div>
					<div style="width: 100%"  class="panel-body">
						<div style="width: 100%"  class="tab-content">
							<div style="width: 100%" class="tab-pane fade in active" style="text-align: center;" id="tab1_student">
								<div style="width: 100%"  id="showStudent">

									<div class="table-title" style="width: 100%;"><b style="font-size: 30px; ">Student Details</b> 
										<button id="addnew4" type="button" class="add-new"><i class="fa fa-plus"></i> Add New</button>
									</div>
									<p><b>
										<select id="classOfStudent">
											<option disabled selected value value="base">Choose Class</option>
											<option value="FY_A" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group A</option>
											<option value="FY_B" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group B</option>
											<option value="SY" <?php if($dept_id==6){ ?> hidden <?php } ?>>SY</option>
											<option value="TY" <?php if($dept_id==6){ ?> hidden <?php } ?>>TY</option>
											<option value="LY" <?php if($dept_id==6){ ?> hidden <?php } ?>>LY</option>
											<option value="MTech Comp" <?php if($dept_id!=1){ ?> hidden <?php } ?>>MTech Comp</option>
											<option value="MTech IT" <?php if($dept_id!=2){ ?> hidden <?php } ?>>MTech IT</option>
											<option value="MTech ETRX" <?php if($dept_id!=3){ ?> hidden <?php } ?>>MTech ETRX</option>
											<option value="MTech EXTC" <?php if($dept_id!=4){ ?> hidden <?php } ?>>MTech EXTC</option>
											<option value="MTech Mech" <?php if($dept_id!=5){ ?> hidden <?php } ?>>MTech Mech</option>
										</select>
										<select id="sectionOFStudent">
											<option disabled selected value value="base">Choose Section</option>
											<option value="All">All</option>
											<option value="A" >A</option>
											<option value="B" >B</option>
											<option value="C" <?php if($dept_id!=6){ ?> hidden <?php } ?>>C</option>
											<option value="D" <?php if($dept_id!=6){ ?> hidden <?php } ?>>D</option>
											<option value="E" <?php if($dept_id!=6){ ?> hidden <?php } ?>>E</option>
											<option value="F" <?php if($dept_id!=6){ ?> hidden <?php } ?>>F</option>
											<option value="G" <?php if($dept_id!=6){ ?> hidden <?php } ?>>G</option>
											<option value="H" <?php if($dept_id!=6){ ?> hidden <?php } ?>>H</option>
											<option value="I" <?php if($dept_id!=6){ ?> hidden <?php } ?>>I</option>
											<option value="J" <?php if($dept_id!=6){ ?> hidden <?php } ?>>J</option>										
										</select>
									</b>
									<button id="getDataOfStudent">Get Data</button>
									<script type="text/javascript">
										$('#getDataOfStudent').click(function(){


											var e = document.getElementById("classOfStudent");
											var s=e.options[e.selectedIndex].value;
											var f = document.getElementById("sectionOFStudent");
											var a=f.options[f.selectedIndex].value;

											if(e.selectedIndex<=0 || f.selectedIndex<=0){
												alert("Select section and class!");
											}
											else{
												$("#table211").empty();

												$.post(
													'../db/showStudent.php',
													{
														table4:1,
														section:a,
														class:s

													},

													function(result){

														$('#table211').append(result);
													}
													);

											}
										});

									</script>
								</p>

								<input type="text" id="myInput" onkeyup="searchStudent()" placeholder="Search by Names/ Roll No/ Class" >
								<div style="width: 100%"  id="table211" class="table-wrapper">




								</div>
							</div>
						</div>
						<div class="tab-pane fade" style="text-align: center;" id="tab2_student">
							<h2><b>Add Student</b></h2>
							<p><h3>Upload CSV file to load student data. The CSV file must contain columns in the following order:<br>
								RollNo, FirstName, MiddleName, LastName, Email, Password, Department ID, class, semester, batch, section, elective_or_IDC_ID, elective_or_IDC_BatchID<br>
								<a href="../skeletonCSV/student_skeleton.csv" download="student.csv">Download Skeleton CSV</a></h3></p>
								<form class="form-style-9" enctype="multipart/form-data" id="stu_form" style="text-align: center;">
									<label class="field-style field-full align-none"><h3>Choose CSV File</h3></label><br><br>
									<input type="file" name="file"id="stu_file" accept=".csv" style="display: inline-block;"><br>
									<button type="button" id="submitcsv" name="importStudent" value="1" class="btn-primary">Import</button>
								</form>
							</div>

							<div class="tab-pane fade" id="tab3_student">
								<form class="form-style-9" id="deleteStudent_form">
									<div class="form-group">
										<select name="class">
											<option disabled selected value value="base">Choose Class</option>
											<option value="FY_A" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group A</option>
											<option value="FY_B" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group B</option>
											<option value="SY" <?php if($dept_id==6){ ?> hidden <?php } ?>>SY</option>
											<option value="TY" <?php if($dept_id==6){ ?> hidden <?php } ?>>TY</option>
											<option value="LY" <?php if($dept_id==6){ ?> hidden <?php } ?>>LY</option>
											<option value="MTech Comp" <?php if($dept_id!=1){ ?> hidden <?php } ?>>MTech Comp</option>
											<option value="MTech IT" <?php if($dept_id!=2){ ?> hidden <?php } ?>>MTech IT</option>
											<option value="MTech ETRX" <?php if($dept_id!=3){ ?> hidden <?php } ?>>MTech ETRX</option>
											<option value="MTech EXTC" <?php if($dept_id!=4){ ?> hidden <?php } ?>>MTech EXTC</option>
											<option value="MTech Mech" <?php if($dept_id!=5){ ?> hidden <?php } ?>>MTech Mech</option>
										</select>
									</div> 
									<button  id="deleteStudent"type="button" name="delete" value="1" class="btn-primary">Remove Students</button>
								</form>
							</div>
							<div class="tab-pane fade" style="text-align: center;" id="tab4_student">
								<h2><b>Attendance</b></h2>
								<p>
									<h3>
										<div class="form-group">
											<select name="class" id="student_class" class="select_class3">
												<option disabled selected value value="base">Choose Class</option>
												<option value="FY_A" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group A</option>
												<option value="FY_B" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group B</option>
												<option value="SY" <?php if($dept_id==6){ ?> hidden <?php } ?>>SY</option>
												<option value="TY" <?php if($dept_id==6){ ?> hidden <?php } ?>>TY</option>
												<option value="LY" <?php if($dept_id==6){ ?> hidden <?php } ?>>LY</option>
												<option value="MTech Comp" <?php if($dept_id!=1){ ?> hidden <?php } ?>>MTech Comp</option>
												<option value="MTech IT" <?php if($dept_id!=2){ ?> hidden <?php } ?>>MTech IT</option>
												<option value="MTech ETRX" <?php if($dept_id!=3){ ?> hidden <?php } ?>>MTech ETRX</option>
												<option value="MTech EXTC" <?php if($dept_id!=4){ ?> hidden <?php } ?>>MTech EXTC</option>
												<option value="MTech Mech" <?php if($dept_id!=5){ ?> hidden <?php } ?>>MTech Mech</option>
											</select>
											<select name="section" id="student_section">
												<option disabled selected value value="base">Choose Section</option>

												<option value="A" >A</option>
												<option value="B" >B</option>
												<option value="C" <?php if($dept_id!=6){ ?> hidden <?php } ?>>C</option>
												<option value="D" <?php if($dept_id!=6){ ?> hidden <?php } ?>>D</option>
												<option value="E" <?php if($dept_id!=6){ ?> hidden <?php } ?>>E</option>
												<option value="F" <?php if($dept_id!=6){ ?> hidden <?php } ?>>F</option>
												<option value="G" <?php if($dept_id!=6){ ?> hidden <?php } ?>>G</option>
												<option value="H" <?php if($dept_id!=6){ ?> hidden <?php } ?>>H</option>
												<option value="I" <?php if($dept_id!=6){ ?> hidden <?php } ?>>I</option>
												<option value="J" <?php if($dept_id!=6){ ?> hidden <?php } ?>>J</option>                       
											</select>
											<script type="text/javascript">
												$(".select_class3").change( function() {
													document.getElementById('fy1_3').style.display = 'none';
													document.getElementById('sy1_3').style.display = 'none';
													document.getElementById('ty1_3').style.display = 'none';
													document.getElementById('ly1_3').style.display = 'none';
													document.getElementById('fy2_3').style.display = 'none';
													document.getElementById('sy2_3').style.display = 'none';
													document.getElementById('ty2_3').style.display = 'none';
													document.getElementById('ly2_3').style.display = 'none';
													var op = $(this).children("option:selected").val();
													if(op=='FY_A'||op=='FY_B')
													{
														document.getElementById('fy1_3').style.display = 'block';
														document.getElementById('fy2_3').style.display = 'block';
													}
													else if(op=='SY')
													{
														document.getElementById('sy1_3').style.display = 'block';
														document.getElementById('sy2_3').style.display = 'block';
													}
													else if(op=='TY')
													{
														document.getElementById('ty1_3').style.display = 'block';
														document.getElementById('ty2_3').style.display = 'block';

													}
													else if(op=='LY')
													{
														document.getElementById('ly1_3').style.display = 'block';
														document.getElementById('ly2_3').style.display = 'block';
													}
													else
													{
														document.getElementById('fy1_3').style.display = 'block';
														document.getElementById('fy2_3').style.display = 'block';
													}
												});
											</script>

											<select id="sem">
												<option disabled selected value value="base">Choose Semester</option>
												<option value="1" id="fy1_3" style="display: none;">Semester 1</option>
												<option value="2" id="fy2_3" style="display: none;">Semester 2</option>
												<option value="3" id="sy1_3" style="display: none;">Semester 3</option>
												<option value="4" id="sy2_3" style="display: none;">Semester 4</option>
												<option value="5" id="ty1_3" style="display: none;">Semester 5</option>
												<option value="6" id="ty2_3" style="display: none;">Semester 6</option>
												<option value="7" id="ly1_3" style="display: none;">Semester 7</option>
												<option value="8" id="ly2_3" style="display: none;">Semester 8</option>
											</select>
										</div> 
										<button class="btn-primary" id="exportCSV">GET SKELETON CSV</button></h3></p>
										<form class="form-style-9" enctype="multipart/form-data" id="stu_attendance_form" style="text-align: center;">
											<label class="field-style field-full align-none"><h3>Choose CSV File to upload attendance</h3></label><br><br>
											<input type="file" name="file"id="student_attendance" accept=".csv" style="display: inline-block;"><br>
											<button type="button" id="submitAttendance" name="submitAttendance" value="1" class="btn-primary">Import</button>
										</form>
									</div>
									<div style="width: 100%" class="tab-pane fade" style="text-align: center;" id="tab5_student">
										<div style="width: 100%"  id="showStudentAttendance">

											<div class="table-title" style="width: 100%;"><b style="font-size: 30px; ">Student Attendance Details</b> 
												<div class="form-group">
													<select name="class" id="student_class2" class="select_class4">
														<option disabled selected value value="base">Choose Class</option>
														<option value="FY_A" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group A</option>
														<option value="FY_B" <?php if($dept_id!=6){ ?> hidden <?php } ?>>FY Group B</option>
														<option value="SY" <?php if($dept_id==6){ ?> hidden <?php } ?>>SY</option>
														<option value="TY" <?php if($dept_id==6){ ?> hidden <?php } ?>>TY</option>
														<option value="LY" <?php if($dept_id==6){ ?> hidden <?php } ?>>LY</option>
														<option value="MTech Comp" <?php if($dept_id==6){ ?> hidden <?php } ?>>MTech Comp</option>
														<option value="MTech IT" <?php if($dept_id==6){ ?> hidden <?php } ?>>MTech IT</option>
														<option value="MTech ETRX" <?php if($dept_id==6){ ?> hidden <?php } ?>>MTech ETRX</option>
														<option value="MTech EXTC" <?php if($dept_id==6){ ?> hidden <?php } ?>>MTech EXTC</option>
														<option value="MTech Mech" <?php if($dept_id==6){ ?> hidden <?php } ?>>MTech Mech</option>
													</select>
													<select name="section" id="student_section2">
														<option disabled selected value value="base">Choose Section</option>

														<option value="A" >A</option>
														<option value="B" >B</option>
														<option value="C" <?php if($dept_id!=6){ ?> hidden <?php } ?>>C</option>
														<option value="D" <?php if($dept_id!=6){ ?> hidden <?php } ?>>D</option>
														<option value="E" <?php if($dept_id!=6){ ?> hidden <?php } ?>>E</option>
														<option value="F" <?php if($dept_id!=6){ ?> hidden <?php } ?>>F</option>
														<option value="G" <?php if($dept_id!=6){ ?> hidden <?php } ?>>G</option>
														<option value="H" <?php if($dept_id!=6){ ?> hidden <?php } ?>>H</option>
														<option value="I" <?php if($dept_id!=6){ ?> hidden <?php } ?>>I</option>
														<option value="J" <?php if($dept_id!=6){ ?> hidden <?php } ?>>J</option>                       
													</select>
													<script type="text/javascript">
														$(".select_class4").change( function() {
															document.getElementById('fy1_4').style.display = 'none';
															document.getElementById('sy1_4').style.display = 'none';
															document.getElementById('ty1_4').style.display = 'none';
															document.getElementById('ly1_4').style.display = 'none';
															document.getElementById('fy2_4').style.display = 'none';
															document.getElementById('sy2_4').style.display = 'none';
															document.getElementById('ty2_4').style.display = 'none';
															document.getElementById('ly2_4').style.display = 'none';
															var op = $(this).children("option:selected").val();
															if(op=='FY_A'||op=='FY_B')
															{
																document.getElementById('fy1_4').style.display = 'block';
																document.getElementById('fy2_4').style.display = 'block';
															}
															else if(op=='SY')
															{
																document.getElementById('sy1_4').style.display = 'block';
																document.getElementById('sy2_4').style.display = 'block';
															}
															else if(op=='TY')
															{
																document.getElementById('ty1_4').style.display = 'block';
																document.getElementById('ty2_4').style.display = 'block';

															}
															else if(op=='LY')
															{
																document.getElementById('ly1_4').style.display = 'block';
																document.getElementById('ly2_4').style.display = 'block';
															}
															else
															{
																document.getElementById('fy1_4').style.display = 'block';
																document.getElementById('fy2_4').style.display = 'block';
															}
														});
													</script>

													<select id="sem">
														<option disabled selected value value="base">Choose Semester</option>
														<option value="1" id="fy1" style="display: none;">Semester 1</option>
														<option value="2" id="fy2" style="display: none;">Semester 2</option>
														<option value="3" id="sy1" style="display: none;">Semester 3</option>
														<option value="4" id="sy2" style="display: none;">Semester 4</option>
														<option value="5" id="ty1" style="display: none;">Semester 5</option>
														<option value="6" id="ty2" style="display: none;">Semester 6</option>
														<option value="7" id="ly1" style="display: none;">Semester 7</option>
														<option value="8" id="ly2" style="display: none;">Semester 8</option>
													</select>
												</div> 
												<button id="getAttendance" class="btn-primary">Get Attendance</button>
											</div>
											<div style="width: 100%"  id="tableAttendance" class="table-wrapper">




											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>






					<script type="text/javascript">
						$(document).ready(function () {

							$("#submitcsv").click(function (event) {
								event.preventDefault();
								var fd = new FormData();
								var files = $('#stu_file')[0].files[0];
								fd.append('file',files);
								fd.append('importStudent',1);

								$.ajax({
									url: '../db/importCSV.php',
									type: 'post',
									data: fd,
									contentType: false,
									processData: false,
									success: function(response){
										if(response != 0){
											alert("uploaded");
										}else{
											alert('file not uploaded');
										}
									},
								});

							}); 


							$("#deleteStudent").click(function (event) {

								$.post("../db/deleteStudent.php", $("#deleteStudent_form").serialize(), function(data) {
									//alert(data);
								});
								document.getElementById("deleteStudent_form").reset();

							});

							$("#exportCSV").click(function(event){
								var e = document.getElementById("student_class");
								var s=e.options[e.selectedIndex].value;
								var f = document.getElementById("student_section");
								var a=f.options[f.selectedIndex].value;
								var g = document.getElementById("student_sem");
								var h=g.options[g.selectedIndex].value;
								window.location.href="../db/exportAttendanceCSV.php?class="+s+"&section="+a+"&sem="+h;
							});

							$("#submitAttendance").click(function (event) {
								event.preventDefault();
								var fd = new FormData();
								var files = $('#student_attendance')[0].files[0];
								fd.append('file',files);
								fd.append('importStudentAttendance',1);

								$.ajax({
									url: '../db/importAttendanceCSV.php',
									type: 'post',
									data: fd,
									contentType: false,
									processData: false,
									success: function(response){
										if(response != 0){
											alert("uploaded");
										}else{
											alert('file not uploaded');
										}
									},
								});

							}); 

							$("#getAttendance").click(function(event){
								$("#tableAttendance").empty();
								var e = document.getElementById("student_class2");
								var s=e.options[e.selectedIndex].value;
								var f = document.getElementById("student_section2");
								var a=f.options[f.selectedIndex].value;
								var g = document.getElementById("student_sem2");
								var h=g.options[g.selectedIndex].value;
								$.post(
									'../db/showAttendance.php',
									{
										section:a,
										class:s,
										sem:h
									},

									function(result){
										$('#tableAttendance').append(result);

									}

									);
							});
						});

					</script>


				</div>
				<!--Student div ends-->

				<!--Faculty div starts-->
				<div  id="Faculty">
					<div style="width: 100%;" class="col-md-6">
						<div style="width: 100%;" class="panel with-nav-tabs panel-forms">
							<div style="width: 100%;"  class="panel-heading">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab1_faculty" data-toggle="tab"><h2>View<h2></a></li>
										<li><a href="#tab2_faculty" data-toggle="tab"><h2>Add</h2></a></li>

									</ul>
								</div>
								<div style="width: 100%;" class="panel-body">
									<div style="width: 100%;"   class="tab-content">
										<div style="width: 100%;"  class="tab-pane fade in active" style="text-align: center;" id="tab1_faculty">
											<div style="width: 100%;"   id="showFaculty">

												<div class="table-title" style="width: 100%;"><b style="font-size: 30px; ">Faculty Details</b> 
													<button id="addnew5" type="button" class="add-new"><i class="fa fa-plus"></i> Add New</button>
												</div>
												<input type="text" id="myInput2" onkeyup="searchFaculty()" placeholder="Search by Names/ Faculty ID" >
												<div style="width: 100%;"   id="table212" class="table-wrapper">


												</div>
											</div>
										</div>
										<div style="width: 100%;"  class="tab-pane fade" style="text-align: center;" id="tab2_faculty">
											<h2><b>Add Faculty</b></h2>
											<p><h3>Upload CSV file to load faculty data. The CSV file must contain columns in the following order:<br>
												Faculty ID, Department ID, FirstName, MiddleName, LastName, Email, Password<br>
												<a href="../skeletonCSV/faculty_skeleton.csv" download="faculty.csv">Download Skeleton CSV</a></h3></p>
												<form class="form-style-9" enctype="multipart/form-data" id="faculty_form" style="text-align: center;">
													<label class="field-style field-full align-none"><h3>Choose CSV File</h3></label><br><br>
													<input type="file" name="file"id="faculty_file" accept=".csv" style="display: inline-block;"><br>
													<button type="button" id="submitcsv2" name="importFaculty" value="1" class="btn-primary">Import</button>
												</form>
											</div>

										</div>
									</div>
								</div>
							</div>






							<script type="text/javascript">
								$(document).ready(function () {

									$("#submitcsv2").click(function (event) {
										event.preventDefault();
										var fd = new FormData();
										var files = $('#faculty_file')[0].files[0];
										fd.append('file',files);
										fd.append('importFaculty',1);

										$.ajax({
											url: '../db/importCSV.php',
											type: 'post',
											data: fd,
											contentType: false,
											processData: false,
											success: function(response){
												if(response != 0){
													alert("uploaded");
												}else{
													alert('file not uploaded');
												}
											},
										});

									}); 




								});

							</script>


						</div>
						<!--Faculty div ends-->


					</div>

					<!--Outer div ends-->
				</body>
				</html>


