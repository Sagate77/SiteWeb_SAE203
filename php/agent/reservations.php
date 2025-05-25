<?php include '../pages/verif_agent.php'; ?>

<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'sae203';
$username = 'root'; // remplace par ton utilisateur
$password = '';     // remplace par ton mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

// Requête 1 : Réservations de salles acceptées
$sqlSalles = "
    SELECT *
    FROM reservations_salles
    WHERE statut = 'accepté'
    ORDER BY date_reservation DESC, heure_debut ASC
";

// Requête 2 : Réservations de matériel acceptées
$sqlMateriel = "
    SELECT *
    FROM reservations
    WHERE statut = 'accepté'
    ORDER BY date_reservation DESC, heure_debut ASC
";

try {
    $salles = $pdo->query($sqlSalles)->fetchAll(PDO::FETCH_ASSOC);
    $materiels = $pdo->query($sqlMateriel)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de l'exécution des requêtes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Réservations</title>
        <link rel="stylesheet" href="../../css/structure.css">
        <link rel="stylesheet" href="../../css/agent_reservations.css">
    </head>
    <body>
        <nav class="menu">
            <img class="left" src="../../imagesSite/uge.png" alt="logo">
            <a href="index.php" class="overlay_left"></a>
            <div class="pages">
                <a href="./reservations.php"><div>Réservations</div></a>
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

        <div class="reservations">
        <!-- Tableau des réservations de salles -->
        <h2>Réservations de Salles</h2>
        <?php if (count($salles) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Salle</th>
                        <th>Date</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Motif</th>
                        <th>Participants</th>
                        <th>Commentaires</th>
                        <th>Signature Admin</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($salles as $res): ?>
                        <tr>
                            <td><?= htmlspecialchars($res['nom']) ?></td>
                            <td><?= htmlspecialchars($res['prenom']) ?></td>
                            <td><?= htmlspecialchars($res['salle']) ?></td>
                            <td><?= htmlspecialchars($res['date_reservation']) ?></td>
                            <td><?= htmlspecialchars($res['heure_debut']) ?></td>
                            <td><?= htmlspecialchars($res['heure_fin']) ?></td>
                            <td><?= htmlspecialchars($res['motif']) ?></td>
                            <td><?= htmlspecialchars($res['participants']) ?></td>
                            <td><?= htmlspecialchars($res['commentaires']) ?></td>
                            <td><?= htmlspecialchars($res['signature_admin']) ?></td>
                            <td><?= htmlspecialchars($res['statut']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune réservation de salle acceptée.</p>
        <?php endif; ?>

        <!-- Tableau des réservations de matériel -->
        <h2>Réservations de Matériel</h2>
        <?php if (count($materiels) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Matériel</th>
                        <th>Date</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Commentaire</th>
                        <th>Signature Admin</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($materiels as $res): ?>
                        <tr>
                            <td><?= htmlspecialchars($res['nom']) ?></td>
                            <td><?= htmlspecialchars($res['prenom']) ?></td>
                            <td><?= htmlspecialchars($res['materiel']) ?></td>
                            <td><?= htmlspecialchars($res['date_reservation']) ?></td>
                            <td><?= htmlspecialchars($res['heure_debut']) ?></td>
                            <td><?= htmlspecialchars($res['heure_fin']) ?></td>
                            <td><?= htmlspecialchars($res['commentaire']) ?></td>
                            <td><?= htmlspecialchars($res['signature_admin']) ?></td>
                            <td><?= htmlspecialchars($res['statut']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune réservation de matériel acceptée.</p>
        <?php endif; ?>
        </div>

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
