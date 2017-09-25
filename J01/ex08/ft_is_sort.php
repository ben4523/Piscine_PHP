#!/usr/bin/php
<?php
	function ft_is_sort($tab)
	{
		$tab_num = count($tab) - 1;
		$new_tab = $tab;
		sort($tab);
		$i = 0;
		while ($i != $tab_num)
		{
			if ($new_tab[$i] != $tab[$i])
				return (FALSE);
			$i++;
		}
		return (TRUE);
	}
?>
