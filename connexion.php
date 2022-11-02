<?php
session_start();

require 'connectionDB.php';
$_SESSION["login"] = NULL;
if (isset($_POST['mail']) && isset($_POST['mdp'])) {
   $mail = $_POST['mail'];
   $mdp = $_POST['mdp'];
   $requete = $PDO->query("SELECT * from authentification a , personne p WHERE a.IdPersonne=p.IdPersonne and p.Email='$mail' and password='$mdp' ");
   if ($requete->rowCount() > 0) {
      $_SESSION["login"] = "$mail";
      header('location: etudiant/etudiant.php');
   }
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <title>Se Connecter</title>
   <link rel="stylesheet" href="style_connexion.css">
</head>

<body>
   <div class="wrapper">
      <div class="title">
         Formulaire de Connexion
      </div>
      <form action="#" method="Post">
         <div class="field">
            <input type="text" name="mail" required>
            <label>Adresse e-mail</label>
         </div>
         <div class="field">
            <input type="password" name="mdp" required>
            <label>mot de passe</label>
         </div>
         <div class="content">
            <div class="checkbox">
               <input type="checkbox" id="remember-me">
               <label for="remember-me">se souvenir</label>
            </div>
            <div class="pass-link">
               <a href="#">mot de passe oublie ?</a>
            </div>
         </div>
         <div class="field">
            <input type="submit" value="Connexion">
         </div>
         <div class="signup-link">
            pas encore inscrit? <a href="inscription.php">S'inscrire</a>
         </div>
      </form>
   </div>
</body>

</html>