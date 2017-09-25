<?php
	$title = "Home";
	require_once 'fonctions/ft_database.php';
	$database = start_database();
	require_once 'fonctions/ft_user.php';
	require_once 'fonctions/ft_produits.php';
	$articles = getProducts(0);
	if ($_SESSION['login'])
		$user = getUser($_SESSION['login']);
	if(!$user || !isset($_SESSION['login']))
	{
		$_SESSION['alert'] = "Vous devez vous connectez pour visualiser les commandes validées";
		header('Location: connexion.php');
	}
	$title = "Commandes";
	require_once 'partials/header.php';
?>

	<div id="slide">
        <div class="image-container"></div>
    </div>
	<div class="title">
		<div class="container">
			<div class="path">
				<h4>
					Commandes
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<?php if(isset($_SESSION['alert'])): ?>
			<div class="alert">
				<i class="fa fa-exclamation"></i>
				<?= $_SESSION['alert']; ?>
			</div>
		<?php endif; ?>
		<?php unset($_SESSION['alert']); ?>
		<?php if(isset($_SESSION['succes'])): ?>
			<div class="succes">
				<i class="fa fa-check"></i>
				<?= $_SESSION['succes']; ?>
			</div>
		<?php endif; ?>
		<?php unset($_SESSION['succes']); ?>
		<h3 class="sous-title" style="width: 100%">
			Commandes
			<p>
				Vos commandes en cours de validation
			</p>
		</h3>
		<?php
			if (isset($user['admin']) && $user['admin'] == '1')
				$commandes = get_all_order();
			else if (isset($user))
				$commandes = get_my_order($user['email']);
			if ($commandes)
			{
		?>
				<div class="item-product" style="height: auto; margin-top: -20px">
					<div class="header">
						<div class="type users" style="background-color: #F5EEE5; border-right: 1px solid #e2d3c0">
							<img src="https://www.shareicon.net/data/32x32/2015/09/24/106424_man_512x512.png">
						</div>
						<div class="infos">
							Commandes en cours
						</div>
					</div>
					<table class="table" style="margin-top: 15px">
						<thead>
							<tr>
								<th>
									Numéro de commande
								</th>
								<th>
									Nom
								</th>
								<th>
									Date
								</th>
								<th>
									Actions
								</th>
								<th>
									Produits
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($commandes as $data)
									{ ?>
									<tr>
									<th>
										<?= $data['id']; ?>
									</th>
									<td>
										<?= $data['login']; ?>
									</td>
									<td>
										<?= $data['date']; ?>
									</td>
									<td>
										<?php if ($user['admin'] == 1) { ?>
										<a href="edit-commandes.php?id=<?= $data['id'] ?>&delete" class="btn-admin delete">
											Supprimer
										</a>
										<?php } ?>
									</td>
									<td>
										<?php	$allArt = unserialize($data['basket']);
												foreach($allArt as $id => $nb)
												{
													echo $articles[$id]['title']."  x".$nb; ?>
													<?php if ($user['admin'] == 1) { ?>
													<a href="edit-commandes.php?id=<?= $data['id']; ?>&add&id_prod=<?php echo $id; ?>" class="btn-admin brown">
														+
													</a>
													<a href="edit-commandes.php?id=<?= $data['id']; ?>&retire&id_prod=<?php echo $id; ?>" class="btn-admin brown">
														-
													</a></br>
													<?php } ?>
													</br>
										<?php } ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			<?php } ?>
		</div>

<?php require_once 'partials/footer.php'; ?>
