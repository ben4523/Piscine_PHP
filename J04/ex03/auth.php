<?php
	function auth($login, $passwd)
	{
		$array = unserialize(file_get_contents("./private/passwd"));
		if ($array != "")
			foreach ($array as $value)
				if ($value['login'] == $login && $value['passwd'] == hash("sha512", $passwd))
					return TRUE;
		return FALSE;
	}
?>
