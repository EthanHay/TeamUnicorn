<?php session_start();
//	This file simply unsets the session variables we're using to authenticate & destroys the session
	$email = $_SESSION['email']; // store so we can use it one more time for goodbye message
	unset($_SESSION['email']);
	unset($_SESSION['msg']);
	unset($_SESSION['status']);
	session_destroy();
	header("Location: index.php");
	exit();
?>
<!doctype html>
<html>
<head>

</head>

<body>

</body></html>
