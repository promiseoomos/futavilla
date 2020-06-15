<!-- Add Admin Php Codes -->
<?php

include "dbconnect.php";

?>

<?php
	$sea_output = '';
	$search_str = '';
	$num_item = '';

	if(isset($_POST["search_user"])){
		function sanitizeString($conn,$var){
			$var = stripslashes($var);
			$var = strip_tags($var);
			$var = htmlentities($var);
			$var = mysqli_real_escape_string($conn,$var);
			return $var;
		}

		$search_str = $_POST["search_user"];
		$sql = "select * from users where email= '$search_str'";
		$query = mysqli_query($conn,$sql);
		$num_item = mysqli_num_rows($query);

		if($num_item > 0){
			while($row = mysqli_fetch_array($query)){
				$sea_output .= "

				<script type='text/javascript'>
						$(document).ready(function(){

							$('#make_admin').click(function(ev){
								ev.preventDefault();
								var email = $('.pemail').text();
								$.ajax({
									url:'Admin_functions/add_admin.php',
									method:'post',
									data:'pemail='+email,
									success:handleS
								})
							})
							function handleS(data){
								$('#ret_msg').html(data);
							}

							function handleR(data){
								$('#ret_msg').html(data);
							}

							$('#remove_admin').click(function(e){
								e.preventDefault();
								var email = $('.pemail').text();
								$.ajax({
									url:'Admin_functions/add_admin.php',
									method:'post',
									data:'remail='+email,
									success:handleR
								})
							})
						})
					</script>

				<style>
					table{
						padding
					}
				</style>
				<div id='disp_user'>
					<div class='table-responsive'>
						<table class='table table-hover'>
							<tr>
								<th class='disp_th'>User</th>
								<th class='disp_th'>Current Clearance Level</th>
								<th class='disp_th'></th>
								<th class='disp_th'></th>
							</tr>
							<tr>
								<td class='disp_td'>
									<p class='pemail'>{$row['email']}</p>
									<span id='ret_msg'></span>
								</td>
								<td class='disp_td'>
									<p class='disp_p'>{$row['clearance']}</p>
								</td>
								<td>
									<button name='make_admin' id='make_admin' class='btn btn-default' type='button'>Upgrade Clearance</button>
								</td>
								<td>
									<button name='remove_admin' id='remove_admin' class='btn btn-danger' type='button'>Degrade Clearance</button>
								</td>
							</tr>
						</table>
					</div>
				</div>
				";
			}
		}
		echo $sea_output;
	}

	echo $num_item;

	if(isset($_POST["pemail"])){
		$sql = "update users set clearance = 'Admin' where email = '{$_POST['pemail']}' ";
		$query = mysqli_query($conn,$sql);

		if(!$query){
			die("Could Not Upgrade Clearance ".mysqli_error($conn));
		}else{
			echo "<p style='color:green;font-weight:bolder;font-size:18px;'>User upgraded to Admin</p>";
		}
	}

	if(isset($_POST["remail"])){
		$sql = "update users set clearance = 'Normal' where email = '{$_POST['remail']}' ";
		$query = mysqli_query($conn,$sql);

		if(!$query){
			die("Could Not Degrade Users Clearance".mysqli_error($conn));
		}else{
			echo "<p style='color:red;font-weight:bold;font-size:17px;'>User clearance Degraded to Normal User</p>";
		}
	}

?>