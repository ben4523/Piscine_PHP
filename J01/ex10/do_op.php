#!/usr/bin/php
<?php
	if ($argc != 4)
	{
		echo "Incorrect Parameters";
		return (0);
	}
	$param1 = trim($argv[1]);
	$param1 = preg_replace('/\s+/', '', $param1);
	$param2 = trim($argv[2]);
	$param2 = preg_replace('/\s+/', '', $param2);
	$param3 = trim($argv[3]);
	$param3 = preg_replace('/\s+/', '', $param3);
	if ($param2 == '+')
		echo ($param1 + $param3);
	else if ($param2 == '-')
		echo ($param1 - $param3);
	else if ($param2 == '/')
		echo ($param1 / $param3);
	else if ($param2 == '*')
		echo ($param1 * $param3);
	else if ($param2 == '%')
		echo ($param1 % $param3);
?>
