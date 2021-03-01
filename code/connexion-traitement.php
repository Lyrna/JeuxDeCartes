<?php

  require 'config.php';

  //function debug
  function debug($variable){
   echo '<pre>' . print_r($variable, true) . '</pre>';
  }

  //création d'un tableau des erreurs de connexion possibles
  $errors = array();


  if(isset($_POST['pseudo']) && isset($_POST['password'])){
    //je récupère le pseudo saisie par l'utilisateur
    $pseudo = $_POST['pseudo'];
    //je récupère les pseudo et mots de passe associés de la bdd
    $requete = $bdd->prepare('SELECT pseudo, password FROM utilisateurs WHERE pseudo = ?');
    $requete->execute([$_POST['pseudo']]);
    $identification_db = $requete->fetch();

        //je vérifie que le pseudo existe en bdd
        if($identification_db){
          //je vérifie le mot de passe
          if(password_verify($_POST['password'], $identification_db['password'])){
            //si tout est bon, la session peut commencer
            session_start();
            $_SESSION['auth'] = $identification_db;
            header('Location: code/landing.php');
            exit();
          }  else {
              $errors['error'] = "Votre mot de passe est incorrect";
            } 
        } else {
            $errors['error'] = "Ce pseudo n'est pas enregistré";  
          }
  }

  // debug($errors);

?>

