#!/usr/bin/php
<?php
$key = $argv[1];
foreach ($argv as $val) {
	if ($key != $val)
	{
		$new_b = explode(':', $val);
		if ($new_b[0] == $key)
			echo $new_b[1]."\n";
	}
}
?>
