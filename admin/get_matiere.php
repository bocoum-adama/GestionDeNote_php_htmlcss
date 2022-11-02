<?php
require '../ConnectionDB.php';

if (!empty($_POST["id_niveau"])) {

	$results  = $PDO->query("SELECT * FROM matiere WHERE niveau = '" . $_POST["id_niveau"] . "' ");
?>
	<option value="">Sélectionnez la Matiere</option>
	<?php
	foreach ($results as $matiere) {
	?>
		<option value="<?php echo $matiere["NomMatiere"]; ?>"><?php echo $matiere["NomMatiere"]; ?></option>
<?php
	}
}
?>