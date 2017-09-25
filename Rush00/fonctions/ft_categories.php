<?php

	function getCategoryFromCat($category = 0)
	{
		global $database;
		$category_list = array();
		$query = "SELECT * FROM categories;";
		if (!($stmt = mysqli_query($database, $query)))
			return false;
		while ($row = mysqli_fetch_array($stmt))
		{
			if ($category > 0 && $row['id'] == $category)
				return $row;
			else
				$category_list[] = $row;
		}
		if ($category > 0)
			return (false);
		return $category_list;
	}

	function modifyCategory($id, $newName)
	{
		global $database;
		$newName = mysqli_real_escape_string($database, $newName);
		$id = mysqli_real_escape_string($database, $id);
		$query = "UPDATE categories SET categorie='$newName', title='$newName' WHERE id='$id';";
		return (mysqli_query($database, $query));
	}

	function deleteCategory($id)
	{
		global $database;
		$id = mysqli_real_escape_string($database, $id);
		$query = "SELECT * FROM products";
		if (!($stmt = mysqli_query($database, $query)))
			return false;
		$allProd = array();
		while ($allProd[] = mysqli_fetch_array($stmt))
			$id = $id;
		foreach ($allProd as $oneProd)
		{
			$modif = 0;
			$allCatFromProd = explode(';', $oneProd['categories']);
			$prodId = $oneProd['id'];
			foreach($allCatFromProd as $kley => $oneCatFromProd)
			{
				if ($oneCatFromProd == $id)
				{
					$modif = 1;
					$allCatFromProd[$kley] = null;
				}
			}
			if ($modif === 1)
			{
				$newCatFromProd = implode(';', array_filter($allCatFromProd));
				$query = "UPDATE products SET categories='$newCatFromProd' WHERE id='$prodId'";
				mysqli_query($database, $query);
			}
		}
		$query = "DELETE FROM categories WHERE id='$id'";
		return (mysqli_query($database, $query));
	}

	function createCategory($categoryName)
	{
		global $database;
		$categoryName = mysqli_real_escape_string($database, $categoryName);
		$query = "INSERT INTO categories(title,categorie) VALUES ('$categoryName','$categoryName')";
		return (mysqli_query($database, $query));
	}
?>
