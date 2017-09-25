<?php
	session_start();
	if (!isset($_SESSION['basket_total_count']))
		$_SESSION['basket_total_count'] = 0;

	function start_database()
	{
		$connection = @mysqli_connect(
			"127.0.0.1:3307",
			"root",
			"root",
			"rush00"
		);
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL, error code: " . mysqli_connect_error();
			exit();
		}
		return ($connection);
	}

	function debug($var)
	{
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
	}
?>