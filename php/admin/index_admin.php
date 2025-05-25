<?php
session_start();

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'administrateur') {
    header("Location: connexion.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "bdd_sae203");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="fr"
<head>
  <meta charset="UTF-8">
  <title>Admin - Tableau de bord</title>
  <link rel="stylesheet" href="admin.css">
  <script defer src="admin.js"></script>
</head>
<body>
  <header>
    <h1>Tableau de bord Administrateur</h1>
  </header>

  <nav>
    <ul>
      <li><a href="#" data-target="materiel">Matériel</a></li>
      <li><a href="#" data-target="reservations">Réservations</a></li>
      <li><a href="#" data-target="salles">Salles</a></li>
      <li><a href="#" data-target="utilisateurs">Utilisateurs</a></li>
      <li><a href="#" data-target="catalogue">Catalogue</a></li>
    </ul>
  </nav>

  <main>

    <!-- MATÉRIEL -->
    <section id="materiel" class="section active">
      <h2>Gestion du Matériel</h2>

      <!-- Ajout -->
      <form action="materiel.php" method="POST" enctype="multipart/form-data">
        <label>Référence :</label>
        <input type="text" name="reference" required>

        <label>Désignation :</label>
        <input type="text" name="designation" required>

        <label>Photo :</label>
        <input type="file" name="photo" accept="image/*">

        <label>Type :</label>
        <input type="text" name="type" required>

        <label>Date d'achat :</label>
        <input type="date" name="date_achat">

        <label>État :</label>
        <select name="etat" required>
          <option value="neuf">Neuf</option>
          <option value="bon">Bon</option>
          <option value="usagé">Usagé</option>
        </select>

        <label>Quantité :</label>
        <input type="number" name="quantite" min="0" required>

        <label>Descriptif :</label>
        <textarea name="descriptif"></textarea>

        <label>Lien démo :</label>
        <input type="url" name="lien_demo">

        <button type="submit" name="ajouter">Ajouter le matériel</button>
      </form>

      <br>

      <!-- Modification -->
      <form action="materiel.php" method="POST" enctype="multipart/form-data">
        <label>ID du matériel à modifier :</label>
        <input type="number" name="id" required>

        <label>Nouvelle Référence :</label>
        <input type="text" name="reference" required>

        <label>Nouvelle Désignation :</label>
        <input type="text" name="designation" required>

        <label>Nouvelle Photo :</label>
        <input type="file" name="photo" accept="image/*">

        <label>Nouveau Type :</label>
        <input type="text" name="type" required>

        <label>Nouvelle Date d'achat :</label>
        <input type="date" name="date_achat">

        <label>Nouvel État :</label>
        <select name="etat" required>
          <option value="neuf">Neuf</option>
          <option value="bon">Bon</option>
          <option value="usagé">Usagé</option>
        </select>

        <label>Nouvelle Quantité :</label>
        <input type="number" name="quantite" min="0" required>

        <label>Nouveau Descriptif :</label>
        <textarea name="descriptif"></textarea>

        <label>Nouveau Lien démo :</label>
        <input type="url" name="lien_demo">

        <button type="submit" name="modifier">Modifier</button>
      </form>
    </section>

    <!-- RÉSERVATIONS -->
    <section id="reservations" class="section">
      <?php include 'traitement.php'; ?>
    <!-- RÉSERVATIONS Salles -->
     <br>
    <?php include 'traitement_salles.php'; ?>
    </section>

    <!-- SALLES -->
    <section id="salles" class="section">
     <?php include 'gestion_salles.php'; ?>
    </section>

    <!-- CATALOGUE -->
    <section id="catalogue" class="section">
      <h2>Catalogue du Matériel</h2>
      <?php include 'catalogue.php'; ?>
    </section>
    

    <!-- UTILISATEURS -->
    <section id="utilisateurs" class="section">
      <?php
        $result = $conn->query("SELECT * FROM users");
        include 'admin_validation.php';
      ?>
    </section>

  </main>

  <footer>
    <p>&copy; 2025 - Interface Admin</p>
  </footer>
</body>
</html>

