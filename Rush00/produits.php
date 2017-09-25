<?php
	require_once 'fonctions/ft_database.php';
	$database = start_database();
	require_once 'fonctions/ft_produits.php';
	$articles = getProducts(0);
	require_once 'fonctions/ft_categories.php';
	$allCategory = getCategoryFromCat(0);
	require_once 'fonctions/ft_user.php';
	if (isset($_SESSION['login']))
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
					Home / Produits
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="m4">
				<div class="test">
					<form action="" method="get" style="margin-left: 30px;margin-top:10px">
						<?php foreach($allCategory as $oneCat)
						{
							foreach($oneCat as $key => $value)
							{
								if ($key === "title") { ?>
								<div class="bur <?php echo $value;?>">
									<img src="<?php echo './design/img/'.$value.'.png'; ?>" style="margin-left: 5px;margin-top: 1px;"><?php echo $value;}
								if ($key === 'id') { ?>
									<input type="radio" name="produits" value="<?php echo $value;?>" class="choice">
								</div>
								<?php } ?>
						<?php
							}
						} ?>
						<div class="form-group">
							<button type="submit" name="submit" value="ok" class="btn" style="width:90%">
								Rechercher
							</button>
						</div>
					</form>
				</div>
			</div>
			<div class="m6">
				<div class="test">
					<?php
					if($articles && isset($_GET['produits']))
					{
						foreach ($articles as $data)
						{
							$categories = explode(";", $data['categories']);
							if (array_search($_GET['produits'], $categories) !== FALSE)
							{ ?>
								<div class="m3">
									<div class="item-prod">
										<div class="header">
											<div class="type <?php echo $allCategory[($_GET['produits'] - 1)]['title']; ?>">
												<img src="<?php echo "./design/	img/".$allCategory[($_GET['produits'] - 1)]['title'].'.png'; ?>">
											</div>
											<div class="infos">
												<?= substr($data['title'], 0, 22); ?>
											</div>
											<div class="more" style="background-color: #E0E0E0;box-shadow: none">
												<a href="<?php echo "article.php?id=".$data['id']; ?>">
													<img src="http://fs.datafrenzy.com/images/buttons/add-circle.png">
												</a>
											</div>
										</div>
										<img src="<?php echo $data['image']; ?>" style="height: 225px; display: block;">
										<div class="header">
											<div class="type <?php echo $allCategory[($_GET['produits'] - 1)]['title']; ?>" style="opacity:0">

											</div>
											<div class="infos" style="float: right">
												<form action="panier.php?add&id=<?php echo $data['id']; ?>" method="post" style="margin-top: 0px">
													<input type="number" min="1" name="number" step="1">
													<button type="submit">ok</button>
												</form>
											</div>
										</div>
									</div>
								</div>
						<?php
							}
						}
					}
					else
					{
						foreach ($articles as $data)
						{
							$categories = explode(";", $data['categories']); ?>
							<div class="m3">
								<div class="item-prod">
									<div class="header">
										<div class="type <?php echo $allCategory[$categories[0]-1]['title']; ?>">
											<img src="<?php echo "./design/img/".$allCategory[$categories[0]-1]['title'].'.png'; ?>">
										</div>
										<div class="infos">
											<?= substr($data['title'], 0, 22); ?>
										</div>
										<div class="more" style="background-color: #E0E0E0;box-shadow: none">
											<a href="<?php echo "article.php?id=".$data['id']; ?>">
												<img src="http://fs.datafrenzy.com/images/buttons/add-circle.png">
											</a>
										</div>
									</div>
									<img src="<?php echo $data['image']; ?>" style="height: 225px; display: block;">
									<div class="header">
										<div class="type <?php echo $allCategory[$categories[0]-1]['title']; ?>" style="opacity:0">

										</div>
										<div class="infos" style="float: right">
											<form action="panier.php?add&id=<?php echo $data['id']; ?>" method="post" style="margin-top: 0px">
												<input type="number" min="1" name="number" step="1">
												<button type="submit">ok</button>
											</form>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					}
				?>
		</div>
	</div></div></div>

<?php require 'partials/footer.php'; ?>
