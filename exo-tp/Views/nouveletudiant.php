<?php
require_once '../Model/pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prenom']) && !empty($_POST['nom'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $classe_id = $_POST['classe_id'];
    
    $stmt = $pdo->prepare("INSERT INTO etudiants (prenom, nom, classe_id) VALUES (?, ?, ?)");
    $stmt->execute([$prenom, $nom, $classe_id]);
    
    echo "Étudiant ajouté avec succès !";
}
?>

<p><a href="../index.php">Retour à l'accueil</a></p>