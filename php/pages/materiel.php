<?php
    $pdo = new PDO('mysql:host=localhost;dbname=sae203;charset=utf8', 'root', '');
    $materiels = $pdo->query("SELECT * FROM materiel ORDER BY id DESC")->fetchAll();

    echo "<table class='catalogue'>";
    $i = 0;

    foreach ($materiels as $m) {
        // Nouvelle ligne tous les 3 matériel
        if ($i % 3 == 0) {
            echo "<tr>";
        }
        echo "<td>";
            echo '<div class="materiel">';
            if (!empty($m['photo']) && file_exists($m['photo'])) {
                echo '<img src="' . htmlspecialchars($m['photo']) . '" alt="photo">';
            } else {
                echo 'Pas de photo';
            }

            echo '<div><div class="infos titre">' . htmlspecialchars($m['designation']) . '</div><br>';
            echo '<div class="infos">Réf : ' . htmlspecialchars($m['reference']) . '</div>';
            echo '<div class="infos">Type : ' . htmlspecialchars($m['type']) . '</div>';
            echo '<div class="infos">État : ' . htmlspecialchars($m['etat']) . '</div>';
            echo '<div class="infos">Quantité : ' . intval($m['quantite']) . '</div>';
            echo '<div class="infos"><a href="' . htmlspecialchars($m['lien_demo']) . '">Voir la démo</a></div><br>';
            
            if ($m['descriptif']):
                echo '<div class="infos descriptif">' . nl2br(htmlspecialchars($m['descriptif'])) . '</div>';
                /*
                <div class="infos descriptif"><?= nl2br(htmlspecialchars($m['descriptif'])) ?></div>
                */
            endif;
            echo '</div></div>';
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