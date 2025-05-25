<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin - Tableau de bord</title>
  <link rel="stylesheet" href="admin.css">

</head>
<body>
  <header>
    <h1>Tableau de bord Administrateur</h1>
  </header>
<nav>
  <ul>
    <li><a href="index_matos.php">Matériel</a></li>
    <li><a href="#" data-target="reservations">Réservations</a></li>
    <li><a href="#" data-target="salles">Salles</a></li>
    <li><a href="/sae2/utilisateurs.php">Utilisateurs</a></li>
    <li><a href="#" data-target="catalogue">Catalogue</a></li>
  </ul>
</nav>
<!-- Reserver -->
<section id="reservations" class="section">
  <?php include 'traitement.php'; ?>
</section>
</body>
</html>