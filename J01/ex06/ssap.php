#!/usr/bin/php
<?php
	$new_tab = array();
	function ft_split($string)
	{
		$array = explode(" ", $string);
		if ($string != NULL)
			sort($array);
		return ($array);
	}
	foreach ($argv as $arg_new) {
		if ($arg_new != $argv[0])
		{
			$tab = ft_split($arg_new);
			$new_tab = array_merge($new_tab, $tab);
		}
	}
	sort($new_tab);
	foreach ($new_tab as $new) {
		echo $new."\n";
	}
?>
