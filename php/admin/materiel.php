<?php include '../pages/verif_admin.php'; ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Matériel</title>
        <link rel="stylesheet" href="../../css/structure.css">
        <link rel="stylesheet" href="../../css/materiel.css">
    </head>
    <body>
        <nav class="menu">
            <img class="left" src="../../images/uge.png" alt="logo">
            <a href="index.php" class="overlay_left"></a>
            <div class="pages">
                <a href="./materiel.php"><div>Catalogue</div></a>
                <a href="./reserver_materiel.php"><div>Matériel</div></a>
                <a href="./reserver_salles.php"><div>Salles</div></a>
                <a href="./reservations.php"><div>Mes Réservations</div></a>
                <a href="./index_admin.php"><div>Administrateur</div></a>
            </div>
            <img class="right" src="../../images/compte.png" alt="compte">
            <a href="compte.php" class="overlay_right"></a>
        </nav>

        <section class="banniere">
            <div class="img-banniere"></div>
            <div class="txt_banniere">
                <h1>Catalogue</h1>
            </div>
        </section>

        <h2>Matériel</h2>
        <hr>

        <?php include '../pages/materiel.php'; ?>

        <h2>Salles</h2>
        <hr>

        <?php include '../pages/salles.php'; ?>

        <footer>
            <div class="footer-container">
                <div class="footer-middle">
                    <p>2024-2025 BUT MMI</p>
                    <img src="../../images/uge.png" alt="Logo MMI" class="footer-logo">
                </div>
                <div class="footer-links">
                    <a href="../../html/propos.html">À propos</a>
                    <a href="../../html/propos.html">Mentions légales</a>
                </div>
            </div>
        </footer>
    </body>
</html>