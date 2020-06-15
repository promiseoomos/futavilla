<?php 
	require "dbconnect.php";
	require "phpmailer/PHPMailerAutoload.php";
?>

<?php



	$mail = new PHPMailer(true);

	$mail ->Host='smtp.gmail.com';
	$mail ->isSMTP();
	$mail ->Port=587;
	$mail ->SMTPAuth = true;
	$mail ->SMTPDebug = 2;
	$mail ->Username='promzybankz@gmail.com';
	$mail ->Password='promzybankz';
	$mail ->SMTPSecure ='tls';
	$mail ->setFrom('futavilla@gmail.com','Futavilla.com');
	$mail ->addAddress('promzybankz@gmail.com');

	$mail ->isHTML(true);
	$mail ->Subject = "I am Ok";
	$mail ->Body = "OK";
	$mail ->AltBody = "Please Enable HTML Email!";

	if(!$mail ->send()){
		echo "Mail Not Sent".$mail ->ErrorInfo;
	}else{
		echo "Mail Sent";
	}



?>