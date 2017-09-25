<?php
	$title = "Home";
	require_once 'fonctions/ft_database.php';
	$database = start_database();
	require_once 'fonctions/ft_user.php';
	require_once 'fonctions/ft_categories.php';
	$allCategory = getCategoryFromCat(0);
	if (isset($_SESSION['login']) && $_SESSION['login'])
		$user = getUser($_SESSION['login']);
	require_once 'partials/header.php';
?>

	<div id="slide">
        <div class="image-container"></div>
    </div>
	<div class="title">
		<div class="container">
			<div class="path">
				<h4>
					<i class="fa fa-home"></i>
					Home
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="produits">
			<?php if(!empty($_SESSION['succes'])): ?>
				<div class="succes">
					<i class="fa fa-check"></i>
					<?= $_SESSION['succes']; ?>
				</div>
			<?php endif; ?>
			<?php unset($_SESSION['succes']); ?>
			<h3 class="sous-title">
				<i class="fa fa-cutlery"></i>
				Nos produits
				<p>
					Le meilleur de nos produits
				</p>
			</h3>
			<div class="products">
			<?php foreach($allCategory as $oneCat)
			{
				foreach($oneCat as $key => $value)
				{
					if ($key === "title") { ?>
				<div class="item-product">
					<div class="header">
						<div class="type <?php echo $value; ?>">
							<a href="produits.php?produits=<?= $oneCat['id']; ?>&submit=1">
								<img src="<?php echo './design/img/'.$value.'.png'; ?>">
							</a>
						</div>
						<div class="infos">
							Nos <?php echo $value; ?>
						</div>
					</div>
					<a href="produits.php?produits=<?php echo $oneCat[$key+1]; ?>&submit=ok"><div class="illustration-<?php echo $value; ?>"></div></a>
					<div class="status">
						<div class="disponible <?php echo $value; ?>">
							<p>Le stock est disponible</p>
						</div>
					</div>
				</div>
			<?php	}
				}
			} ?>
		</div>
			</div>
		</div>
	</div>

<?php require_once 'partials/footer.php'; ?>
