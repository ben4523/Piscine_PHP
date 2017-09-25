<?php
	require_once'ft_database.php';

	function getCategory($id)
	{
		global $database;
		$id = mysqli_real_escape_string($database, $id);
		$query = "SELECT categories FROM products WHERE id='$id'";
		if (!($stmt = mysqli_query($database, $query)))
			return (FALSE);
		$row = mysqli_fetch_array($stmt);
		return ($row);
	}
	
	function isCategory($thisCategory,$allCategory)
	{
		$tab = explode(";", $allCategory);
		foreach ($tab as $one)
		{
			if ($one)
			{
				if (strcmp($one,$thisCategory) === 0)
					return (TRUE);
			}
		}
		return (FALSE);
	}

	function getProducts($category)
	{
		global $database;
		$products = array();
		$query = "SELECT * FROM products";
		if (!($stmt = mysqli_query($database,$query)))
			return (FALSE);
		while ($row = mysqli_fetch_array($stmt))
		{
			if ($category > 0)
			{
				$product_categories = array_filter(explode(";", $row['categories']));
				if ($product_categories)
				{
					foreach ($product_categories as $value)
					{
						if (intval($value) === $category)
							$products[] = $row;
					}
				}
			}
			else
				$products[] = $row;
		}
		return ($products);
	}

	function getOneProduct($productId)
	{
		global $database;
		$productId = mysqli_real_escape_string($database, $productId);
		$query = "SELECT * FROM products WHERE id='$productId'";
		if (!($stmt = mysqli_query($database, $query)))
			return (FALSE);
		$product = mysqli_fetch_array($stmt);
		return ($product);
	}

	function add_elem($id, $productName, $productImage, $productPrice, $productDesc, $categories)
	{
		global $database;
		$productName = mysqli_real_escape_string($database,$productName);
		$productImage = mysqli_real_escape_string($database,$productImage);
		$productDesc = mysqli_real_escape_string($database,$productDesc);
		$productPrice = mysqli_real_escape_string($database,$productPrice);
		$categories = implode(";",$categories);
		if ($id === 0)
			$query = "INSERT INTO products(title, image, description, price, categories) VALUES ('$productName', '$productImage', '$productDesc', '$productPrice', '$categories')";
		else
			$query = "INSERT INTO products(id, title, image, description, price, categories) VALUES ('$id', '$productName', '$productImage', '$productDesc', '$productPrice', '$categories')";
		return (mysqli_query($database, $query));
	}
?>
