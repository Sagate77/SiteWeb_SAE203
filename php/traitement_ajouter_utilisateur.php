<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "Connecter";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Nettoyage des données
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $mot_de_passe_clair = $_POST["mot_de_passe"];

        // Vérification que le mot de passe fait au moins 6 caractères
        if (strlen($mot_de_passe_clair) < 6) {
            die("Le mot de passe doit contenir au moins 6 caractères.");
        }


        // Insertion en base
        $requete = $connexion->prepare("INSERT INTO connecter (email, mot_de_passe) VALUES (:email, :mot_de_passe)");
        $requete->execute([
            'email' => $email,
            'mot_de_passe' => $mot_de_passe_hash
        ]);

        echo "Utilisateur ajouté avec succès.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
