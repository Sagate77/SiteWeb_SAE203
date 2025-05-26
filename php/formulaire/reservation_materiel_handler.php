<?php
session_start(); // Démarrer la session pour accéder à $_SESSION
require 'db.php';

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$num_etudiant = $_POST['num_etudiant'];
$email = $_POST['adresse_email'];
$groupe = $_POST['groupe_tp'];
$materiel = $_POST['materiel'];
$signature = $_POST['signature'];
$date_reservation = $_POST['date_reservation'];
$heure_debut = $_POST['heure_debut'];
$heure_fin = $_POST['heure_fin'];
$commentaire = $_POST['commentaire'];
$signature_admin = null; // Vide à la création

// Préparation de la requête d'insertion
$stmt = $conn->prepare("
    INSERT INTO reservations 
    (nom, prenom, num_etudiant, adresse_email, groupe_tp, materiel, signature, date_reservation, heure_debut, heure_fin, commentaire, signature_admin)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("ssssssssssss", 
    $nom, 
    $prenom, 
    $num_etudiant, 
    $email, 
    $groupe, 
    $materiel, 
    $signature, 
    $date_reservation, 
    $heure_debut, 
    $heure_fin, 
    $commentaire, 
    $signature_admin
);

$stmt->execute();
$stmt->close();

// Redirection selon le rôle
switch ($_SESSION['role']) {
    case 'Etudiant':
        header("Location: ../etudiant/calendar.php");
        break;
    case 'Enseignant':
        header("Location: ../enseignant/calendar.php");
        break;
    case 'Agent':
        header("Location: ../agent/calendar.php");
        break;
    case 'Administrateur':
        header("Location: ../admin/calendar.php");
        break;
    default:
        header("Location: ../index.php"); // Redirection par défaut
}
exit();
?>
