<?php
	require_once 'fonctions/ft_database.php';
	$database = start_database();
	require_once 'fonctions/ft_produits.php';
	$articles = getProducts(0);
	require_once 'fonctions/ft_user.php';
	require_once 'fonctions/ft_categories.php';
	$allCategory = getCategoryFromCat(0);
	if ($_SESSION['login'])
		$user = getUser($_SESSION['login']);
	if ($user['admin'] == '0' || !isset($_SESSION['login']))
		header('Location: profil.php');

	$query = "SELECT * FROM categories";
	$stmt = mysqli_query($database,$query);
	while ($row = mysqli_fetch_array($stmt))
		$categories[] = $row;

	if (isset($_POST['submit']))
	{
		if (isset($_POST['nom']) && is_numeric(intval($_POST['price'])) && isset($_POST['image']) && isset($_POST['description']) && isset($_POST['categories']))
		{
				$categ = implode(";", $_POST['categories']);
	            add_elem(0, $_POST['nom'],$_POST['image'], $_POST['price'], $_POST['description'], $_POST['categories']);
		}
	}
	require_once 'partials/header.php';
?>

<?php if($user['admin'] == '1'): ?>
	<div id="slide">
        <div class="image-container-admin"></div>
    </div>
    <div class="title">
		<div class="container">
			<div class="path">
				<h4>
					Stocks / Produits
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<h3 class="sous-title admin">
			Produits
			<p>
				Ajouter de nouveaux produits
			</p>
		</h3>
		<div class="item-product" style="height: auto; margin-top: -20px">
			<div class="header">
				<div class="type users" style="background-color: #F5EEE5; border-right: 1px solid #e2d3c0">
					<img src="https://assets1.ofcode.org/images/edit.png">
				</div>
				<div class="infos">
					Ajouter un produit
				</div>
			</div>
			<form action="" method="post" class="form">
				<div class="form-group">
					<label class="label-admin">Nom</label>
					<input type="text" name="nom" class="form-control-admin" placeholder="Nom du produit">
				</div>
				<div class="form-group">
					<label class="label-admin">Image</label>
					<input type="text" name="image" class="form-control-admin" placeholder="Image du produit">
				</div>
				<div class="form-group">
					<label class="label-admin">Prix</label>
					<input type="text" name="price" class="form-control-admin" placeholder="Prix du produit">
				</div>
				<div class="form-group">
					<label class="label-admin">Description</label>
					<input type="text" name="description" class="form-control-admin" placeholder="Description du produit">
				</div>
				<div class="form-group">
					<label class="label-admin">Catégorie</label>
					<label name="categories" class="form-control-admin">
						<?php foreach($allCategory as $oneCat) { ?>
					    <input type="checkbox" name="categories[]" value="<?php echo $oneCat['id'];?>"/><?php echo $oneCat['title'];?>
						<?php } ?>
					</label>
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn" style="margin-left: 150px; width: 82.3%">
						Ajouter
					</button>
				</div>
			</form>
		</div>
	</div>

<?php endif; ?>

<?php require_once 'partials/footer.php'; ?>
