#!/usr/bin/php
<?php
	$arg = trim($argv[1]);
	$tab = str_ireplace("  ", " ", $arg);
	while (strstr($tab, "  "))
		$tab = str_ireplace("  ", " ", $tab);
	$arr = explode(" ", $tab);
	$num_tab = count($arr);
	$first_elem = array_shift($arr);
	foreach ($arr as $val) {
			echo $val." ";
	}
	echo $first_elem;
	if ($argc > 1)
		echo "\n";
?>
