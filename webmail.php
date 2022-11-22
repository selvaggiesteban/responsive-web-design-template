<?php

	$mailFrom = $_POST["email"];
	$name = $_POST["name"];
	$tel = $_POST["tel"];
	$subject = "Web request through form";
	$to = "hello@selvaggiesteban.com.ar";
	$headers = "From: " . $to;
	$message = "Email: " . $mailFrom . "\n\n" . "Name: " . $name . "\n\n" . "Phone number: " . $tel . "\n\n" . "Web request through form.";
	
	// Google ReCaptcha verification
	$data = array(
		// Secret key
		'secret' => "#",
		'response' => @$_POST['g-recaptcha-response']
	);
	$verify = curl_init();
	curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($verify, CURLOPT_POST, true);
	curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($verify);
	$response = json_decode($response, true);

	if ($response['success'] === true)	{
		// Send email if verification is succesful
		mail($to, $subject, $message, $headers);
		// News page redirection
		header("Location: #.html");
	}
	// Alert in case of failure
	else {
		header("Refresh:0; url=index.html");
		$alert = "Please validate the captcha field before submitting!";
		echo "<script type='text/javascript'>alert('$alert');</script>";
	}
	
?>