<?php
define('_EMAIL','youremail@address.com');
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
$result = false;
	if (isset($_REQUEST['action']))
	{
		if ($_REQUEST['action']=="subscription_signup")
		{
			if (isset($_REQUEST['email'])) $mail = $_REQUEST['email'];
			if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) print('error');
			else
			{
			if ($_REQUEST['mode']=='mail')
			{
				$body = "You've got a new signup on the http://".$_SERVER['HTTP_HOST'].str_replace('/php/handler.php','',$_SERVER['REQUEST_URI'])." website with the following mail address: ".$mail.$customfields."
				
				";
				$from_a = 'noreply@'.$_SERVER["HTTP_HOST"];
				$from_name = 'Simple Signup Form';
				$header = 'MIME-Version: 1.0' . "\r\n";
				$header .= "From: =?utf-8?b?".base64_encode($from_name)."?= <".$from_a.">\r\n";
				$header .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
				if (mail(_EMAIL, 'SUBSCRIPTION SIGNUP', $body, $header)) $result = true;
				else $result = false;
			}
			if ($result==true) print("success");
			else print("error");
			}
		}
	}
}
?>