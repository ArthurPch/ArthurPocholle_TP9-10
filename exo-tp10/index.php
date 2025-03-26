<?php
require_once 'Model/pdo.php';
require_once 'Model/auth.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 10 - Authentification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Exercice 10 - Authentification</h1>
        
        <div class="flex justify-between items-center mb-4">
            <?php if (isLoggedIn()): ?>
                <a href="admin/index.php" class="text-blue-600 hover:underline">Accéder à l'administration</a>
                <a href="logout.php" class="text-red-600 hover:underline">Déconnexion</a>
            <?php else: ?>
                <a href="login.php" class="text-blue-600 hover:underline">Se connecter</a>
            <?php endif; ?>
        </div>
        
        <!-- Tableau des étudiants -->
        <h2 class="text-xl font-bold mb-2">Liste des étudiants</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-6">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Prénom</th>
                        <th scope="col" class="px-6 py-3">Nom</th>
                        <th scope="col" class="px-6 py-3">Classe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = $pdo->query("
                        SELECT e.prenom, e.nom, c.libelle as classe
                        FROM etudiants e
                        JOIN classes c ON e.classe_id = c.id
                    ");
                    while ($etudiant = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='bg-white border-b hover:bg-gray-50'>";
                        echo "<td class='px-6 py-4'>" . $etudiant['prenom'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $etudiant['nom'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $etudiant['classe'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- Tableau des professeurs -->
        <h2 class="text-xl font-bold mb-2">Liste des professeurs</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Prénom</th>
                        <th scope="col" class="px-6 py-3">Nom</th>
                        <th scope="col" class="px-6 py-3">Matière</th>
                        <th scope="col" class="px-6 py-3">Classe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = $pdo->query("
                        SELECT p.prenom, p.nom, m.lib AS matiere, c.libelle AS classe
                        FROM professeurs p
                        JOIN matiere m ON p.id_matiere = m.id
                        JOIN classes c ON p.id_classe = c.id
                    ");
                    while ($prof = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='bg-white border-b hover:bg-gray-50'>";
                        echo "<td class='px-6 py-4'>" . $prof['prenom'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $prof['nom'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $prof['matiere'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $prof['classe'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>