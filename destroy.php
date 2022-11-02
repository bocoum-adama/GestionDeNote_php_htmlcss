<?php
session_start();
$_SESSION["login"]="";
header('location: connexion.php');
?>