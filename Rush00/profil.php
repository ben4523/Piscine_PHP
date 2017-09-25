<?php
	require_once 'fonctions/ft_database.php';
	require_once 'fonctions/ft_user.php';
	$database = start_database();
	$user = getUser($_SESSION['login']);
	if (!isset($_SESSION['login']))
		header('Location: connexion.php');
	require_once 'partials/header.php';
?>

<?php if($user['admin'] == '0'): ?>
	<div id="slide">
        <div class="image-container-admin"></div>
    </div>
    <div class="title">
		<div class="container">
			<div class="path">
				<h4>
					<i class="fa fa-home"></i>
					Home / Profil
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<h3 class="sous-title admin">
			Profil
			<p>
				Les informations de votre compte
			</p>
		</h3>
		<div class="item-product-admin">
			<div class="header">
				<div class="type users" style="background-color: #F5EEE5; border-right: 1px solid #e2d3c0">
					<img src="https://www.shareicon.net/data/32x32/2015/09/24/106424_man_512x512.png">
				</div>
				<div class="infos">
					Mes informations
				</div>
				<div class="more-admin" style="background-color: #E0E0E0; border-right: 1px solid #e2d3c0">
					<a href="users-infos.php"><img src="https://assets1.ofcode.org/images/edit.png"></a>
				</div>
			</div>
		</div>
		<div class="item-product-admin">
			<div class="header">
				<div class="type users">
					<a href="commandes.php">
						<img src="http://www.icone-png.com/png/39/38608.png">
					</a>
				</div>
				<div class="infos">
					Mes commandes
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if($user['admin'] == '1'): ?>
	<div id="slide">
        <div class="image-container-admin"></div>
    </div>
    <div class="title">
		<div class="container">
			<div class="path">
				<h4>
					<i class="fa fa-home"></i>
					Home / Administration
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<h3 class="sous-title admin">
			Administration
			<p>
				Gestion des utilisateurs et produits du site
			</p>
		</h3>
		<div class="item-product-admin">
			<div class="header">
				<div class="type users">
					<img src="http://www.shiatsupro.net/images/icon_users_32px.gif">
				</div>
				<div class="infos">
					Gestion des utilisateurs
				</div>
				<div class="more-admin" style="background-color: #E0E0E0;box-shadow: none;">
					<a href="edit-users.php"><img src="https://assets1.ofcode.org/images/edit.png"></i></a>
				</div>
			</div>
		</div>
		<div class="item-product-admin">
			<div class="header">
				<div class="type users">
					<img src="http://www.icone-png.com/png/39/38608.png">
				</div>
				<div class="infos">
					Gestion des produits
				</div>
				<div class="more-admin" style="background-color: #E0E0E0;box-shadow: none;">
					<a href="edit-produits.php"><img src="https://assets1.ofcode.org/images/edit.png"></i></a>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php require_once 'partials/footer.php'; ?>
