<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jeux de cartes</title>
	<script src="https://kit.fontawesome.com/c70a4c5665.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php require 'inscription-traitement.php'; ?>

<div class="big-container">
	<div class="container">
		<div class="inner-container">
			<h1>Château de cartes</h1>
		</div>
		<?php if(!empty($errors)): ?>
			<div class="alert">
				<p><b>Merci de compléter le formulaire avec des données valides</b></p>
				<ul>
					<?php foreach ($errors as $error): ?>
							<li><i class="fas fa-times-circle favicon-error"></i><?= $error; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
<div class="container">
	<div class="already-subscribed">
		<p>Déjà inscrit ?</p>
		<a href="../index.php"><button>Se connecter</button></a>
	</div>
	<div class="login-form">
		<form action="" method="POST">
			<h2>S'inscrire</h2>
			<div class="form-group">
				<div class="icon">
					<i class="fas fa-user-tag"></i>
				</div>
				<div class="input">
					<label for="pseudo">Pseudo <span class="required">*</span></label>
				</div>
				<div>
					<input type="text" placeholder="Saisir le nom d'utilisateur" name="pseudo">
				</div>
			</div>
			<div class="form-group">
				<div class="icon">
					<i class="fas fa-user"></i>
				</div>
				<div class="input">
					<label for="name">Prénom <span class="required">*</span></label>
				</div>
				<div>
					<input type="text" placeholder="Saisir votre prénom" name="prenom">
				</div>
			</div>
			<div class="form-group">
				<div class="icon">
					<i class="fas fa-user"></i>
				</div>
				<div class="input">
					<label for="name">Nom <span class="required">*</span></label>
				</div>
				<div>
					<input type="text" placeholder="Saisir votre nom" name="nom">
				</div>
			</div>
			<div class="form-group">
				<div class="icon">
					<i class="far fa-envelope"></i>
				</div>
				<div class="input">
					<label for="mail">E-Mail <span class="required">*</span></label>
				</div>
				<div>
					<input type="text" placeholder="Saisir l'e-mail" name="email">
				</div>
			</div>
			<div class="form-group">
				<div class="icon">
					<i class="fas fa-lock"></i>
				</div>
				<div class="input">
					<label for="password">Mot de passe <span class="required">*</span></label>
				</div>
				<div>
					<input type="password" placeholder="Saisir un mot de passe" name="password">
				</div>
			</div>
			<div class="form-footer">
				<div>
					<p class="required-champs">(*) Ces champs sont obligatoires</p>
				</div>
				<div>
					<button type="submit" class="subscribe">S'inscrire</button>
				</div>
			</div>
			
		</form>
	</div>
</div>
</div>
	
</body>
</html>