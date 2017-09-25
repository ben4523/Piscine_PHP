<?php
	require_once 'fonctions/ft_check.php';
	require_once 'fonctions/ft_user.php';
	$user = getUser($_SESSION['login']);

	if (!isset($_SESSION['login']))
		header('Location: connexion.php');

	if (isset($_POST['submit']))
	{
		if (isset($_POST['identifiant']) && valid_mail($_POST['identifiant']) && isset($_POST['oldpasswd']) && valid_passwd($_POST['oldpasswd']) && isset($_POST['newpasswd']) && valid_passwd($_POST['newpasswd']))
		{
			if (get_login($_POST['identifiant'],$_POST['oldpasswd']))
			{
				change_pass($_POST['identifiant'],$_POST['newpasswd']);
				unset($_SESSION['alert']);
				$_SESSION['succes'] = "Votre mot de passe a bien été modifié";
				header('location: logout.php');
			}
			else
				$_SESSION['alert'] = "Votre mot de passe est incorrect";
		}
		else
			$_SESSION['alert'] = "Veuillez vérifier les informations entrée";
	}

	if (isset($_GET['delete']))
	{
		deleteUser($_GET['id']);
		header('location: logout.php');
	}

	if ($user['admin'] == '1')
		header('Location: index.php');

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
					<i class="fa fa-user"></i>
					Profil / Informations
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
		<h3 class="sous-title admin">
			Profil
			<p>
				Les informations de votre compte
			</p>
		</h3>
		<div class="item-product" style="height: auto; margin-top: -20px">
			<div class="header">
				<div class="type users" style="background-color: #F5EEE5; border-right: 1px solid #e2d3c0">
					<img src="https://www.shareicon.net/data/32x32/2015/09/24/106424_man_512x512.png">
				</div>
				<div class="infos">
					mes informations
				</div>
			</div>
			<p class="infos-users">
				Votre identifiant : <?= $_SESSION['login']; ?> <br>
				Votre Panier : <?= $_SESSION['basket_total_count']; ?> articles
			</p>
		</div>
		<div class="item-product" style="height: auto; margin-top: -20px">
			<div class="header">
				<div class="type users" style="background-color: #F5EEE5; border-right: 1px solid #e2d3c0">
					<img src="https://assets1.ofcode.org/images/edit.png">
				</div>
				<div class="infos">
					Modifier mon mot de passe
				</div>
			</div>
			<form action="" method="post" class="form">
				<div class="form-group">
					<label class="label-admin">Identifiant</label>
					<input type="text" name="identifiant" value="<?= $_SESSION['login']?>" class="form-control-admin">
				</div>
				<div class="form-group">
					<input type="password" name="oldpasswd" class="form-control-admin" placeholder="Ancien mot de passe" style="margin-top: -5px">
				</div>
				<div class="form-group">
					<input type="password" name="newpasswd" class="form-control-admin" placeholder="Nouveau mot de passe" style="margin-top: -5px">
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn" style="margin-left: 150px; width: 82.3%">
						<i class="fa fa-pencil"></i>
						Modifier
					</button>
				</div>
			</form>
		</div>
		<a href="users-infos.php?id=<?= $user['id']; ?>&delete" class="btn red" style="width: 98%">
			Supprimer mon compte
		</a>
	</div>
<?php endif; ?>

<?php require_once 'partials/footer.php'; ?>
