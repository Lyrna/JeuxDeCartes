<?php
session_start();
if(isset($_POST['pseudo']) && isset($_POST['password']))
{
	require 'config.php';
    
    if($pseudo !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateurs where 
              pseudo = '".$pseudo."' and mot_de_passe = '".$password."' ";
        $exec_requete = query($bdd,$requete);
        $reponse      = fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['pseudo'] = $pseudo;
           header('Location: landing.php');
        }
        else
        {
           header('Location: ../index.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: ../index.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: ../index.php');
}
mysqli_close($bdd); // fermer la connexion
?>