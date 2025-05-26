<?php include '../pages/verif_enseignant.php'; ?>

<?php
// verifier_reservations.php

// Connexion à la base de données
$host = 'localhost';
$db = 'sae203'; // adapte selon ta config
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Réservations</title>
        <link rel="stylesheet" href="../../css/structure.css">
        <link rel="stylesheet" href="../../css/mesreservations.css">
    </head>
    <body>
        <nav class="menu">
            <img class="left" src="../../images/uge.png" alt="logo">
            <a href="index.php" class="overlay_left"></a>
            <div class="pages">
                <a href="./materiel.php"><div>Catalogue</div></a>
                <a href="./reserver_salles.php"><div>Salles</div></a>
                <a href="./reservations.php"><div>Mes Réservations</div></a>
            </div>
            <img class="right" src="../../images/compte.png" alt="compte">
            <a href="compte.php" class="overlay_right"></a>
        </nav>
        
        <section class="banniere">
            <div class="img-banniere"></div>
            <div class="txt_banniere">
                <h1>Réservations</h1>
            </div>
        </section>

        <h2> Vérifier vos réservations</h2>

        <form method="post" action="">
            <label for="email">Adresse email :</label><br />
            <input type="email" id="email" name="email" required /><br />

            <label for="num_etudiant">Numéro étudiant :</label><br />
            <input type="text" id="num_etudiant" name="num_etudiant" required /><br />

            <input type="submit" value="Vérifier les réservations" />
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST['email'] ?? '');
            $num_etudiant = trim($_POST['num_etudiant'] ?? '');

            if ($email === '' || $num_etudiant === '') {
                echo '<p class="error">Veuillez remplir tous les champs.</p>';
            } else {
                echo '<div class="results-container">';

                // Requête réservations matériel
                $stmt1 = $pdo->prepare("SELECT * FROM reservations WHERE adresse_email = ? AND num_etudiant = ?");
                $stmt1->execute([$email, $num_etudiant]);
                $res1 = $stmt1->fetch();

                echo '<div class="card">';
                echo '<h3>📦 Réservation de matériel</h3>';

                if ($res1) {
                    foreach ($res1 as $row) {
                        echo "<p><strong>Nom :</strong> " . htmlspecialchars($row['nom'] . ' ' . $row['prenom']) . "</p>";
                        echo "<p><strong>Numéro étudiant :</strong> " . htmlspecialchars($row['num_etudiant']) . "</p>";
                        echo "<p><strong>Email :</strong> " . htmlspecialchars($row['adresse_email']) . "</p>";
                        echo "<p><strong>Groupe TP :</strong> " . htmlspecialchars($row['groupe_tp']) . "</p>";
                        echo "<p><strong>Matériel :</strong> " . htmlspecialchars($row['materiel']) . "</p>";
                        echo "<p><strong>Date :</strong> " . htmlspecialchars($row['date_reservation']) . "</p>";
                        echo "<p><strong>Heure :</strong> " . htmlspecialchars($row['heure_debut']) . " - " . htmlspecialchars($row['heure_fin']) . "</p>";

                        $statut = strtolower($row['statut']);
                        if ($statut === 'accepté') {
                            echo '<p class="accepted">✅ Réservation acceptée</p>';
                        } elseif ($statut === 'refusé') {
                            echo '<p class="refused">❌ Réservation refusée</p>';
                        } else {
                            echo '<p class="pending">⏳ En attente de validation</p>';
                        }

                        if (!empty($row['signature_admin'])) {
                            echo "<p><strong>Signature admin :</strong> " . htmlspecialchars($row['signature_admin']) . "</p>";
                        }
                        if (!empty($row['commentaire'])) {
                            echo "<p><strong>Commentaire :</strong> " . htmlspecialchars($row['commentaire']) . "</p>";
                        }

                        echo "<br>"; // Pour séparer les réservations
                    }
                } else {
                    echo '<p class="no-result">Aucune réservation de matériel trouvée.</p>';
                }

                echo '</div>'; // fin card matériel

                // Requête réservations salle
                $stmt2 = $pdo->prepare("SELECT * FROM reservations_salles WHERE adresse_email = ? AND num_etudiant = ?");
                $stmt2->execute([$email, $num_etudiant]);
                $res2 = $stmt2->fetch();

                echo '<div class="card">';
                echo '<h3>🏫 Réservation de salle</h3>';

                if ($res2) {
                    foreach ($res2 as $row) {
                        echo "<p><strong>Nom :</strong> " . htmlspecialchars($row['nom'] . ' ' . $row['prenom']) . "</p>";
                        echo "<p><strong>Numéro étudiant :</strong> " . htmlspecialchars($row['num_etudiant']) . "</p>";
                        echo "<p><strong>Email :</strong> " . htmlspecialchars($row['adresse_email']) . "</p>";
                        echo "<p><strong>Groupe TP :</strong> " . htmlspecialchars($row['groupe_tp']) . "</p>";
                        echo "<p><strong>Salle :</strong> " . htmlspecialchars($row['salle']) . "</p>";
                        echo "<p><strong>Date :</strong> " . htmlspecialchars($row['date_reservation']) . "</p>";
                        echo "<p><strong>Heure :</strong> " . htmlspecialchars($row['heure_debut']) . " - " . htmlspecialchars($row['heure_fin']) . "</p>";
                        echo "<p><strong>Participants :</strong> " . htmlspecialchars($row['participants']) . "</p>";
                        echo "<p><strong>Date soumission :</strong> " . htmlspecialchars($row['date_soumission']) . "</p>";

                        $statut2 = strtolower($row['statut']);
                        if ($statut2 === 'accepté') {
                            echo '<p class="accepted">✅ Réservation acceptée</p>';
                        } elseif ($statut2 === 'refusé') {
                            echo '<p class="refused">❌ Réservation refusée</p>';
                        } else {
                            echo '<p class="pending">⏳ En attente de validation</p>';
                        }

                        if (!empty($row['signature_admin'])) {
                            echo "<p><strong>Signature admin :</strong> " . htmlspecialchars($row['signature_admin']) . "</p>";
                        }
                        if (!empty($row['commentaires'])) {
                            echo "<p><strong>Commentaires :</strong> " . htmlspecialchars($row['commentaires']) . "</p>";
                        }

                        echo "<br>"; // Pour séparer les réservations
                    }
                } else {
                    echo '<p class="no-result">Aucune réservation de salle trouvée.</p>';
                }

                echo '</div>'; // fin card salle

                echo '</div>'; // fin results-container
            }
        }
        ?>

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
