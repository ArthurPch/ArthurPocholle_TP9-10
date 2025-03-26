<?php
require_once '../Model/pdo.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id === 0) {
    echo "ID d'étudiant non valide";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
$stmt->execute([$id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    echo "Étudiant non trouvé";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prenom']) && !empty($_POST['nom'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $classe_id = $_POST['classe_id'];
    
    $stmt = $pdo->prepare("UPDATE etudiants SET prenom = ?, nom = ?, classe_id = ? WHERE id = ?");
    $stmt->execute([$prenom, $nom, $classe_id, $id]);
    
    echo "Étudiant modifié avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier un étudiant</h1>
        
        <form method="post">
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $etudiant['prenom']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $etudiant['nom']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="classe_id" class="form-label">Classe</label>
                <select class="form-control" id="classe_id" name="classe_id">
                    <?php
                    $query = $pdo->query("SELECT * FROM classes");
                    while ($classe = $query->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($classe['id'] == $etudiant['classe_id']) ? 'selected' : '';
                        echo "<option value='" . $classe['id'] . "' $selected>" . $classe['libelle'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
        
        <p class="mt-3"><a href="../index.php">Retour à l'accueil</a></p>
    </div>
</body>
</html>