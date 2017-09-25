<?php
	if ($argc > 1)
	{
		$file = file($argv[1]);
		foreach ($file as $elem)
		{
			$str = $elem;
			if (preg_match("/http:\/\/.+title=\"([A-Za-z ]+)/", $str, $test) !== FALSE)
			{
				$str = str_replace($test[1], strtoupper($test[1]), $str);
			}
			if (preg_match("/<a .+?>([a-zA-Z ]+)/", $str, $test) !== FALSE)
			{
				$str = str_replace($test[1], strtoupper($test[1]), $str);
			}
			echo "$str";
		}
	}
?>
