<?php

  require_once 'config.php';

  //function debug
  function debug($variable){
   echo '<pre>' . print_r($variable, true) . '</pre>';
  }

  //création d'un tableau des erreurs de connexion possibles
  $errors = array();

//READ ALL USERS
	$data = 'SELECT id, pseudo, prenom, nom, email, LEFT(password, 10) AS password, DATE_FORMAT(date_inscription, "%d/%m/%Y à %H:%i") AS date_inscription FROM utilisateurs';

   try{
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $bdd->query($data);
        $stmtphone = $bdd->query($data);

        if($stmt === false){
        die("Erreur");
        }
      }

      catch (PDOException $e){
        echo $e->getMessage();
      }


//CREATE A USER


    if(!empty($_POST)){

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

		if(empty($errors) && isset($_POST['create'])){
			$pseudo = $_POST['pseudo'];
			$prenom =  $_POST['prenom'];
			$nom = $_POST['nom'];
			$email = filter_var($_POST['email']);
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$requete = $bdd->prepare('INSERT INTO utilisateurs SET pseudo = ?, prenom = ?, nom = ?, email = ?, password = ?');

			$requete->execute([$pseudo, $prenom, $nom, $email, $password]);

			$_SESSION['message'] = "Un utilisateur a été ajouté avec succès";
		}
	}

//DELETE

$delete = false;

if(isset($_GET['delete']) || isset($_POST['delete'])){
	$id = $_GET['delete'];
	$delete = true;
	$req = $bdd->query("DELETE FROM utilisateurs WHERE id =  $id");

	$_SESSION['delete'] = "Un utilisateur a été supprimé avec succès";
}

//EDIT

//j'établis mes valeurs d'input par défaut

$id = 0;
$update = false;
$pseudo = '';
$prenom = '';
$nom = '';
$email = '';
$password = '';

//je vérifie qu'il y a edit dans l'url
if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$req = $bdd->query("SELECT * FROM `utilisateurs` WHERE id = $id");

		if($req == true){
			$row = $req->fetch();
			$pseudo = $row['pseudo'];
			$prenom = $row['prenom'];
			$nom = $row['nom'];
			$email = $row['email'];
		}
}

//j'update la bdd
if(isset($_POST['update'])){
	$id = $_POST['id'];
	$pseudo = $_POST['pseudo'];
	$prenom = $_POST['prenom'];
	$nom = $_POST['nom'];
	$email = $_POST['email'];

	$bdd->query("UPDATE utilisateurs SET pseudo = '$pseudo', prenom = '$prenom', nom = '$nom', email = '$email' WHERE id = $id");

	$_SESSION['message'] = "Un utilisateur a été modifié avec succès";
}

// debug($errors);
 ?>