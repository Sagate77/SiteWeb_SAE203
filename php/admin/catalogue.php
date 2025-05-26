<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'sae203';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer tout le matériel
    $stmt = $pdo->query("SELECT * FROM materiel");

    echo '<table border="1" cellpadding="5" cellspacing="0">';
    echo '<tr>
            <th>ID</th>
            <th>Référence</th>
            <th>Désignation</th>
            <th>Photo</th>
            <th>Type</th>
            <th>Date d\'achat</th>
            <th>État</th>
            <th>Quantité</th>
            <th>Descriptif</th>
            <th>Lien démo</th>
          </tr>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['reference']) . '</td>';
        echo '<td>' . htmlspecialchars($row['designation']) . '</td>';

        // Afficher la photo si elle existe, sinon "Aucune"
        if (!empty($row['photo'])) {
            echo '<td><img src="' . htmlspecialchars($row['photo']) . '" alt="Photo matériel" style="max-width:100px; max-height:100px;"></td>';
        } else {
            echo '<td>Aucune</td>';
        }

        echo '<td>' . htmlspecialchars($row['type']) . '</td>';
        echo '<td>' . htmlspecialchars($row['date_achat']) . '</td>';
        echo '<td>' . htmlspecialchars($row['etat']) . '</td>';
        echo '<td>' . htmlspecialchars($row['quantite']) . '</td>';
        echo '<td>' . nl2br(htmlspecialchars($row['descriptif'])) . '</td>';

        // Lien démo cliquable si présent, sinon "Aucun"
        if (!empty($row['lien_demo'])) {
            $lien = htmlspecialchars($row['lien_demo']);
            echo '<td><a href="' . $lien . '" target="_blank">Voir démo</a></td>';
        } else {
            echo '<td>Aucun</td>';
        }
        echo '</tr>';
    }

    echo '</table>';

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
