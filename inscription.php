<?php
session_start();
require 'connectionDB.php';

if (
   isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])
   && isset($_POST['codeetudiant']) && isset($_POST['niveau']) && isset($_POST['filiere'])
   && isset($_POST['pass']) && isset($_POST['repass'])
) {

   $nom = $_POST['nom'];
   $prenom = $_POST['prenom'];
   $email = $_POST['email'];
   $codeetudiant = $_POST['codeetudiant'];
   $Niveau = $_POST['niveau'];
   $filiere = $_POST['filiere'];
   $pass = $_POST['pass'];
   $repass = $_POST['repass'];
   $stmt1 = $PDO->query("INSERT INTO personne(Email,Nom,Prenom) values('$email','$nom','$prenom')");
   $stmt2 = $PDO->query("SELECT * FROM personne WHERE Email='$email'");
   if ($stmt2->rowCount() > 0) {
      $Id = $stmt2->fetch()['IdPersonne'];

      $stmt1 = $PDO->query("INSERT INTO etudiant(filiere,IdPersonne,niveau,NumCarte) values('$filiere','$Id','$Niveau','$codeetudiant')");
      $stmt1 = $PDO->query("INSERT INTO authentification(IdPersonne,Password) values('$Id','$pass')");
   }
   header('location: index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="utf8_decode" />
   <title>Inscription</title>
   <link rel="stylesheet" href="style_inscription.css">
</head>

<body>
   <div id="granddiv">
      <form class="formulaire" method="post">

         <fieldset>
            <legend>Formulaire d'Inscription</legend>
            <div class="label">Nom</div>
            <div class="champ">
               <input type="text" name="nom" placeholder="nom" required />
            </div>
            <div class="label">Prenom</div>
            <div class="champ">
               <input type="text" name="prenom" placeholder="prenom" required />
            </div>
            <div class="label">Email</div>
            <div class="champ">
               <input type="email" name="email" placeholder="email" required />
            </div>
            <div class="label">P_Etudiant</div>
            <div class="champ">
               <input type="text" name="codeetudiant" placeholder="Pxxxxxx" required />
            </div>
            <div class="label">Filiere</div>
            <select class="champ" name="filiere" id="" style="width: 205px;">
               <option value="PREPA" selected>PREPA</option>
               <option value="INFORMATIQUE">INFORMATIQUE</option>
               <option value="GENIE CIVIL">GENIE CIVIL</option>
               <option value="ELECTROMECANIQUE-MECA">ELECTROMECANIQUE-MECA</option>
            </select>
            <div class="label">Votre Niveau</div>
            <select class="champ" name="niveau" id="" style="width: 205px;">
               <option value="CPI1" selected>CPI1</option>
               <option value="CPI2">CPI2</option>
               <option value="ING1">ING1</option>
               <option value="ING2">ING2</option>
               <option value="ING3">ING3</option>
            </select>
            <div class="label">Mot de passe</div>
            <div class="champ">
               <input type="password" name="pass" placeholder="passer123" required />
            </div>
            <div class="label">Confirmer le mot de passe</div>
            <div class="champ">
               <input type="password" name="repass" placeholder="passer123" required />
            </div>

            <input type="submit" name="valider" value="Valider l'inscription" required />
   </div>
   </fieldset>
   </form>
   </div>
</body>

</html>