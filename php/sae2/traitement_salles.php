<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=bdd_sae203;charset=utf8', 'root', '');

// Traitement des actions (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id'])) {
    $id = intval($_POST['id']);

    if ($_POST['action'] === 'supprimer') {
        $pdo->prepare("DELETE FROM reservations_salles WHERE id = ?")->execute([$id]);
    } elseif ($_POST['action'] === 'signer' && !empty($_POST['signature_admin'])) {
        $signature_admin = trim($_POST['signature_admin']);
        $pdo->prepare("UPDATE reservations_salles SET signature_admin = ? WHERE id = ?")->execute([$signature_admin, $id]);
    } elseif ($_POST['action'] === 'accepter' || $_POST['action'] === 'refuser') {
        $statut = $_POST['action'] === 'accepter' ? 'acceptée' : 'refusée';
        $pdo->prepare("UPDATE reservations_salles SET statut = ? WHERE id = ?")->execute([$statut, $id]);
    } elseif ($_POST['action'] === 'annuler') {
        // Met à jour le statut en 'annulée'
        $pdo->prepare("UPDATE reservations_salles SET statut = 'annulée' WHERE id = ?")->execute([$id]);
    }
}

// Récupération des réservations
$reservations = $pdo->query("SELECT * FROM reservations_salles ORDER BY date_reservation ASC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Liste des Réservations Salles</title>
  <style>
  </style>
</head>
<body>

<h2>Liste des Réservations Salles</h2>

<div class="reservations">
  <table>
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Num Étudiant</th>
        <th>Email</th>
        <th>Groupe TP</th>
        <th>Salle</th>
        <th>Date</th>
        <th>Début</th>
        <th>Fin</th>
        <th>Motif</th>
        <th>Participants</th>
        <th>Commentaires</th>
        <th>Signature</th>
        <th>Signature admin</th>
        <th>Date Soumission</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($reservations as $res): ?>
        <tr>
          <td><?= htmlspecialchars($res['nom']) ?></td>
          <td><?= htmlspecialchars($res['prenom']) ?></td>
          <td><?= htmlspecialchars($res['num_etudiant']) ?></td>
          <td><?= htmlspecialchars($res['adresse_email']) ?></td>
          <td><?= htmlspecialchars($res['groupe_tp']) ?></td>
          <td><?= htmlspecialchars($res['salle']) ?></td>
          <td><?= htmlspecialchars($res['date_reservation']) ?></td>
          <td><?= htmlspecialchars($res['heure_debut']) ?></td>
          <td><?= htmlspecialchars($res['heure_fin']) ?></td>
          <td><?= htmlspecialchars($res['motif']) ?></td>
          <td><?= htmlspecialchars($res['participants']) ?></td>
          <td><?= htmlspecialchars($res['commentaires']) ?></td>
          <td><?= htmlspecialchars($res['signature']) ?></td>
          <td><?= htmlspecialchars($res['signature_admin']) ?></td>
          <td><?= htmlspecialchars($res['date_soumission']) ?></td>
          <td><?= htmlspecialchars($res['statut']) ?></td>
          <td>
            <form method="post" style="display:inline;">
              <input type="hidden" name="id" value="<?= $res['id'] ?>">

              <?php if (empty($res['signature_admin'])): ?>
                <input type="text" name="signature_admin" placeholder="Nom Prénom admin" required>
                <button type="submit" name="action" value="signer">Signer</button>
              <?php else: ?>
                <?php if (trim(strtolower($res['statut'])) === 'en attente'): ?>
                  <button type="submit" name="action" value="accepter">Accepter</button>
                  <button type="submit" name="action" value="refuser">Refuser</button>
                <?php elseif (trim(strtolower($res['statut'])) === 'acceptée'): ?>
                  <button type="submit" name="action" value="annuler" onclick="return confirm('Annuler cette réservation ?')">Annuler</button>
                <?php endif; ?>
                <button type="submit" name="action" value="supprimer" onclick="return confirm('Supprimer cette réservation ?')">Supprimer</button>
              <?php endif; ?>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

</body>
</html>







