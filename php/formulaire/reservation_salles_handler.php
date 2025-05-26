<?php
session_start();
require 'db.php';

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$num_etudiant = $_POST['num_etudiant'];
$email = $_POST['adresse_email'];
$groupe = $_POST['groupe_tp'];
$salle = $_POST['salle'];
$date = $_POST['date_reservation'];
$heure_debut = $_POST['heure_debut'];
$heure_fin = $_POST['heure_fin'];
$motif = $_POST['motif'];
$participants = $_POST['nom_etudiant'];
$commentaires = $_POST['commentaires'];
$signature = $_POST['signature'];

// Préparation et exécution de la requête SQL
$stmt = $conn->prepare("INSERT INTO reservations_salles (nom, prenom, num_etudiant, adresse_email, groupe_tp, salle, date_reservation, heure_debut, heure_fin, motif, participants, commentaires, signature) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssss", $nom, $prenom, $num_etudiant, $email, $groupe, $salle, $date, $heure_debut, $heure_fin, $motif, $participants, $commentaires, $signature);
$stmt->execute();
$stmt->close();

// Redirection selon le rôle
switch ($_SESSION['role']) {
    case 'Etudiant':
        header("Location: ../etudiant/index.php");
        break;
    case 'Enseignant':
        header("Location: ../enseignant/index.php");
        break;
    case 'Agent':
        header("Location: ../agent/index.php");
        break;
    case 'Administrateur':
        header("Location: ../admin/index.php");
        break;
}
exit();
?>
