<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Enseignant') {
    header("Location: ../connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
        <link rel="stylesheet" href="../../css/index.css">
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
                <h1>Accueil</h1>
            </div>
        </section>

        <section class="description">
            <div class="text">
                <p class="important">
                <b>Bienvenue sur la plateforme de réservation de matériels de l'IUT de Marne-la-Vallée à Meaux !</b>
                </p>
                <p>
                Ce site a été spécialement conçu pour permettre aux étudiants, enseignants et personnels de l’IUT de gérer facilement l’emprunt de matériel pédagogique, technique ou multimédia.
                Grâce à une interface simple et intuitive, vous pouvez consulter la disponibilité des équipements, effectuer vos réservations en quelques clics, et suivre l’historique de vos emprunts.
                </p>
                <p>
                Que ce soit pour un projet, un cours ou un événement, notre plateforme facilite l’accès aux ressources matérielles dont vous avez besoin au quotidien.
                </p>
                </div>
                <div class="img-panneau">
                <img src="../images/Salle138.JPG" alt="Panneau de destinations">
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
