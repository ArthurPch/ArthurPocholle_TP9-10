<?php
require_once '../Model/pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['libelle'])) {
    $libelle = $_POST['libelle'];
    
    $stmt = $pdo->prepare("INSERT INTO matiere (lib) VALUES (?)");
    $stmt->execute([$libelle]);
    
    echo "Matière ajoutée avec succès !";
}
?>

<p><a href="../index.php">Retour à l'accueil</a></p>