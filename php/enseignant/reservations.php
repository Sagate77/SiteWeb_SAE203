<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Enseignant') {
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Réservations</title>
        <link rel="stylesheet" href="../../css/structure.css">
    </head>
    <body>
        <nav class="menu">
            <img class="left" src="../../imagesSite/uge.png" alt="logo">
            <a href="index.php" class="overlay_left"></a>
            <div class="pages">
                <a href="./salles.php"><div>Salles</div></a>
                <a href="./reserver.php"><div>Réserver</div></a>
                <a href="./reservations.php"><div>Mes Réservations</div></a>
            </div>
            <img class="right" src="../../imagesSite/compte.png" alt="compte">
            <a href="compte.php" class="overlay_right"></a>
        </nav>
        
        <section class="banniere">
            <div class="img-banniere"></div>
            <div class="txt_banniere">
                <h1>Réservations</h1>
            </div>
        </section>

        <footer>
            <div class="footer-container">
                <div class="footer-middle">
                    <p>2024-2025 BUT MMI</p>
                    <img src="../../imagesSite/uge.png" alt="Logo MMI" class="footer-logo">
                </div>
                <div class="footer-links">
                    <a href="../../html/propos.html">À propos</a>
                    <a href="../../html/propos.html">Mentions légales</a>
                </div>
            </div>
        </footer>
    </body>
</html>
