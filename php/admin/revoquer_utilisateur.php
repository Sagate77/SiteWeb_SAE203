<?php
$conn = new mysqli("localhost", "root", "", "sae203");
if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

$id = intval($_GET['id']);
$conn->query("UPDATE users SET valide = 0 WHERE id = $id");

header("Location: admin_validation.php");
exit();
