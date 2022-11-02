<?php
session_start();
if (isset($_SESSION["autoriser"])) {
} else {
    header('location: connexionAdmin.php');
    exit();
}
?>


<?php

require '../connectionDB.php';

if (
    isset($_POST['numCard']) && isset($_POST['evaluation'])
    && isset($_POST['niveau']) && isset($_POST['matiere'])
) {
    $numCard = $_POST['numCard'];
    $evaluation = $_POST['evaluation'];
    $niveau = $_POST['niveau'];
    $matiere = $_POST['matiere'];

    $idEval = $PDO->query("SELECT * FROM evaluation WHERE TypeEvaluation='$evaluation'");
    $idMatie = $PDO->query("SELECT * FROM matiere WHERE NomMatiere='$matiere'");
    if ($idEval->rowCount() > 0 && $idMatie->rowCount() > 0) {
        $IdE = $idEval->fetch()['IdEvaluation'];
        $IdM = $idMatie->fetch()['IdMatiere'];

        $idEval = $PDO->query("DELETE FROM note WHERE numCarte='$numCard'and idEvaluation='$IdE' and IdMatiere='$IdM' ");
        header('location: adminSup.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href='style_admin.css' rel='stylesheet'>
    <link rel="stylesheet" href="../etudiant/TestTableau.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ########################################################################## -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script>
        function getMatiere(val) {
            $.ajax({
                type: "POST",
                url: "get_matiere.php",
                data: 'id_niveau=' + val,
                success: function(data) {
                    $("#list-matiere").html(data);
                }
            });
        }

        // function selectCountry(val) {
        //     $("#search-box").val(val);
        //     $("#suggesstion-box").hide();
        // }
    </script>
    <!-- ############################################################################ -->
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">Administrateur</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="admin.php" class="active">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Ajouter Note</span>
                </a>
            </li>
            <li>
                <a href="adminModif.php">
                    <i class='bx bx-box'></i>
                    <span class="links_name">Modifier Note</span>
                </a>
            </li>
            <li>
                <a href="adminSup.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Supprimer Note</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Ajouter Utilisateur</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Modifier Utilisateur</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-book-alt'></i>
                    <span class="links_name">Supprimer Utilisateur</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class='bx bx-message'></i>
                    <span class="links_name">Liste Utilisateur</span>
                </a>
            </li>
            <li style="background-color:#0d3073 ;">
                <a href="adminlistenote.php">
                    <i class='bx bx-heart'></i>
                    <span class="links_name">Liste Note</span>
                </a>
            </li>

            <li class="log_out">
                <a href="connexionAdmin.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Deconnexion</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Recherche</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <i class='bx bx-search'></i>
            </div>
            <div class="profile-details">
                <span class="admin_name"><a href="../index.php"> Page d'acceuil </a></span>
                <i class='bx bx-chevron-down'></i>
            </div>
        </nav>

        <div class="home-content">
            <div class="container">
                <div class="text">La Liste des notes Note </div>

                <div>
                    <table style="width: 100%;">
                        <tr>
                            <th scope="col">NumCarte</th>
                            <th scope="col">NoteEtudiant</th>
                            <th scope="col">Matiere</th>
                            <th scope="col">Niveau</th>
                        </tr>

                        <?php
                        $requete = $PDO->query("SELECT * from note");
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
                        ?>
                </div>

            </div>
        </div>
    </section>
</body>

</html>