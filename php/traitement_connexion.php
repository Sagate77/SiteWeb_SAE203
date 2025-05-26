<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sae203");

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];


// Sécurisation contre injection SQL avec prepare
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($mot_de_passe, $user['mot_de_passe'])) {

        if (!$user['valide']) {
            echo "⚠️ Votre compte n'a pas encore été validé par un administrateur.";
            exit();
        }

        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['date_naissance'] = $user['date_naissance'];
        $_SESSION['adresse'] = $user['adresse'];

        // Redirection selon le rôle
        switch ($user['role']) {
            case 'Etudiant':
                header("Location: ./etudiant/index.php");
                break;
            case 'Enseignant':
                header("Location: ./enseignant/index.php");
                break;
            case 'Agent':
                header("Location: ./agent/index.php");
                break;
            case 'Administrateur':
                header("Location: ./admin/index.php");
                break;
        }
        exit();
    } else {
        echo "❌ Mot de passe incorrect.";
    }
} else {
    echo "❌ Email introuvable.";
}

$conn->close();
?>
