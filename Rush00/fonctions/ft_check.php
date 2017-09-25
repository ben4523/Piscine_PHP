<?php
	require 'fonctions/ft_database.php';
	$database = start_database();
	
	function valid_mail($email)
	{
		if(filter_var($email,FILTER_VALIDATE_EMAIL) === FALSE)
		   return FALSE;
		else
		   return TRUE;
	}

	function valid_passwd($pass)
	{
		if (empty($pass) || strlen($pass) < 6)
			return FALSE;
		else
			return TRUE;
	}

	function get_mail($email)
	{
		global $database;
		$email = mysqli_real_escape_string($database,$email);
		$query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		if (!($stmt = mysqli_query($database, $query)))
			return FALSE;
		$row = mysqli_fetch_array($stmt);
		return $row;
	}

	function get_login($email,$passwd)
	{
		global $database;
		$email = mysqli_real_escape_string($database,$email);
		$passwd = hash("sha512", mysqli_real_escape_string($database,$passwd));
		$query = "SELECT * FROM users WHERE email='$email' AND passwd='$passwd' LIMIT 1";
		if (!($stmt = mysqli_query($database, $query)))
			return FALSE;
		$row = mysqli_fetch_array($stmt);
		if ($row === NULL)
			return FALSE;
		else
			return TRUE;
	}

	function get_title($title)
	{
		global $database;
		$title = mysqli_real_escape_string($database,$title);
		$query = "SELECT * FROM products WHERE title='$title' LIMIT 1";
		if (!($stmt = mysqli_query($database, $query)))
			return FALSE;
		$row = mysqli_fetch_array($stmt);
		return $row;
	}
?>