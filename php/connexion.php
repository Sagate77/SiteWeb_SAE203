<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - Université Gustave Eiffel</title>
  <link rel="stylesheet" href="../css/connexion.css">
</head>
<body>
  <div class="taille">
    <div class="background">
      <div class="login-box">
        <img src="../imagesSite/logoiut2.png" alt="Université Gustave Eiffel" class="logo">
        <h2>Se Connecter</h2>

        <form action="traitement_connexion.php" method="POST">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" placeholder="Email" required>

          <label for="mot_de_passe">Mot de Passe</label>
          <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="******" required>

          <button type="submit" class="btn">Connexion</button>
          <button type="button" class="btn secondary" onclick="window.location.href='inscription.php'">Inscription</button>

        </form>
      </div>
    </div> 
    <footer>
      <div class="footer-container">
        <div class="footer-middle">
          <p>2024-2025 BUT MMI</p>
          <img src="../imagesSite/test.png" alt="Logo MMI" class="footer-logo">
        </div>
        <div class="footer-links">
          <a href="html/propos.html">À propos</a>
          <a href="html/propos.html">Mentions légales</a>
        </div>
      </div>
    </footer>
  </div> 
</body>
