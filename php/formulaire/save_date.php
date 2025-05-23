<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);
$date = $data['date'];

$conn->query("UPDATE reservations SET date_reservation='$date' WHERE id=(SELECT MAX(id) FROM reservations)");
?>
