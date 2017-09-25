<?php
	$title = "Panier";
	require_once 'fonctions/ft_database.php';
	$database = start_database();
	require_once 'fonctions/ft_user.php';
	require_once 'fonctions/ft_categories.php';
	$allCategory = getCategoryFromCat(0);
	require_once 'fonctions/ft_produits.php';
	if (isset($_SESSION['login']))
		$user = getUser($_SESSION['login']);


	if ($i = 0)
		$_SESSION['basket_total_count'] = 0;

	if (isset($_GET['clean']))
	{
		$_SESSION['basket_total_count'] = 0;
		$_SESSION['basket'] = "";
		header('Location: panier.php');
	}
	if (isset($_GET['add']))
	{
		if (isset($_SESSION['basket_total_count']) && isset($_POST['number']) && intval($_POST['number']) > 0)
			$_SESSION['basket_total_count'] += intval($_POST['number']);
		else if (isset($_SESSION['basket_total_count']))
			$_SESSION['basket_total_count']++;
		if (isset($_SESSION['basket'][intval($_GET['id'])]) && isset($_POST['number']) && intval($_POST['number']) > 0)
			$_SESSION['basket'][intval($_GET['id'])] += intval($_POST['number']);
		else if (isset($_SESSION['basket'][intval($_GET['id'])]))
			$_SESSION['basket'][intval($_GET['id'])]++;
		else if (isset($_POST['number']) && intval($_POST['number']))
			$_SESSION['basket'][intval($_GET['id'])] = intval($_POST['number']);
		else
			$_SESSION['basket'][intval($_GET['id'])] = 1;
		if (isset($_GET['backproduits']))
			header('location: produits.php');
		else if (isset($_GET['produits']))
			$_SESSION['succes'] = 'Vous avez retiré 1 '.$_GET['produits'].' de votre panier';
		else
			header('location: panier.php');
	}

	if (isset($_GET['delete']) && isset($_GET['produits']))
	{
		if ($_SESSION['basket'][intval($_GET['delete'])] > 0 && intval($_GET['delete']) > 0)
		{
			$_SESSION['basket_total_count']--;
			$_SESSION['basket'][intval($_GET['delete'])]--;
			if ($_SESSION['basket'][intval($_GET['delete'])] == 0)
				unset($_SESSION['basket'][intval($_GET['delete'])]);
			$_SESSION['succes'] = 'Vous avez retiré 1 '.$_GET['produits'].' de votre panier';
		}
		else
			header('Location: panier.php');
	}

	require_once 'partials/header.php';
?>

	<div id="slide">
        <div class="image-container-panier"></div>
    </div>
	<div class="title">
		<div class="container">
			<div class="path">
				<h4>
					<i class="fa fa-home"></i>
					Home /
					<i class="fa fa-shopping-cart"></i>
					Mon Panier
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<?php if (!isset($_SESSION['basket']) && empty($_SESSION['basket'])): ?>
			<div class="empty">
				<i class="fa fa-exclamation"></i>
				Votre panier est vide pour le moment.
			</div>
		<?php endif; ?>
		<?php if(!empty($_SESSION['succes'])): ?>
			<div class="succes">
				<i class="fa fa-check"></i>
				<?= $_SESSION['succes']; ?>
			</div>
		<?php endif; ?>
		<?php unset($_SESSION['succes']); ?>
		<h3 class="sous-title panier">
			<i class="fa fa-shopping-basket"></i>
			Mon panier
			<p>
				Les articles ajoutés à votre panier
			</p>
		</h3>
		<div class="articles">
			<?php if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])): ?>
				<table class="table">
					<thead>
						<tr>
							<th>
								Nom
							</th>
							<th>
								Quantité
							</th>
							<th>
								Total
							</th>
							<th>
								Catégorie
							</th>
							<th>
								Actions
							</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$_SESSION['final_price'] = 0;
						foreach ($_SESSION['basket'] as $productId => $productCount): ?>
							<?php
								$product = getOneProduct($productId);
								$totalProductPrice = floatval($product['price'] * floatval($productCount));
								$_SESSION['final_price'] = $_SESSION['final_price'] + $totalProductPrice;
								$totalPrice = $_SESSION['final_price'];
								if ($product)
								{
							?>
								<tr>
									<td>
										<?= $product['title']; ?>
									</td>
									<td>
										<?= $productCount; ?>
									</td>
									<td>
										<?= $totalProductPrice; ?>
										<i class="fa fa-euro"></i>
									</td>
									<td>
										<?php $categories = explode(";", $product['categories']); ?>
											<img src="<?php echo "./design/img/".$allCategory[$categories[0]-1]['title'].".png"; ?>" style="height: 30px;width:30px;margin-left:15px" />
									</td>
									<td>
										<a href="panier.php?id=<?= $product['id']; ?>&add&produits=<?= $product['title']; ?>" class="btn-admin green" style="margin-left: -10px;font-size:18px">+</a>
										<a href="panier.php?delete=<?= $product['id']; ?>&produits=<?= $product['title']; ?>" class="btn-admin red" style="background-color: #E55757;font-size:18px">-</a>
									</td>
								</tr>
							<?php } ?>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div class="item-product" style="height: auto; margin-top: -20px">
				<div class="header">
					<div class="type users" style="background-color: #203F51; border-right: 1px solid #e2d3c0">
						<img src="http://mon-credit.org/wp-content/uploads/2016/04/carte-but.png">
					</div>
					<div class="infos">
						Facture
					</div>
				</div>
				<p class="infos-users">
					Prix total de votre panier : <?= $_SESSION['final_price']; ?>
					<i class="fa fa-euro"></i><br>
					<p class="infos-users">
						<a href="validator.php" class="btn green">Valider mon panier <i class="fa fa-check"></i></a>
						<a href="panier.php?clean" class="btn red">Vider mon panier <i class="fa fa-remove"></i></a>
					</p>
				</p>
			</div>
			<?php endif; ?>
		</div>
	</div>

<?php require_once 'partials/footer.php'; ?>
