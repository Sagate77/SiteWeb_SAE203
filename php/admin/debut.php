<?php
session_start();

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'administrateur') {
    header("Location: connexion.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "bdd_sae203");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
?>