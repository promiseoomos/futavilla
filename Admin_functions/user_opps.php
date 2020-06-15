<?php
include "dbconnect.php";

?>
<?php
	$output_users = '';
	$sql = "select * from users";
	$query = mysqli_query($conn,$sql);
	$num_item_users = mysqli_num_rows($query);

	$output_users .= "
	<div id='disp_user2'>
				<div class='table-responsive'>
					<table class='table table-hover'>
						<tr>
							<th class='disp_th2'>Name</th>
							<th class='disp_th2'>Username</th>
							<th class='disp_th2'>Clearance</th>
							<th class='disp_th2'>Phone No</th>
							<th class='disp_th2'>Email:</th>
							<th class='disp_th2'>Gender</th>
						</tr>
	";

	$i = 1;

	if($num_item_users > 0 ){
		while($row = mysqli_fetch_array($query)){

			$output_users .= "
						</tr>
							<td class='disp_td2'>$i {$row['first_name']} {$row['last_name']}</td>
							<td class='disp_td2'>{$row['username']} </td>
							<td class='disp_td2'>{$row['clearance']}</td>
							<td class='disp_td2'>{$row['phone']}</td>
							<td class='disp_td2'>{$row['email']}</td>
							<td class='disp_td2'>{$row['gender']}</td>
							<td class='disp_td2'>
								<button name='make_admin' id='make_admin' class='btn btn-default' type='button'>Upgrade Clearance</button>
							</td>
							<td class='disp_td2'>
								<button name='remove_admin' id='remove_admin' class='btn btn-danger' type='button'>Degrade Clearance</button>
							</td>
							<td class='disp_td2'>
								<button name='remove_user' id='remove_user' class='btn btn-info' type='button'>Delete User</button>
							</td>
						</tr>
			";
			$i +=1 ;
		}
	}
	$output_users .= "
					</table>
				</div>
			</div>
	";

	echo $output_users;

	if(isset($_POST['faculty'])){
		echo "Received";
	}else{echo "Not Received";}


?>