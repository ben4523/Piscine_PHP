#!/usr/bin/php
<?php
	if ($argc != 2)
	{
		echo "Incorrect Parameters";
		return (0);
	}
	$param1 = trim($argv[1]);
	$param1 = preg_replace('/\s+/', '', $param1);
	if (strstr($param1, '+') != FALSE)
		$operateur = '+';
	else if (strstr($param1, '-') != FALSE)
		$operateur = '-';
	else if (strstr($param1, '*') != FALSE)
		$operateur = '*';
	else if (strstr($param1, '/') != FALSE)
		$operateur = '/';
	else if (strstr($param1, '%') != FALSE)
		$operateur = '%';
	else
	{
		echo "Syntax Error";
		return(0);
	}
	$new_str = explode($operateur, $param1);
	if (count($new_str) != 2 || !is_numeric($new_str[0]) || !is_numeric($new_str[1]))
	{
		echo "Syntax Error";
		return(0);
	}
	if ($operateur == '+')
		echo ($new_str[0] + $new_str[1]);
	else if ($operateur == '-')
		echo ($new_str[0] - $new_str[1]);
	else if ($operateur == '/')
		echo ($new_str[0] / $new_str[1]);
	else if ($operateur == '*')
		echo ($new_str[0] * $new_str[1]);
	else if ($operateur == '%')
		echo ($new_str[0] % $new_str[1]);
?>
