<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Agent') {
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil agent</title>
</head>
<body>
  <h1>Bienvenue, agent !</h1>
  <p>Vous êtes connecté avec l'email : <?php echo $_SESSION['email']; ?></p>
  <a href="deconnexion.php">Se déconnecter</a>
</body>
</html>
