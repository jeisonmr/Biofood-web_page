<?php

$field_first_name = $_POST['names'];

$field_email = $_POST['email'];

// $field_phone = $_POST['phone'];

$field_country = $_POST['country'];

// $field_message = $_POST['message'];

$field_token = $_POST['g-recaptcha-response'];

	$captcha_response = true;
    $recaptcha = $field_token;
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => '6LeU1YUjAAAAAPkMOlZFxh26G2grJ8E-SH1hPalM',
        'response' => $recaptcha,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = array(
        'http' => array (
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success = json_decode($data, true);
$echo($captcha_success);
if ($captcha_success['success']==true){

$mail_to = 'jmunoz@pngweb.co';

$subject = 'Mensaje de Contacto Biofood';

$body_message = '<strong>Nombre: </strong>'.$field_first_name.'<br>';

$body_message .= '<strong>E-mail: </strong>'.$field_email.'<br>';

$body_message .= '<strong>País: </strong>'.$field_country.'<br>';

require_once "PHPMailer/PHPMailerAutoload.php";

$mail = new PHPMailer();
$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "pro.turbo-smtp.com";
$mail->Port = 465;
$mail->Username = "jmunoz@pngweb.co";
$mail->Password = "9JlWRZBl";
$mail->SetFrom('jmunoz@gmail.com', 'Biofood Software.');
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