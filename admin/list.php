<?php
// Code spécifique à mon application
require '../ConnectionDB.php';


// On récupère le type demandé
$type = empty($_GET['type']) ? 'matiere' : $_GET['type'];
if ($type === 'matiere') {
    $table = 'matiere';
    $foreign = 'niveau';
}else {
    throw new Exception('Unknown type ' . $type);
}

// On récupère les élément depuis la base de données
$query = $PDO->prepare("SELECT IdMatiere, NomMatiere FROM $table WHERE $foreign = ?");
$query->execute([$_GET['filter']]);
$items = $query->fetchAll();
// On renvoie les données au format JSON en choisissant des clefs spécifiques
header('Content-Type: application/json');
echo json_encode(array_map(function ($item) {
    return [
        'label' => $item['NomMatiere'],
        'value' => $item['IdMatiere']
    ];
}, $items));