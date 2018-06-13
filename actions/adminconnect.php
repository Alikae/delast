<?php
	session_start();
	if ($_POST['password'] == 'saucisson') {
		$_SESSION['admin'] = 'true';
	} else {
		$_SESSION['admin'] = 'false';
	}
	header('Location: /delast/index.php');
?>