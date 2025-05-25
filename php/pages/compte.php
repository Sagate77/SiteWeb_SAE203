<?php
echo '<p class="infos">';
    if (isset($_SESSION['role'])) {
        echo '<b>' . $_SESSION['role'] . '</b><br><br>';
    }
    
    echo '<b>Nom : </b>';
    if (isset($_SESSION['nom'])) {
        echo $_SESSION['nom'];
    }
    echo '<br>';

    echo '<b>Prenom : </b>';
    if (isset($_SESSION['prenom'])) {
        echo $_SESSION['prenom'];
    }
    echo '<br>';
    
    if (!empty($_SESSION['pseudo'])) {
        echo "<b>Pseudo : </b>" . $_SESSION['pseudo'] . "<br>";
    }

    echo '<b>Date de naissance : </b>';
    if (isset($_SESSION['date_naissance'])) {
        echo $_SESSION['date_naissance'];
    }
    echo '<br>';

    echo '<b>E-mail : </b>';
    if (isset($_SESSION['email'])) {
        echo $_SESSION['email'];
    }
    echo '<br>';

    echo '<b>Adresse postale : </b>';
    if (isset($_SESSION['adresse'])) {
        echo $_SESSION['adresse'];
    }
    echo '<br>';
echo '</p>';
?>