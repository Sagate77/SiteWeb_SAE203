<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['date_reservation'])) {
    $id = intval($_POST['id']);
    $date = $_POST['date_reservation'];

    $stmt = $conn->prepare("UPDATE reservations SET date_reservation = ? WHERE id = ?");
    $stmt->bind_param("si", $date, $id);

    if ($stmt->execute()) {
        echo "Date mise à jour";
    } else {
        http_response_code(500);
        echo "Erreur SQL : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Paramètres manquants";
}
