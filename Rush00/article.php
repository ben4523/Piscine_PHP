<?php
	require_once 'fonctions/ft_database.php';
	$database = start_database();
	require_once 'fonctions/ft_categories.php';
	$allCategory = getCategoryFromCat(0);
	require_once 'fonctions/ft_user.php';
	if (isset($_SESSION['login']))
		$user = getUser($_SESSION['login']);
	require_once 'fonctions/ft_produits.php';
	$produce = getOneProduct(intval($_GET['id']));
	$categorie = explode(";",$produce['categories']);
	if (!isset($_GET['id']) || !$produce['id'])
	{
		$_SESSION['alert'] = 'Cet article n\'existe pas';
		header('Location: produits.php');
	}
	require_once 'partials/header.php';
?>
		<div id="slide">
	        <div class="image-container-<?php echo $allCategory[$categorie[0]-1]['title']; ?>"></div>
	    </div>
	<div class="title">
		<div class="container">
			<div class="path">
				<h4>
					Produits / <?php echo $allCategory[$categorie[0]-1]['title']; ?>
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<h3 class="sous-title">
			<i class="fa fa-cutlery"></i>
			<?php echo $allCategory[$categorie[0]-1]['title']; ?> / <?php echo $produce['title']; ?>
		</h3>
		<div class="item-product" style="height: auto; margin-top: -20px">
			<div class="header">
				<div class="type users" style="background-color: white; border-right: 1px solid #d1d4d6">
					<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Apple_logo_black.svg/2000px-Apple_logo_black.svg.png">
				</div>
				<div class="infos">
					Les ingrédients
				</div>
				<?php if(isset($user['admin']) && $user['admin'] == '0' || !isset($_SESSION['login'])): ?>
					<div class="more" style="background-color: white; border-left: 1px solid #d1d4d6; box-shadow: none">
						<a href="<?php echo "panier.php?id=".$produce['id']."&add";?>"><img src="http://fs.datafrenzy.com/images/buttons/add-circle.png"></a>
					</div>
				<?php endif; ?>
				<?php if(isset($user['admin']) && $user['admin'] == '1'): ?>
					<div class="more" style="background-color: white; border-left: 1px solid #d1d4d6; box-shadow: none">
						<a href="edit-one-product.php?id=<?php echo $produce['id']; ?>"><img src="https://assets1.ofcode.org/images/edit.png"></a>
					</div>
				<?php endif; ?>
			</div>
			<p style="margin-left: 10px;"><?= $produce['description']; ?></p>
			<div class="status" style="background-color: #F2F2F2; border-top: 1px solid #d1d4d6;color: #7a7676;">
				<p style="margin-left: 10px;">
					Coût de "<?= $allCategory[$categorie[0]-1]['title']; ?> <?= $produce['title']; ?>" :
					<strong>
						<?= $produce['price']; ?><i class="fa fa-euro"></i>
					</strong>
				</p>
			</div>
		</div>
	</div>

<?php require_once 'partials/footer.php'; ?>
