<?php
    session_start();
    if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Administrateur') {
        header("Location: connexion.php");
        exit();
    }

    $pdo = new PDO('mysql:host=localhost;dbname=reservations_db;charset=utf8', 'root', '');
    $materiels = $pdo->query("SELECT * FROM materiels ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Matériel</title>
        <link rel="stylesheet" href="../../css/materiel.css">
        <link rel="stylesheet" href="../../css/structure.css">
    </head>
    <body>
        <nav class="menu">
            <img class="left" src="../../imagesSite/uge.png" alt="logo">
            <a href="index.php" class="overlay_left"></a>
            <div class="pages">
                <a href="./materiel.php"><div>Matériel</div></a>
                <a href="./salles.php"><div>Salles</div></a>
                <a href="./reserver.php"><div>Réserver</div></a>
                <a href="./reservations.php"><div>Réservations</div></a>
                <a href="./utilisateurs.php"><div>Utilisateurs</div></a>
            </div>
            <img class="right" src="../../imagesSite/compte.png" alt="compte">
            <a href="compte.php" class="overlay_right"></a>
        </nav>

        <section class="banniere">
            <div class="img-banniere"></div>
            <div class="txt_banniere">
                <h1>Matériel</h1>
            </div>
        </section>

        <h2>Catalogue</h2>
        <hr>

        <?php
        echo "<table class='catalogue'>";
        $i = 0;

        foreach ($materiels as $m) {
            // Nouvelle ligne tous les 3 matériel
            if ($i % 3 == 0) {
                echo "<tr>";
            }
            echo "<td>";
            ?>
            <div class="materiel">
                <?php if ($m['photo']): ?>
                    <img src="<?= htmlspecialchars($m['photo']) ?>" alt="photo">
                <?php endif; ?>
                <div>
                    <div class="infos titre"><?= htmlspecialchars($m['designation']) ?></div><br>
                    <div class="infos">Réf : <?= htmlspecialchars($m['reference']) ?></div>
                    <div class="infos">Type : <?= htmlspecialchars($m['type']) ?></div>
                    <div class="infos">État : <?= htmlspecialchars($m['etat']) ?></div>
                    <div class="infos">Qté : <?= intval($m['quantite']) ?></div><br>

                    <?php if ($m['descriptif']): ?>
                        <div class="infos descriptif"><?= nl2br(htmlspecialchars($m['descriptif'])) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            echo "</td>";
            // Ferme la ligne après 3 matériel
            if ($i % 3 == 2) {
                echo "</tr>";
            }
            $i++;
        }
        // Si le dernier <tr> n'est pas fermé (par exemple si $materiels a un nombre non multiple de 3)
        if ($i % 3 != 0) {
            // Compléter avec des <td> vides
            for ($j = 0; $j < 3 - ($i % 3); $j++) {
                echo "<td></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>

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