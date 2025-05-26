<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Administrateur') {
    header("Location: ../../html/connexion.html");
    exit();
}
?>