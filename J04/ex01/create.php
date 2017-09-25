<?php
	function check_exist($login)
	{
		$array = unserialize(file_get_contents("./private/passwd"));
		if ($array != "")
		{
			foreach ($array as $value)
			{
				if ($value['login'] == $login)
					return 1;
			}
		}
		return 0;
	}

	if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['submit']) && $_POST['submit'] == 'OK' && trim($_POST['login']) != NULL && trim($_POST['passwd']) != NULL)
	{
		if (file_exists("./private") == FALSE)
			mkdir("./private", 0777, true);
		if (file_exists("./private/passwd") == FALSE)
			touch("./private/passwd");
		if (!check_exist($_POST['login']))
		{
			$info = array('login' => $_POST['login'], 'passwd' => hash("sha512", $_POST['passwd']));
			$array = unserialize(file_get_contents("./private/passwd"));
			$array[] = $info;
			file_put_contents("./private/passwd", serialize($array));
			echo "OK\n";
		}
		else
			echo "ERROR\n";
		}
	else
		die ("ERROR\n");
?>
