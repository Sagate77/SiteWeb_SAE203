<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date_reservation'])) {
    $date = $_POST['date_reservation'];

    // Récupère l'ID de la dernière réservation "en attente" sans date
    $sql = "SELECT id FROM reservations WHERE date_reservation IS NULL AND statut = 'en_attente' ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];

        // Mise à jour de la date
        $stmt = $conn->prepare("UPDATE reservations SET date_reservation = ? WHERE id = ?");
        $stmt->bind_param("si", $date, $id);

        if ($stmt->execute()) {
            echo "Date mise à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Aucune réservation trouvée à mettre à jour.";
    }
}

$conn->close();
?>
