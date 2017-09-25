<?php

	function get_img($url, $name_img_dir)
	{
		if (($in = fopen($url, "rb")) && ($out = fopen($name_img_dir, "wb")))
		{
		    while ($chunk = fread($in,8192))
		        fwrite($out, $chunk, 8192);
	    	fclose($in);
	    	fclose($out);
	    }
	    else
	    	echo 'Impossible de sauvegarder l\'image';
	}

	if ($argc > 1)
	{
		if(($content_page = file_get_contents($argv[1])))
		{
			$name_directory = preg_replace( '/^https?:\/\//', '', $argv[1]);
			if (!mkdir($name_directory, 0777, true))
			    die('Echec lors de la création des répertoires...');
			if (!preg_match_all('/<img.*?src ?= ?["\'"](?P<img_url>.*?)["\']/si', $content_page, $imgs))
				return ;
			foreach ($imgs['img_url'] as $imglink) {
				$imglink = preg_replace( '/^\/\//', "http://", $imglink);
				$imgname =  substr(strrchr($imglink, "/"), 1);
				$nw_link = preg_replace('#^https?://#', '', rtrim($argv[1],'/'));
				if (strstr($imglink, $nw_link))
					get_img($imglink, $name_directory."/".$imgname);
				else
					if (substr($argv[1], -1) == '/')
						get_img($argv[1].$imglink, $name_directory."/".$imgname);
					else
						get_img($argv[1].'/'.$imglink, $name_directory."/".$imgname);
			}
		}
		else
			die('URL non accessible...');
	}
?>
