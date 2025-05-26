<?php
// connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=sae203;charset=utf8', 'root', '');

// Ajout d'une salle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'ajouter' && !empty(trim($_POST['nom_salle']))) {
        $nom_salle = trim($_POST['nom_salle']);
        $chemin = null;
        if (isset($_FILES['photo_salle']) && $_FILES['photo_salle']['error'] === UPLOAD_ERR_OK) {
            $nomFichier = basename($_FILES['photo_salle']['name']);
            $chemin = '../uploads/' . uniqid() . '_' . $nomFichier;
            move_uploaded_file($_FILES['photo_salle']['tmp_name'], $chemin);
        }
        $pdo->prepare("INSERT INTO salles (nom_salle, photo) VALUES (?, ?)")->execute([$nom_salle, $chemin]);
    }
    if ($_POST['action'] === 'supprimer' && isset($_POST['id_salle'])) {
        $id_salle = intval($_POST['id_salle']);
        $pdo->prepare("DELETE FROM salles WHERE id = ?")->execute([$id_salle]);
    }
}

// Récupérer toutes les salles
$salles = $pdo->query("SELECT * FROM salles ORDER BY nom_salle ASC")->fetchAll();
?>

<style>
</style>

<section id="gestion_salles">
  <h2>Gestion des Salles Disponibles</h2>

  <!-- Formulaire ajout salle -->
  <form method="post" action="" enctype="multipart/form-data">
    <input type="text" name="nom_salle" placeholder="Nom de la salle" required>
    <input type="file" name="photo_salle" accept="image/*">
    <button type="submit" name="action" value="ajouter">Ajouter Salle</button>
  </form>

  <!-- Tableau des salles -->
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom de la salle</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($salles) === 0): ?>
        <tr><td colspan="3" style="text-align:center; color: #666;">Aucune salle disponible</td></tr>
      <?php else: ?>
        <?php foreach ($salles as $salle): ?>
          <tr>
            <td><?= htmlspecialchars($salle['id']) ?></td>
            <td><?= htmlspecialchars($salle['nom_salle']) ?></td>
            <td>
              <form method="post" action="" onsubmit="return confirm('Supprimer cette salle ?');" style="display:inline;">
                <input type="hidden" name="id_salle" value="<?= $salle['id'] ?>">
                <button type="submit" name="action" value="supprimer" class="btn-supprimer">Supprimer</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</section>



