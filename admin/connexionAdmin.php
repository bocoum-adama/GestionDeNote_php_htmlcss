<?php
session_start();
$_SESSION["autoriser"] = NULL;
if (isset($_POST['login']) && isset($_POST['mdp'])) {
   $mail = $_POST['login'];
   $mdp = $_POST['mdp'];
   if ($mail == "admin@ugb.edu.sn" and $mdp == "adminUGB") {
      $_SESSION["autoriser"] = "oui";
      header('location: admin.php');
   }
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <title>Se Connecter</title>
   <link rel="stylesheet" href="../style_connexion.css">
</head>

<body>
   <div class="wrapper">
      <div class="title">
         Connexion Admin
      </div>
      <form action="#" method="Post">
         <div class="field">
            <input type="text" name="login" required>
            <label>login</label>
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
            <input type="submit" value="Connexion" name="valider">
         </div>

      </form>
   </div>
</body>

</html>