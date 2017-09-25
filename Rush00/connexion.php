<?php
	require_once 'fonctions/ft_check.php';
	require_once 'fonctions/ft_user.php';

	if (isset($_SESSION['login']))
		header('Location: profil.php');

	if (isset($_POST['submit']))
	{
		if (isset($_POST['identifiant']) && valid_mail($_POST['identifiant']) && isset($_POST['password']) && valid_passwd($_POST['password']) && get_login($_POST['identifiant'], $_POST['password']))
		{
			$_SESSION['login'] = $_POST['identifiant'];
			unset($_SESSION['alert']);
			$_SESSION['succes'] = "Vous êtes maintenant connecté";
			header('location: index.php');
		}
		else
			$_SESSION['alert'] = "Mauvais identifiant ou mot de passe";
	}
	require_once 'partials/header.php';
?>


	<div id="slide">
        <div class="image-container-login"></div>
    </div>
	<div class="title">
		<div class="container">
			<div class="path">
				<h4>
					<i class="fa fa-home"></i>
					Home /
					<i class="fa fa-lock"></i>
					Accès
				</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<?php if(!empty($_SESSION['alert'])): ?>
			<div class="alert">
				<i class="fa fa-exclamation"></i>
				<?= $_SESSION['alert']; ?>
			</div>
		<?php endif; ?>
		<?php unset($_SESSION['alert']); ?>
		<?php if(!empty($_SESSION['succes'])): ?>
			<div class="succes">
				<i class="fa fa-check"></i>
				<?= $_SESSION['succes']; ?>
			</div>
		<?php endif; ?>
		<?php unset($_SESSION['succes']); ?>
		<h3 class="sous-title">
			<i class="fa fa-lock"></i>
			Se connecter
			<p>
				Connectez-vous pour finalisez vos commades
			</p>
		</h3>
		<form action="connexion.php" method="post" class="form">
			<div class="form-group">
				<label for="identifiant">Votre identifiant</label>
				<input type="text" name="identifiant" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Votre mot de passe</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" name="submit" class="btn">
					<i class="fa fa-lock"></i>
					Connexion
				</button>
			</div>
			<p><a href="inscription.php">Je n'ai pas de compte</a></p>
		</form>
	</div>

<?php require_once 'partials/footer.php'; ?>
