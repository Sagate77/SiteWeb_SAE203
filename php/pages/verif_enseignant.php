<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Enseignant') {
    header("Location: ../../html/connexion.html");
    exit();
}
?>