#!/usr/bin/php
<?php
	if ($argc == 2)
	{
		$arg = trim($argv[1]);
		$tab = str_ireplace("  ", " ", $arg);
		while (strstr($tab, "  "))
			$tab = str_ireplace("  ", " ", $tab);
		$arr = explode(" ", $tab);
		foreach ($arr as $key => $val) {
			if(isset($arr[$key+1])){
			    echo $val." ";
			}else{
				echo $val;
			}
		}
		echo "\n";
	}
?>
