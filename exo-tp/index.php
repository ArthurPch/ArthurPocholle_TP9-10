<?php
require_once 'Model/pdo.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 9 - Manipulation SQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Exercice 9 - Manipulation SQL</h1>
        
        <h2>Liste des étudiants</h2>
        <ul>
            <?php
            $query = $pdo->query("SELECT * FROM etudiants");
            while ($etudiant = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>" . $etudiant['prenom'] . " " . $etudiant['nom'] . " <a href='Views/modif_etudiant.php?id=" . $etudiant['id'] . "'>Modifier</a> <a href='Views/suppression_etudiant.php?id=" . $etudiant['id'] . "'>Supprimer</a></li>";
            }
            ?>
        </ul>
        
        <h2>Liste des classes</h2>
        <ul>
            <?php
            $query = $pdo->query("SELECT * FROM classes");
            while ($classe = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>" . $classe['libelle'] . "</li>";
            }
            ?>
        </ul>
        
        <h2>Liste des professeurs</h2>
        <ul>
            <?php
            $query = $pdo->query("SELECT * FROM professeurs");
            while ($prof = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>" . $prof['prenom'] . " " . $prof['nom'] . "</li>";
            }
            ?>
        </ul>
        
        <h2>Professeurs avec matière et classe</h2>
        <ul>
            <?php
            $query = $pdo->query("
                SELECT p.prenom, p.nom, m.lib AS matiere, c.libelle AS classe
                FROM professeurs p
                JOIN matiere m ON p.id_matiere = m.id
                JOIN classes c ON p.id_classe = c.id
            ");
            while ($prof = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>" . $prof['prenom'] . " " . $prof['nom'] . " - Matière: " . $prof['matiere'] . " - Classe: " . $prof['classe'] . "</li>";
            }
            ?>
        </ul>        
    </div>
</body>
</html>