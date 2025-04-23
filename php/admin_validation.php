<?php
session_start();

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'administrateur') {
    header("Location: connexion.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "utilisateurs");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Sélection de tous les utilisateurs
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Comptes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f5f5; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #eee; }
        .btn-action {
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 5px;
        }
        .valider { background-color: green; }
        .revoquer { background-color: orange; }
        .supprimer { background-color: red; }
        .valide-ok {
            color: white;
            background-color: gray;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Gestion des comptes utilisateurs</h1>
    <p>Liste complète des comptes utilisateurs :</p>

    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        <?php while ($user = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($user['nom']) ?></td>
            <td><?= htmlspecialchars($user['prenom']) ?></td>
            <td><?= htmlspecialchars($user['pseudo']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['role']) ?></td>
            <td>
                <?= $user['valide'] ? '<span class="valide-ok">Validé</span>' : '<span style="color:red;">Non validé</span>' ?>
            </td>
            <td>
                <?php if ($user['valide'] == 0): ?>
                    <a class="btn-action valider" href="valider_utilisateur.php?id=<?= $user['id'] ?>">Valider</a>
                <?php else: ?>
                    <a class="btn-action revoquer" href="revoquer_utilisateur.php?id=<?= $user['id'] ?>">Révoquer</a>
                <?php endif; ?>
                <a class="btn-action supprimer" href="supprimer_utilisateur.php?id=<?= $user['id'] ?>" onclick="return confirm('Supprimer ce compte ?');">Supprimer</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
