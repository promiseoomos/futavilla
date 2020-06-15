

<!-- Market Page Php Codes -->

<?php

include "dbconnect.php";

?>

<?php

	$err_smsg = "";
	$item_div = "";
	$num_item = "";
	$title = "";

	if(!empty($_POST["prodName"]) && !empty($_POST["prodDesc"]) && !empty($_POST["price"])){
		function sanitizeString($conn,$var){
			$var = stripslashes($var);
			$var = strip_tags($var);
			$var = htmlentities($var);
			$var = mysqli_real_escape_string($conn,$var);
			return $var;
		}

		$category = $_POST["category"];
		$prodName = sanitizeString($conn,$_POST["prodName"]);
		$prodDesc = sanitizeString($conn,$_POST["prodDesc"]);
		$price = sanitizeString($conn,$_POST["price"]);
		$hostel = sanitizeString($conn,$_POST["hostel"]);
		$contact_1 = sanitizeString($conn,$_POST["contact_1"]);
		$contact_2 = sanitizeString($conn,$_POST["contact_2"]);
		$location = sanitizeString($conn,$_POST["location"]);
		$posted_by = sanitizeString($conn,$_POST["postedby"]);
		$condition = $_POST["condition"];
		$send_me = $_POST["send_me"];
		//$image = $_FILES["prodImg"]["tmp_name"];
		$imagetmp = $_FILES["prodImg"]["tmp_name"];

		move_uploaded_file($imagetmp,'image/'.$prodName.'.jpg');

		$image = "image/".$prodName.".jpg";

		$d = new DateTime();
		$curdate = $d -> format('d, F Y');
		echo $curdate;

		$sql = "insert into market( `category`, `descript`, `title`, `address`, `hostel`, `conditions`, `price`, `send_me`, `image`,`pdate`,`contact_1`,`contact_2`,`posted_by`) VALUES ('$category','$prodDesc','$prodName','$location','$hostel','$condition','$price','$send_me','$image','$curdate','$contact_1','$contact_2','$posted_by')";
		$query = mysqli_query($conn,$sql);
		if(!$query){
			die("Could not Insert data into table". mysqli_error($conn));
		}
	}
?>