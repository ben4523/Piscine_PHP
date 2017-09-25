<?php
	require_once 'fonctions/ft_check.php';
	require_once 'fonctions/ft_user.php';

	if (!$_SESSION['login'])
		header('Location: profil.php');
	$user = getUser($_SESSION['login']);
	if ($user['admin'] == '0')
		header('Location: profil.php');

	$query = "SELECT * FROM users";
	$stmt = mysqli_query($database,$query);
	while ($row = mysqli_fetch_array($stmt))
		$allUsers[] = $row;

	if (isset($_POST['identifiant']) && isset($_POST['password']) && isset($_POST['submit']))
	{
		change_pass($_POST['identifiant'],$_POST['password']);
		header('location: edit-users.php');
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
					<i class="fa fa-home"></i>
					Home / Utilisateurs
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
		<?php if(isset($_SESSION['succes'])): ?>
			<div class="succes">
				<i class="fa fa-check"></i>
				<?= $_SESSION['succes']; ?>
			</div>
		<?php endif; ?>
		<?php unset($_SESSION['succes']); ?>
		<h3 class="sous-title admin">
			Utilisateurs
			<p>
				Gestion des utilisateurs
			</p>
		</h3>
		<div class="item-product" style="height: auto; margin-top: -20px">
			<div class="header">
				<div class="type users">
					<img src="https://assets1.ofcode.org/images/edit.png">
				</div>
				<div class="infos">
					Modifier un utilisateur
				</div>
			</div>
			<form action="" method="post" class="form">
				<div class="form-group">
					<label class="label-admin">Identifiant</label>
					<input type="text" name="identifiant" class="form-control-admin" value="<?= $_GET['id']; ?>">
				</div>
				<div class="form-group">
					<label class="label-admin" style="margin-top: 2px">Mot de passe</label>
					<input type="password" name="password" class="form-control-admin" style="margin-top: -5px">
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

<?php require 'partials/footer.php'; ?>
