<?php
require_once('settings.php');
require_once('google-login-api.php');

session_start();

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$gapi = new GoogleLoginApi();

		// Get the access token
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);

		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);

		//echo '<pre>';print_r($user_info); echo '</pre>';

		// Now that the user is logged in you may want to start some session variables
    $_SESSION['logiran']='DA';
		$_SESSION['vrijeme']=time();
		$_SESSION['user']=$user_info['displayName'];
    //print_r($_SESSION);

		// You may now want to redirect the user to the home page of your website
		header("Location: ../employee/createEmployee.php");
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}


 ?>
