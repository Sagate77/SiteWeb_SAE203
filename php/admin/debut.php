<?php
session_start();

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'administrateur') {
    header("Location: ../../html/connexion.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "sae203");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
?>