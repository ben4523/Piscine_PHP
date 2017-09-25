<?php
	require_once 'fonctions/ft_check.php';
	require_once 'fonctions/ft_user.php';
	if (!isset($_SESSION['login']))
		header('Location: profil.php');
	$user = getUser($_SESSION['login']);
	if ($user['admin'] == '0' || !isset($_SESSION['login']))
		header('Location: index.php');

	$query = "SELECT * FROM users";
	$stmt = mysqli_query($database,$query);
	while ($row = mysqli_fetch_array($stmt))
		$allUsers[] = $row;

	if (isset($_GET['delete']))
	{
		deleteUser(intval($_GET['delete']));
		if ($user['id'] == $_GET['delete'])
		{
			$_SESSION['succes'] = "L'utilisateur a bien été supprimé";
			$_SESSION['user'] = null;
			header('Location: edit-users.php');
		}
		else
		{
			$_SESSION['alert'] = "L'utilisateur n'existe pas";
			header('Location: edit-users.php');
		}
	}

	if (isset($_GET['id']) && isset($_GET['level']))
	{
		if ($_GET['level'] == '0')
			$q = mysqli_query($database, "UPDATE users SET admin='1' WHERE id='" . intval($_GET['id']) . "'");
		else
			$q = mysqli_query($database, "UPDATE users SET admin='0' WHERE id='" . intval($_GET['id']) . "'");
		query_ok($q);
		$_SESSION['succes'] = "Le niveau de l'utilisateur a bien été modifié";
		header('Location: edit-users.php');
	}

	if (isset($_POST['submit']))
	{
		if (!empty($_POST['identifiant']) && !empty($_POST['password']))
		{
			if (get_mail($_POST['identifiant']) == "")
			{
				create_new_user($_POST['identifiant'], $_POST['password']);
				$_SESSION['succes'] = "L'utilisateur a bien été créer";
				header('Location: edit-users.php');
			}
			else
				$_SESSION['alert'] = "Cette adresse e-mail existe déjà";
		}
		else
		{
			$_SESSION['alert'] = "Merci de remplir tout les champs";
			header('Location: edit-users.php');
		}

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
					<img src="http://fs.datafrenzy.com/images/buttons/add-circle.png">
				</div>
				<div class="infos">
					Ajouter un utilisateur
				</div>
			</div>
			<form action="" method="post" class="form">
				<div class="form-group">
					<label class="label-admin">Identifiant</label>
					<input type="text" name="identifiant" class="form-control-admin">
				</div>
				<div class="form-group">
					<label class="label-admin" style="margin-top: 2px">Mot de passe</label>
					<input type="password" name="password" class="form-control-admin" style="margin-top: -5px">
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn" style="margin-left: 150px; width: 82.3%">
						<i class="fa fa-plus"></i>
						Ajouter
					</button>
				</div>
			</form>
		</div>
		<div class="item-product" style="height: auto">
			<div class="header" style="margin-bottom: 35px">
				<div class="type users">
					<img src="https://assets1.ofcode.org/images/edit.png">
				</div>
				<div class="infos">
					Modifier les utilisateurs
				</div>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>
							Id
						</th>
						<th>
							Identifiant
						</th>
						<th>
							Level
						</th>
						<th>
							Actions
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($allUsers as $user): ?>
						<tr>
							<th>
								<?= $user['id']; ?>
							</th>
							<td>
								<?= $user['email']; ?>
							</td>
							<td>
								<?= $user['admin']; ?>
							</td>
							<td>
								<a href="edit-users.php?delete=<?= $user['id']; ?>" class="btn-admin delete">Supprimer</a>
								<a href="edit-users.php?id=<?= $user['id']; ?>&level=<?= $user['admin']; ?>" class="btn-admin brown">Grade</i></a>
								<a href="modif-users.php?id=<?= $user['email']; ?>" class="btn-admin brown">Modifier</i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

<?php endif; ?>

<?php require 'partials/footer.php'; ?>
