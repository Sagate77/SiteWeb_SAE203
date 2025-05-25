<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Agent') {
    header("Location: ../../html/connexion.html");
    exit();
}
?>