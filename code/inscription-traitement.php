<?php 

if(!empty($_POST)){

	require_once 'config.php';

	$pseudo = $_POST['pseudo'];
	$prenom =  $_POST['prenom'];
	$nom = $_POST['nom'];
	$email = filter_var($_POST['email']);
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

	$errors = array();

	if(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])){
		$errors['pseudo'] = "Votre pseudo n'est pas valide";
	} else {
		$requete = $bdd->prepare('SELECT id FROM utilisateurs WHERE pseudo = ?');
		$requete->execute([$_POST['pseudo']]);
		$utilisateurs = $requete->fetch();
			if($utilisateurs){
				$errors['pseudo'] = "Ce pseudo est déjà pris";
			}
	}

	if(empty($_POST['prenom']) || !preg_match('/^[a-zA-Z]+$/', $_POST['prenom'])){
		$errors['prenom'] = "Votre prénom n'est pas valide";
	}

	if(empty($_POST['nom']) || !preg_match('/^[a-zA-Z]+$/', $_POST['nom'])){
		$errors['nom'] = "Votre nom n'est pas valide";
	}

	if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$errors['email'] = "Votre e-mail n'est pas valide";
	} else {
		$requete = $bdd->prepare('SELECT email FROM utilisateurs WHERE email = ?');
		$requete->execute([$_POST['email']]);
		$utilisateurs = $requete->fetch();
			if($utilisateurs){
				$errors['email'] = "Ce mail est déjà utilisé";
			}
	}

	if(empty($_POST['password']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['password'])){
		$errors['password'] = "Votre mot de passe n'est pas valide";
	}

	// function debug($variable){
	// 	echo '<pre>' . print_r($variable, true) . '</pre>';
	// }

	// debug($errors);

	if(empty($errors)){
		$requete = $bdd->prepare('INSERT INTO utilisateurs SET pseudo = ?, prenom = ?, nom = ?, email = ?, password = ?');

		$requete->execute([$pseudo, $prenom, $nom, $email, $password]);
		header('Location: landing.php');
	}
}
?>