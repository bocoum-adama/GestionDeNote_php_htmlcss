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
    <title>responsive personal Reclammation website design tutorail</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <link rel="stylesheet" href="style_etudiant.css">
    <link rel="stylesheet" href="TestTableau.css">

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
                <li><a href="etudiant.php">Accueil</a></li>
                <li><a href="etudiantnote.php">Notes</a></li>
                <li><a href="#Maquette">Maquette</a></li>
                <li><a href="#Reclammation">Reclammation</a></li>
                <li><a href="#Parametres">Parametres</a></li>
                <li><a href="../connexion.php">Deconnexion</a></li>
            </ul>
        </nav>

    </header>

    <section class="Notes" id="Notes">

        <h1 class="heading"> <span>Notes</span></h1>
        <div>
            <table style="width: 100%;">
                <tr>
                    <th scope="col">NumCarte</th>
                    <th scope="col">NoteEtudiant</th>
                    <th scope="col">Matiere</th>
                    <th scope="col">Niveau</th>
                </tr>

                <?php
                $personnee = $PDO->query("SELECT * from personne WHERE Email='$mail' ");
                $FileP = $personnee->fetch(PDO::FETCH_OBJ);
                $idp = $FileP->IdPersonne;

                $etudiant = $PDO->query("SELECT * from etudiant WHERE IdPersonne='$idp' ");
                $FileE = $etudiant->fetch(PDO::FETCH_OBJ);
                $numC = $FileE->numcarte;

                $requete = $PDO->query("SELECT * from note WHERE numcarte='$numC'");
                $requete->execute();
                while ($File = $requete->fetch(PDO::FETCH_OBJ)) {
                    $matiere = $File->IdMatiere;
                    $matiere = $PDO->query("SELECT * from matiere WHERE IdMatiere='$matiere'");
                    $FileM = $matiere->fetch(PDO::FETCH_OBJ);
                    $nomM = $FileM->NomMatiere;

                    

                    $login = $File->numcarte;
                    $mdp = $File->NoteEtudiant;
                    $statut = $File->niveau;
                    echo "<tr><td>$login</td><td>$mdp</td><td>$nomM</td><td>$statut</td></tr>";
                }
                echo "</table>";

                ?>
            </table>
        </div>

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