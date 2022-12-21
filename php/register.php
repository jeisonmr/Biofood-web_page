<?php


$field_first_name = $_POST['names'];

$field_email = $_POST['email'];

$field_phone = $_POST['phone'];

$field_ticket = $_POST['ticket'];

$field_token = $_POST['token'];

$url = "https://www.google.com/recaptcha/api/siteverify";
$data = [

	'secret' => "6LdDDMAUAAAAAJGrDq_abL5WO8bvfsj1rMKVzZdL",
	'response' => $field_token,
	'remoteip' => $_SERVER['REMOTE_ADDR']
];

$options = array(
	'http' => array(
	'header' => "Content-type: application/x-www-form-urlencoded\r\n",
	'method' => 'POST', 
	'content' => http_build_query($data) 
)
);

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

$res = json_decode($response, true);

if ($res['success'] == true){

	

$mail_to = 'gerencia@pngweb.co';

$subject = 'Mensaje de un nuevo visitante que requiere una demo de Biofood Software';

$body_message = '<strong>Nombre de Usuario: </strong>'.$field_first_name.'<br>';

$body_message .= '<strong>E-mail: </strong>'.$field_email.'<br>';

$body_message .= '<strong>Teléfono: </strong>'.$field_phone.'<br>';

$body_message .= '<strong>Observaciones del usuario: </strong><br><br> '.$field_ticket;

require_once "PHPMailer/PHPMailerAutoload.php";

$mail = new PHPMailer();
$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = "contactenospng@gmail.com";
$mail->Password = "Aq123456.";
$mail->SetFrom('contactenospng@gmail.com', 'Biofood Software.');
$mail->Subject = $subject;
$mail->AddAddress($mail_to);
$mail->MsgHTML($body_message);

if ($mail->Send()) { ?>
	<script language="javascript" type="text/javascript">
		//alert('Thank you for the message. We will contact you shortly.');
		window.location = 'index.html';
	</script>
<?php
}
else { ?>
	<script language="javascript" type="text/javascript">
		//alert('Message failed. Please, send an email to gordon@template-help.com');
		window.location = 'index.html';
	</script>
<?php
};



}else{

}


?>