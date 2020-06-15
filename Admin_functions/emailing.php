<?php 
	require "dbconnect.php";
	require "phpmailer/PHPMailerAutoload.php";
?>

<?php

	$output_events = '';
	$sql = "select * from events order by edate desc";
	$query = mysqli_query($conn,$sql);
	$num_events = mysqli_num_rows($query);

	$output_events .= "
	<div id='disp_event'>
				<div class='table-responsive'>
					<table class='table table-hover'>
						<tr>
							<th class='disp_th2'>Event Photo</th>
							<th class='disp_th2'>Title</th>
							<th class='disp_th2'>Category</th>
							<th class='disp_th2'>Venue</th>
							<th class='disp_th2'>Date</th>
							<th class='disp_th2'>Time</th>
							<th class='disp_th2'>Posted On</th>
						</tr>
	";

	$i = 1;
	$j = 0;

	if($num_events > 0 ){
		while($row = mysqli_fetch_array($query)){
		  	$d = $row["edate"];
          	$e = new DateTime();
          	$e -> setDate(substr($d,0,4),substr($d,5,2),substr($d,8,2));
          	$f = $e -> format('l d, F Y');

			$output_events .= "
				<script type='text/javascript'>
						$(document).ready(function(){

							$('.send_mails').eq({$j}).click(function(ev){
								ev.preventDefault();
								var eid = $('.eid').eq({$j}).text();
								alert({$j})
								alert(eid)
								$.ajax({
									url:'Admin_functions/emailing2.php',
									method:'post',
									data:'eid='+eid,
									success:handleS
								})
							})
							function handleS(data){
								$('.ret_msg').eq({$j}).html(data);
							}

							function handleR(data){
								$('#ret_msg').eq({$j}).html(data);
							}

							$('.del_event').click(function(e){
								e.preventDefault();
								alert('OK')
								var deid = $('#eid').val();
								$.ajax({
									url:'Admin_functions/emailing2.php',
									method:'post',
									data:'deid='+deid,
									success:handleR
								})
							})
						})
					</script>
						</tr>
							<td class='disp_td2'>$i <img height='50px' width='50px' src='{$row['image']}'> </td>
							<td class='disp_td2'>{$row['title']} <p class='eid hidden' id='eid' name='eid'>{$row['event_id']}</p> </td>
							<td class='disp_td2'>{$row['category']}</td>
							<td class='disp_td2'>{$row['venue']}</td>
							<td class='disp_td2'>$f</td>
							<td class='disp_td2'>{$row['etime']}</td>
							<td class='disp_td2'>{$row['datepos']}</td>
							<td class='disp_td2'>
								<button name='send_mail' id='send_mail' class='send_mails btn btn-default' type='button'>Send Mail to All Users</button><p class='ret_msg'></p>
							</td>
							<td class='disp_td2'>
								<button name='del_event' id='del_event' class='del_events btn btn-danger' type='button'>Delete Event</button>
							</td>
							<td class='disp_td2'>
								<button name='send_email_s' id='send_email_s' class='send_email_s btn btn-info' type='button'>Send Email to Suscribers Only</button>
							</td>
						</tr>
			";
			$i +=1 ;
			$j += 1;
		}
	}
	$output_events .= "
					</table>
				</div>
			</div>
	";

	echo $output_events;


?>


<!--


		<?php
		/*
		if(isset($_POST['eid'])){

			$sql = "select * from events where event_id = {$_POST['eid']}";
			$query = mysqli_query($conn,$sql);
			$num_events = mysqli_num_rows($query);

			$sql2 = "select email from users";
			$query2 = mysqli_query($conn,$sql2);
			$num_items2 = myslqi_num_rows($query);

			$ret = mysqli_fetch_array($query);

			$eimg = $ret['image'];  

			$d = $row["edate"];
		    $e = new DateTime();
		    $e -> setDate(substr($d,0,4),substr($d,5,2),substr($d,8,2));
		    $f = $e -> format('l d, F Y');


			$mail = new PHPMailer(true);

			$mail ->Host='smtp.promzybankz@gmail.com';
			$mail ->isSMTP();
			$mail ->Port=587;
			$mail ->SMTPAuth = true;
			$mail ->SMTPDebug = 2;
			$mail ->Username='promzybankz@gmail.com';
			$mail ->Password='promzybankz';
			$mail ->SMTPSecure ='tls';
			$mail ->setFrom('futavilla@gmail.com','Futavilla.com');
			$mail ->addAddress('promzybankz@gmail.com');

			$mail ->Subject = "{$ret['title']}";
			$mail ->Body =
			"
					<style>

					</style>
						<div id='imgdiv'>
							<img id='img' class='img' src='{$ret['image']}'>
						</div>
						<div id='content'>
							<p>You are invited to this prestigious event happening within FUTA. Make it a date to learn more and gain more.
							Don't Miss it.</p>
							<p> Date : $f </p>
							<p> Venue : {$ret['venue']} </p>
							<p> Time : {$ret['etime']} </p>
							<br><br><br><br>
							<p>See more at <a href='futavilla.com/events'>FutaVilla</p>
						</div>
			";
			$mail ->AltBody = "Please Enable HTML Email!";


			$mail ->isHTML(true);

			if(!$mail ->send()){
				echo "Mail Not Sent". $mail ->ErrorInfo;
			}else{
				echo "Mail Sent Successfully";
			}

			if($num_items > 0){
				while($row = mysqli_fetch_array($query2)){
					
					
					
					


				}
				echo "Sent";
			}

			$mail ->isHTML(true);

			echo "I can See the Event";

		}

		*/
		?>
-->