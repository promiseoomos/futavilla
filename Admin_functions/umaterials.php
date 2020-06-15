<!-- Materials Page Php Codes -->

			<?php
			require("dbconnect.php");
			 ?>

			<?php

				$err_smsg = "";
			 $item_div = "";
			 $item_div2 = "";
			 $num_item = "";
			 $title = "";
			 $fileName = "";

			  if(isset($_POST["title"]) && isset($_POST["coursecode"])){

			    function sanitizeString($conn,$var){
			      $var = stripslashes($var);
			      $var = strip_tags($var);
			      $var = htmlentities($var);
			      $var = mysqli_real_escape_string($conn,$var);
			      return $var;
			    }

			    $title = sanitizeString($conn,$_POST["title"]);
			    $coursecode = sanitizeString($conn,$_POST["coursecode"]);
			    $department = $_POST["department"];
			    $level = $_POST["flevel"];
			    $faculty = $_POST['faculty'];
			    $type = $_FILES['pdfs']['type'];
			    //echo $type;
			    $ext = '';

			    switch($type){
			      case "application/pdf":
			      $ext = "pdf";
			      break;
			      case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
			      $ext = "pptx";
			      break;
			      case "application/vnd.ms-powerpoint":
			      $ext = "ppt";
			      break;
			      case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
			      $ext = "docx";
			      break;
			      case "application/msword";
			      $ext = "doc";
			      break;
			    }

			    echo $_FILES['pdfs']['type'];
			    echo $ext;



			    $file_tmp = $_FILES["pdfs"]["tmp_name"];


			    move_uploaded_file($file_tmp,'files/'.$title.'.'.$ext);

			    $fileName = "files/".$title.".".$ext;
			    //echo $fileName;

			    $d = new DateTime();
			    $curdate = $d -> format('d, F Y');

			    $sql = "insert INTO materials(`title`, `course_code`, `department`,`faculty`,`level`, `file_name`,`date_posted`) VALUES ('$title','$coursecode','$department','$faculty','$level','$fileName','$curdate')";
			    $query = mysqli_query($conn,$sql);
			    if(!$query){
			      die("Could not Submit to Database Check the Fields". mysql_error());
			    }else{
			    //  header("location:dashboard.php");
			    	echo "Done";
			    }
			  }
			?>
