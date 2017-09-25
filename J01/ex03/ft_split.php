#!/usr/bin/php
<?php
	function ft_split($string)
	{
		$arg = trim($string);
		$tab = str_ireplace("  ", " ", $arg);
		while (strstr($tab, "  "))
			$tab = str_ireplace("  ", " ", $tab);
		$array = explode(" ", $tab);
		if ($string != NULL)
			sort($array);
		return ($array);
	}
?>
