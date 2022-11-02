<?php
require '../ConnectionDB.php';
session_start();
if (isset($_SESSION["login"])) {
    $mail = $_SESSION["login"];
    $personne = $PDO->query("SELECT * from personne WHERE Email='$mail' ");
    $FileP = $personne->fetch(PDO::FETCH_OBJ);
    $nom = $FileP->Nom;
    $prenom = $FileP->prenom;
} else {
    header('location: ../connexion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etudiant</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <link rel="stylesheet" href="style_etudiant.css">

</head>

<body>

    <header class="userinter">

        <div class="user">
            <img src="../image/profil.jfif">
            <h3 class="name"><?php echo "$nom"; ?></h3>
            <p class="post"><?php echo "$prenom"; ?></p>
        </div>

        <nav class="navbar">
            <ul>
                <li><a href="#Accueil">Accueil</a></li>
                <li><a href="etudiantnote.php">Notes</a></li>
                <li><a href="#Maquette">Maquette</a></li>
                <li><a href="#Reclammation">Reclammation</a></li>
                <li><a href="#Parametres">Parametres</a></li>
                <li><a href="../connexion.php">Deconnexion</a></li>
            </ul>
        </nav>

    </header>


    <div id="menu" class="fas fa-bars"></div>

    <section class="Accueil" id="Accueil" style="background: url(../image/indeximg1.jpg) no-repeat; background-size: 100%; ">

        <h1 style="color: #fcd37d;">BIENVENUE DANS VOTRE <span style="color: #fcd37d; font-size: 60px"><br>
                <br><br><br> ESPACE ETUDIANT</span> </h1>


    </section>

    

    <a href="#Accueil" class="top">
        <img src="../images/scroll-top-img.png" alt="">
    </a>

    <!-- jquery cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>