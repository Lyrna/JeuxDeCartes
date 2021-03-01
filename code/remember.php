<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jeux de cartes</title>
	<script src="https://kit.fontawesome.com/c70a4c5665.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

	<?php require 'remember-traitement.php'; ?>

<div class="big-container">
	<div class="container">
		<div class="inner-container">
			<h1>Château de cartes</h1>
		</div>
		<!--succed messages-->
		<?php if(isset($_SESSION['message'])): ?>
		<?php 
			echo "<div class='alert-table alert-table-reinitialisation'>" . $_SESSION['message'] . "<a href='../index.php'><p class='connectez-vous'><br/>Connectez-vous</p></a></div>";
			unset($_SESSION['message']);
		?>
		<?php endif; ?>
		<!--error messages-->
		<?php if(!empty($errors)): ?>
			<div class="alert">
				<p><b>Une ou plusieurs erreurs ont été rencontrées :</b></p>
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
		<p>Pas encore inscrit ?</p>
		<a href="inscription.php"><button>S'inscrire</button></a>
	</div>
	<div class="login-form">
		<form action="" method="POST">
			<h2>Réinitialisation par mail</h2>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<div class="form-group">
				<div class="icon">
					<i class="fas fa-user-tag"></i>
				</div>
				<div class="input">
					<label for="mail">Mail  <span class="required">*</span></label>
				</div>
				<div>
					<input type="text" placeholder="Saisissez votre e-mail" name="email" required>
				</div>
			</div>
			<div class="form-group">
				<div class="icon">
					<i class="fas fa-lock"></i>
				</div>
				<div class="input">
					<label for="password">Nouveau mot de passe <span class="required">*</span></label>
				</div>
				<div>
					<input type="password" placeholder="Saisissez votre nouveau mot de passe" name="password" required>
				</div>
			</div>
			<div class="form-group">
				<div class="icon">
					<i class="fas fa-lock"></i>
				</div>
				<div class="input">
					<label for="password">Confirmer le mot de passe <span class="required">*</span></label>
				</div>
				<div>
					<input type="password" placeholder="Confirmer le mot de passe" name="confirm_password" required>
				</div>
			</div>
			<div class="form-footer">
				<div>
					<a href="../index.php"><p class="forgotten-password">Pour retourner au formulaire<br/>Cliquez ici</p></a>
				</div>
				<div>
				<?php
					echo "<a href='remember.php?reinitialiser='><button type='submit' class='subscribe' name='update'>Confirmer</button></a>"
				?>
				</div>
			</div>
			
		</form>
	</div>
</div>
</div>
	
</body>
</html>