<?php
if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'widget'){
	if (isset($_REQUEST['contactemail'])){ $mailTo = $_REQUEST['contactemail']; }
	if (isset($_REQUEST['name'])){ $mailFromName = $_REQUEST['name']; }
	if (isset($_REQUEST['email'])){ $mailFromEmail = $_REQUEST['email']; }
	if (isset($_REQUEST['message'])){ $message = $_REQUEST['message']; }
	if (isset($_REQUEST['mywebsite'])){ $mailFromWebsite = $_REQUEST['mywebsite']; }
	$subject = 'E-mail from website visitor';
	
	$msg = "This message was sent from: $mailFromWebsite \n\nby: $mailFromName \n\nEmail: $mailFromEmail \n\nSubject: $subject \n\nText of message: $message";
	$headers = "MIME-Version: 1.0\r\n Content-type: text/html; charset=utf-8\r\n From: $mailFromEmail\r\n Reply-To: $mailFromEmail";
	
	mail($mailTo, $subject, $msg, $headers);
}
?>