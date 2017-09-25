<?php
	function check_exist($login, $oldpw)
	{
		$array = unserialize(file_get_contents("./private/passwd"));
		if ($array != "")
		{
			foreach ($array as $value)
			{
				if ($value['login'] == $login && $value['passwd'] == hash("sha512", $oldpw))
					return 1;
			}
		}
		return 0;
	}

	function modif_exist($login, $oldpw, $newpw)
	{
		$array = unserialize(file_get_contents("./private/passwd"));
		foreach ($array as $key => $value)
		{
			if (($value['login'] == $login) && $value['passwd'] == hash("sha512", $oldpw))
			{
				$array[$key]['passwd'] = hash("sha512", $newpw);
				break;
			}
		}
		file_put_contents("./private/passwd", serialize($array));
		return 1;
	}

	if (isset($_POST['login']) && isset($_POST['newpw']) && isset($_POST['oldpw']) && isset($_POST['submit']) && $_POST['submit'] == 'OK' && trim($_POST['login']) != NULL && trim($_POST['oldpw']) != NULL && trim($_POST['newpw']) != NULL)
	{
		if (check_exist($_POST['login'], $_POST['oldpw']))
		{
			modif_exist($_POST['login'], $_POST['oldpw'], $_POST['newpw']);
			echo "OK\n";
		}
		else
			echo "ERROR\n";
	}
	else
		die ("ERROR\n");
?>
