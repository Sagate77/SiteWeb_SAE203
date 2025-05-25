<?php
session_start();

// Vérifie que seul l'admin peut valider
if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'administrateur') {
    header("Location: ../../html/connexion.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "sae203");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupère l'ID de l'utilisateur à valider
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("UPDATE users SET valide = 1 WHERE id = $id");
}

$conn->close();
header("Location: admin_validation.php");
exit();
