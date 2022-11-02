<?php
session_start();
if (isset($_SESSION["autoriser"])) {
  
}
else{header('location: connexionAdmin.php');
  exit();}
?>


<?php

require '../connectionDB.php';

if (
  isset($_POST['note']) && isset($_POST['numCard']) && isset($_POST['evaluation'])
  && isset($_POST['niveau']) && isset($_POST['matiere'])
) {
  $note = $_POST['note'];
  $numCard = $_POST['numCard'];
  $evaluation = $_POST['evaluation'];
  $niveau = $_POST['niveau'];
  $matiere = $_POST['matiere'];

  $idEval = $PDO->query("SELECT * FROM evaluation WHERE TypeEvaluation='$evaluation'");
  $idMatie = $PDO->query("SELECT * FROM matiere WHERE NomMatiere='$matiere'");
  if ($idEval->rowCount() > 0 && $idMatie->rowCount() > 0) {
    $IdE = $idEval->fetch()['IdEvaluation'];
    $IdM = $idMatie->fetch()['IdMatiere'];

    $stmt1 = $PDO->query("INSERT INTO note (numcarte,idEvaluation,IdMatiere,NoteEtudiant,niveau) values('$numCard','$IdE','$IdM','$note','$niveau')");
    header('location: admin.php');
  }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <link href='style_admin.css' rel='stylesheet'>
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
      <li style="background-color:#0d3073 ;">
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
          <i class='bx bx-user'></i>
          <span class="links_name">Publications</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-message'></i>
          <span class="links_name">Liste Utilisateur</span>
        </a>
      </li>
      <li>
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
        <div class="text">Ajouter une Note </div>
        <form method="POST">
          <div class="form-row">
            <div class="input-data">

              <input type="text" name="note" required>
              <div class="underline"></div>
              <label for="">Note de l'Etudiant</label>
            </div>

            <div class="input-data">
              <input type="text" name="numCard" required>
              <div class="underline"></div>
              <label for="">Numero de carte</label>
            </div>
          </div>

          <div class="form-row">

            <div class="input-data">
              <input type="text" name="email">
              <div class="underline"></div>
              <label for="">Appreciation</label>
            </div>

          </div>
          <div class="divselect">
            <div class="Evaluation">
              <div class="">Type Evaluation</div>
              <select class="" name="evaluation" id="" style="width: 205px; height: 30px;">
                <option value="Devoir sur table" selected>Devoir sur table</option>
                <option value="Devoir Maison">Devoir Maison</option>
                <option value="Examen">Examen</option>
                <option value="Controle continue">Controle continue</option>
                <option value="Projet">Projet</option>
                <option value="Note TP">Note TP</option>
              </select>
            </div>

            <div class="niveau">
              <div>Niveau</div>
              <select name="niveau" id="liste-Niveau" class="niveauselec" onChange="getMatiere(this.value);" style="width: 205px; height: 30px;">
                <option value="" selected>selectionner le niveau</option>
                <option value="cpi1">CPI1</option>
                <option value="cpi2">CPI2</option>
                <option value="ing1 info">ING1 INFO</option>
                <option value="ing1 meca">ING1 MECA</option>
                <option value="ing1 civil">ING1 CIVIL</option>
                <option value="ing2 info">ING2 INFO</option>
                <option value="ing2 meca">ING2 MECA</option>
                <option value="ing2 civil">ING2 CIVIL</option>
                <option value="ing3 info">ING3 INFO</option>
                <option value="ing3 meca">ING3 MECA</option>
                <option value="ing3 civil">ING3 CIVIL</option>
              </select>
            </div>
            <div class="matiere">
              <label>Matiere:</label>
              <br />
              <select name="matiere" id="list-matiere" class="boxInput" style="width: 205px; height: 30px;">
                <option value="">Sélectionnez la matiere</option>
              </select>
            </div>

          </div>

          <div class="form-row submit-btn">
            <div class="input-data">
              <div class="inner"></div>
              <input type="submit" value="Ajouter">
            </div>
          </div>
        </form>
      </div>

    </div>
    </div>
  </section>
</body>

</html>