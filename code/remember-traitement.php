<?php

  require_once 'config.php';

  //function debug
  function debug($variable){
   echo '<pre>' . print_r($variable, true) . '</pre>';
  }

  //création d'un tableau des erreurs de connexion possibles
  $errors = array();



if(!empty ($_POST['email']) || !empty($_POST['password']) || !empty($_POST['confirm_password'])){

  if(isset($_GET['reinitialiser'])){

     $email = $_POST['email'];

  	if(filter_var($email, FILTER_VALIDATE_EMAIL)){

    $req = $bdd->prepare('SELECT id FROM utilisateurs WHERE email = ?');
    $req->execute(array($email));
    $req = $req->rowCount();

      if($req == 1){

        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

          if($password == $confirm_password){

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $new_pass = $bdd->prepare('UPDATE utilisateurs SET password = ? WHERE email = ?');
            $new_pass-> execute(array($password, $email));

            $_SESSION['message'] = "Votre mot de passe a été réinitialisé avec succès";

          } else $errors['password'] = "Les mots de passe de correspondent pas";

      } else $errors['email'] = "Ce mail n'est pas enregistré";

  	} else $errors['email'] = "Adresse mail invalide";

  } else $errors['url'] = "L'url n'a pas été redirigée";

}

  // debug($errors);

?>