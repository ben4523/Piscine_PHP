<?php
	require_once 'fonctions/ft_database.php';
	$database = start_database();
	require_once 'fonctions/ft_produits.php';
	$articles = getProducts(0);
	require_once 'fonctions/ft_user.php';
	require_once 'fonctions/ft_categories.php';
	if ($_SESSION['login'])
		$user = getUser($_SESSION['login']);

	if ($user['admin'] == '0' || !isset($_SESSION['login']))
		header('Location: profil.php');

	$query = "SELECT * FROM categories";
	$stmt = mysqli_query($database,$query);
	while ($row = mysqli_fetch_array($stmt))
		$categories[] = $row;

	if(isset($_GET['delete_categories']))
	{
		$query = deleteCategory(intval($_GET['delete_categories']));
		if ($categories[0] == $_GET['delete_categories'])
			header('Location: edit-produits.php');
		else
			header('Location: edit-produits.php');
	}

	if(isset($_GET['id']) && isset($_GET['del']))
	{
		$product = getOneProduct(intval($_GET['id']));
		if ($product && $user && $user['admin'] == '1')
		{
			$id = mysqli_real_escape_string($database,$_GET['id']);
			$query = "DELETE FROM products WHERE id='$id'";
			if (!($stmt = mysqli_query($database, $query)))
				header('Location: edit-produits.php');
			header('Location: edit-produits.php');
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
					Administration / Stocks
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<h3 class="sous-title admin">
			Stock
			<p>
				Gestion des stocks
			</p>
		</h3>
		<div class="item-product" style="height: auto; margin-top: -20px">
			<div class="header">
				<div class="type users">
					<img src="http://www.icone-png.com/png/39/38608.png">
				</div>
				<div class="infos">
					Catégories
				</div>
			</div>
			<?php if($categories): ?>
				<table class="table" style="margin-top: 15px">
					<thead>
						<tr>
							<th>
								Id
							</th>
							<th>
								Nom
							</th>
							<th>
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($categories as $data): ?>
							<tr>
								<th>
									<?= $data['id']; ?>
								</th>
								<td>
									<?= $data['title']; ?>
								</td>
								<td>
									<a href="edit-produits.php?delete_categories=<?= $data['id']; ?>" class="btn-admin red">Supprimer</a>
									<a href="edit-one-category.php?id=<?= $data['id']; ?>" class="btn-admin brown">Modifier</i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
			<?php if (!$categories): ?>
				<div class="status">
					<div class="disponible brown">
						<i class="fa fa-exclamation"></i>
						Il n'y a aucune catégories.
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="item-product" style="height: auto; margin-top: -20px">
			<div class="header">
				<div class="type users">
					<img src="http://www.icone-png.com/png/39/38608.png">
				</div>
				<div class="infos">
					Produits
				</div>
			</div>
			<?php if($articles): ?>
				<table class="table" style="margin-top: 15px">
					<thead>
						<tr>
							<th>
								Id
							</th>
							<th>
								Nom
							</th>
							<th>
								Catégorie
							</th>
							<th>
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($articles as $data): ?>
							<tr>
								<th>
									<?= $data['id']; ?>
								</th>
								<td>
									<?= $data['title']; ?>
								</td>
								<td>
									<?= $data['categories']; ?>
								</td>
								<td>
									<a href="edit-produits.php?del&id=<?= $data['id']; ?>" class="btn-admin red">Supprimer</a>
									<a href="edit-one-product.php?id=<?= $data['id']; ?>" class="btn-admin brown">Modifier</i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
			<?php if (!$articles): ?>
				<div class="status">
					<div class="disponible brown">
						<i class="fa fa-exclamation"></i>
						Il n'y a aucun produit.
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="item-product" style="height: auto; margin-top: -20px">
			<div class="header">
				<div class="type users">
					<a href="add-produits.php"><img src="http://fs.datafrenzy.com/images/buttons/add-circle.png"></a>
				</div>
				<div class="infos">
					Ajouter un produit
				</div>
			</div>
		</div>
		<div class="item-product" style="height: auto; margin-top: -20px">
			<div class="header">
				<div class="type users">
					<a href="add-category.php"><img src="http://fs.datafrenzy.com/images/buttons/add-circle.png"></a>
				</div>
				<div class="infos">
					Ajouter une categorie
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php require_once 'partials/footer.php'; ?>
