<?php
$conn = new mysqli("localhost", "root", "", "utilisateurs");
if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

$id = intval($_GET['id']);
$conn->query("DELETE FROM users WHERE id = $id");

header("Location: admin_validation.php");
exit();
