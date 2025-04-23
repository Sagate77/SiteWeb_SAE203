<?php
session_start();
$conn = new mysqli("localhost", "root", "", "utilisateurs");

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

        // Redirection selon le rôle
        switch ($user['role']) {
            case 'Etudiant':
                header("Location: index.php");
                break;
            case 'Enseignant':
                header("Location: enseignant.php");
                break;
            case 'Agent':
                header("Location: agent.php");
                break;
            case 'Administrateur':
                header("Location: administrateur.php");
                break;
            default:
                header("Location: page_principale.php");
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
