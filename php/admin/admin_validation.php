<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=sae203;charset=utf8', 'root', '');

// Liste des rôles possibles
$roles = ['Agent', 'Administrateur', 'Étudiant', 'Enseignant'];

// Traitement des actions (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id'])) {
    $id = intval($_POST['id']);

    if ($_POST['action'] === 'valider') {
        $pdo->prepare("UPDATE users SET valide = 1 WHERE id = ?")->execute([$id]);
    } elseif ($_POST['action'] === 'revoquer') {
        $pdo->prepare("UPDATE users SET valide = 0 WHERE id = ?")->execute([$id]);
    } elseif ($_POST['action'] === 'supprimer') {
        $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    } elseif ($_POST['action'] === 'changer_role' && isset($_POST['nouveau_role'])) {
        $nouveauRole = $_POST['nouveau_role'];

        // Sécurité : vérifier que le rôle choisi est bien dans la liste autorisée
        if (in_array($nouveauRole, $roles)) {
            $pdo->prepare("UPDATE users SET role = ? WHERE id = ?")->execute([$nouveauRole, $id]);
        }
    }
}

// Récupération des utilisateurs
$users = $pdo->query("SELECT * FROM users ORDER BY nom ASC")->fetchAll();
?>

<h2>Liste des Utilisateurs</h2>

<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Pseudo</th>
      <th>Email</th>
      <th>Rôle</th>
      <th>Statut</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= htmlspecialchars($user['nom']) ?></td>
        <td><?= htmlspecialchars($user['prenom']) ?></td>
        <td><?= htmlspecialchars($user['pseudo']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td>
          <!-- Formulaire pour changer le rôle -->
          <form method="post" style="margin:0;">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <select name="nouveau_role">
              <?php foreach ($roles as $role): ?>
                <option value="<?= $role ?>" <?= ($user['role'] === $role) ? 'selected' : '' ?>>
                  <?= $role ?>
                </option>
              <?php endforeach; ?>
            </select>
            <button type="submit" name="action" value="changer_role">Changer rôle</button>
          </form>
        </td>
        <td><?= $user['valide'] ? '✅ Validé' : '❌ Non validé' ?></td>
        <td>
          <form method="post" style="display:inline;">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <?php if (!$user['valide']): ?>
              <button type="submit" name="action" value="valider">Valider</button>
            <?php else: ?>
              <button type="submit" name="action" value="revoquer">Révoquer</button>
            <?php endif; ?>
            <button type="submit" name="action" value="supprimer" onclick="return confirm('Supprimer ce compte ?')">Supprimer</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>






