<?php
	date_default_timezone_set('Europe/Paris');
	$jours = ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche"];
	$mois = ["janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre"];
	if ($argc <= 1)
		echo "\n";
	else
	{
		if (preg_match("/^([A-Za-z]{5,8}) ([0-9]{1,2}) ([A-Za-z]{3,9}) ([0-9]{4}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/", $argv[1], $content))
		{
			if (array_search(strtolower($content[1]), $jours) !== FALSE &&
				$content[2] <= 31 && array_search(strtolower($content[3]), $mois) !== FALSE &&
				$content[4] >= 1970 && $content[5] <= 23 && $content[6] <= 59 && $content[7] <= 59)
			{
				if ($time = mktime($content[5], $content[6], $content[7], array_search(strtolower($content[3]), $mois) + 1, $content[2], $content[4]))
					echo ($time);
			}
			else
				echo "Wrong format";
		}
		else
			echo "Wrong format";
		echo "\n";
	}	
?>
