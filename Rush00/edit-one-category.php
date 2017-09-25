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

	if (isset($_POST['submit']) && isset($_POST['nom-categorie']))
	{
		modifyCategory($_GET['id'],$_POST['nom-categorie']);
		header("location: edit-one-category.php?id=".$_GET['id']);
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
					Stocks / Categorie
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<h3 class="sous-title admin">
			Categories
			<p>
				Modifier une nouvelle categorie
			</p>
		</h3>
		<div class="item-product" style="height: auto; margin-top: -20px">
			<div class="header">
				<div class="type users" style="background-color: #F5EEE5; border-right: 1px solid #e2d3c0">
					<img src="https://assets1.ofcode.org/images/edit.png">
				</div>
				<div class="infos">
					Modifier une categorie
				</div>
			</div>
			<form action="edit-one-category.php?id=<?php echo $_GET['id']; ?>" method="post" class="form">
				<div class="form-group">
					<label class="label-admin">Nom</label>
					<input type="text" name="nom-categorie" class="form-control-admin" placeholder="<?php echo $allCategory[($_GET['id']-1)]['title']; ?>">
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn" style="margin-left: 150px; width: 82.3%">
						Modifier
					</button>
				</div>
			</form>
		</div>
	</div>

<?php endif; ?>

<?php require_once 'partials/footer.php'; ?>
