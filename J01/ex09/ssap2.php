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
	$new_tab_alphabet = array();
	foreach ($new_tab as $new) {
		if (ctype_alpha($new))
			$new_tab_alphabet[] = $new;
	}
	sort($new_tab_alphabet, SORT_NATURAL | SORT_FLAG_CASE);
	$new_tab_numerique = array();
	foreach ($new_tab as $new) {
		if (is_numeric($new))
			$new_tab_numerique[] = $new;
	}
	sort($new_tab_numerique, SORT_STRING);
	$new_tab_caract = array();
	foreach ($new_tab as $new) {
		if (!ctype_alpha($new) && !is_numeric($new))
			$new_tab_caract[] = $new;
	}
	sort($new_tab_caract);
	$final_tab = array_merge($new_tab_alphabet,$new_tab_numerique,$new_tab_caract);
	foreach ($final_tab as $new) {
		echo $new."\n";
	}
?>
