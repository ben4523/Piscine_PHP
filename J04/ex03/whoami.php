<?php
	session_start();
	if (isset($_SESSION['logged_on_user']))
		if ($_SESSION['logged_on_user'] === "")
			echo "ERROR\n";
		else
			echo $_SESSION['logged_on_user']."\n";
	else
		echo "ERROR\n";
?>