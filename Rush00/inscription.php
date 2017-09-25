<?php
	require_once 'fonctions/ft_check.php';
	require_once 'fonctions/ft_user.php';

	if (isset($_SESSION['login']))
		header('Location: profil.php');
	if (isset($_POST['submit']))
	{
		if (isset($_POST['identifiant']) && valid_mail($_POST['identifiant']) && isset($_POST['passwd']) && valid_passwd($_POST['passwd']) && $_POST['confirm_password'] == $_POST['passwd'])
		{
			if (get_mail($_POST['identifiant']) == "")
			{
				create_new_user($_POST['identifiant'],$_POST['passwd']);
				unset($_SESSION['alert']);
				$_SESSION['succes'] = "Votre compte a bien été enregistré";
				header('location: connexion.php');
			}
			else
				$_SESSION['alert'] = "Cette adresse e-mail existe déjà";
		}
		else
			$_SESSION['alert'] = "Veuillez bien renseignez vos informations";
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
					<i class="fa fa-user"></i>
					S'inscrire
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
		<h3 class="sous-title">
			<i class="fa fa-user"></i>
			S'inscrire
			<p>
				Inscrivez-vous pour pouvoir commencer vos achats
			</p>
		</h3>
		<form action="" method="post" class="form">
			<div class="form-group">
				<label for="identifiant">Votre identifiant</label>
				<input type="text" name="identifiant" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Votre mot de passe</label>
				<input type="password" name="passwd" class="form-control">
			</div>
			<div class="form-group">
				<label for="confirm-password">Confirmez votre mot de passe</label>
				<input type="password" name="confirm_password" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" name="submit" class="btn">
					<i class="fa fa-user"></i>
					S'inscrire
				</button>
			</div>
			<p><a href="connexion.php">J'ai déjà un compte</a></p>
		</form>
	</div>

<?php require_once 'partials/footer.php'; ?>
