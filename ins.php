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
      // on enregistre les paramètres de notre visiteur comme variables de session ($login et $mdp) 

      $Id = $stmt2->fetch()['IdPersonne'];

      $stmt1 = $PDO->query("INSERT INTO etudiant(filiere,IdPersonne,niveau,NumCarte) values('$filiere','$Id','$Niveau','$codeetudiant')");
      $stmt1 = $PDO->query("INSERT INTO authentification(IdPersonne,Password) values('$Id','$pass')");
   }
   header('location: index.php');
}

?>