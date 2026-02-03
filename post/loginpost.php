<?php
	session_start();
	if(isset($_POST['username']))
	{
		$_SESSION['user'] = $_POST['username'];
		header('Location: ../landingpage.php');
	}
	else
		header('Location: ../index.php');
?>