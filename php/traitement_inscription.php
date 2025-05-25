<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "sae203");
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Sécuriser les données
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$pseudo = $_POST['pseudo'];
$date_naissance = $_POST['date_naissance'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];
$role = $_POST['role'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

// Requête préparée
$stmt = $conn->prepare("INSERT INTO users (nom, prenom, pseudo, date_naissance, email, adresse, role, mot_de_passe, valide)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)");
$stmt->bind_param("ssssssss", $nom, $prenom, $pseudo, $date_naissance, $email, $adresse, $role, $mot_de_passe);

if ($stmt->execute()) {
    header("Location: connexion.php");
    exit();
} else {
    echo "Erreur: " . $stmt->error;
}
$stmt->close();
?>
