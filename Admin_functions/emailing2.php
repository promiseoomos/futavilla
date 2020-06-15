<?php 
	require "dbconnect.php";
	require "phpmailer/PHPMailerAutoload.php";
?>
<?php

if(isset($_POST['eid'])){

		$sql = "select * from events where event_id = {$_POST['eid']}";
		$query = mysqli_query($conn,$sql);
		$num_items = mysqli_num_rows($query);

		$sql2 = "select email from users";
		$query2 = mysqli_query($conn,$sql2);
		$num_items2 = mysqli_num_rows($query);

		$ret = mysqli_fetch_array($query);

		$eimg = $ret['image'];  

		$d = $ret["edate"];
	    $e = new DateTime();
	    $e -> setDate(substr($d,0,4),substr($d,5,2),substr($d,8,2));
	    $f = $e -> format('l d, F Y');


		$mail = new PHPMailer(true);

		$mail ->Host='smtp.gmail.com';
		$mail ->isSMTP();
		$mail ->Port=587;
		$mail ->SMTPAuth = true;
		//$mail ->SMTPDebug = 2;
		$mail ->Username='futavilla@gmail.com';
		$mail ->Password='promzy31258';
		$mail ->SMTPSecure ='tls';
		$mail ->setFrom('FutaVilla@gmail.com','FutaVilla.com');
		$mail ->addAddress('promzybankz@gmail.com');

		$mail ->addAddress('ajayijhorn@yahoo.com');
		//$mail ->addAddress('ogunsolamosesolawale@gmail.com');
		if($num_items > 0){
			while($row = mysqli_fetch_array($query2)){
				//$mail ->addAddress("{$row['email']}");
			}
		}

		$mail ->isHTML(true);
		$mail ->Subject = "{$ret['title']}";
		
		

		$mail ->Subject = "{$ret['title']}";
		$mail->AddEmbeddedImage("{$ret['image']}", 'eimg',"{$ret['image']}");
		$mail ->Body = "
				<style>
					img{
						height:150px;
						width:100px;
					}
					#imgdiv{
					margin:0px auto;
					height:150px;
					width:120px;
				}

				</style>
					<div id='imgdiv'>
						<img id='img' class='img' src=\"cid:eimg\" />
					</div>
					<div id='content'>
						<p>You are invited to this prestigious event happening within FUTA. Make it a date to learn more and gain more.
						Don't Miss it.</p>

						<p> {$ret['description']} </p>
						<p> Date : '{$f}' </p>
						<p> Venue : {$ret['venue']} </p>
						<p> Time : {$ret['etime']} </p>
						<br><br><br><br>
						<p>See more at <a href='futavilla.com/events'>FutaVilla</p>
					</div>
				";
		$mail ->AltBody = "Please Enable HTML Email!";

		if(!$mail->send()){
			echo "Not sent".$mail->ErrorInfo;
		}else{
			echo "Mail Sent";
		}


		
	}
?>