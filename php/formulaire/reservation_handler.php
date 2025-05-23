<?php
require 'db.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$num_etudiant = $_POST['num_etudiant'];
$email = $_POST['adresse_email'];
$groupe = $_POST['groupe_tp'];
$materiel = $_POST['materiel'];
$signature = $_POST['signature'];

$stmt = $conn->prepare("INSERT INTO reservations (nom, prenom, num_etudiant, adresse_email, groupe_tp, materiel, signature) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $nom, $prenom, $num_etudiant, $email, $groupe, $materiel, $signature);
$stmt->execute();
$stmt->close();

header("Location: ../calendar.html");
exit();
?>
