<?php
    $pdo = new PDO('mysql:host=localhost;dbname=sae203;charset=utf8', 'root', '');
    $salles = $pdo->query("SELECT * FROM salles ORDER BY nom_salle DESC")->fetchAll();

    echo "<table class='catalogue'>";
    $i = 0;

    foreach ($salles as $s) {
        // Nouvelle ligne toutes les 3 salles
        if ($i % 3 == 0) {
            echo "<tr>";
        }
        echo "<td>";
            echo '<div class="salles">';
            if (!empty($s['photo']) && file_exists($s['photo'])) {
                echo '<img src="' . htmlspecialchars($s['photo']) . '" alt="photo">';
            } else {
                echo 'Pas de photo';
            }

            echo '<div class="infos titre_salle">' . htmlspecialchars($s['nom_salle']) . '</div><br>';

            echo '</div>';
        echo "</td>";
        // Ferme la ligne après 3 salles
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