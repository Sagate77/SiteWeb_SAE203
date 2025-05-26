<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Etudiant') {
    header("Location: ../../html/connexion.html");
    exit();
}
?>