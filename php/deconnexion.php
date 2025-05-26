<?php
session_start();
session_destroy();
header('Location: ../html/connexion.html'); // redirige vers la page de connexion
exit;
?>