<?php
// Pas de session_start ici, car déjà dans index_admin.php

// Connexion BDD, ou mieux passer $conn depuis index_admin.php
$conn = new mysqli("localhost", "root", "", "bdd_sae203");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM users");
?>

<h2>Gestion des comptes utilisateurs</h2>
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
