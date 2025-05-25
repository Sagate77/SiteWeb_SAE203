<?php
$host = 'localhost';
$dbname = 'bdd_sae203';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

function uploadPhoto($file) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        $filename = uniqid() . '-' . basename($file['name']);
        $targetFile = $uploadDir . $filename;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileType, $allowedTypes)) return null;
        if (move_uploaded_file($file['tmp_name'], $targetFile)) return $targetFile;
    }
    return null;
}

if (isset($_POST['ajouter'])) {
    $reference = $_POST['reference'];
    $designation = $_POST['designation'];
    $photoPath = uploadPhoto($_FILES['photo'] ?? null);
    $type = $_POST['type'];
    $date_achat = !empty($_POST['date_achat']) ? $_POST['date_achat'] : null;
    $etat = $_POST['etat'];
    $quantite = (int)$_POST['quantite'];
    $descriptif = $_POST['descriptif'] ?? null;
    $lien_demo = $_POST['lien_demo'] ?? null;

    $sql = "INSERT INTO materiel (reference, designation, photo, type, date_achat, etat, quantite, descriptif, lien_demo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$reference, $designation, $photoPath, $type, $date_achat, $etat, $quantite, $descriptif, $lien_demo]);

    header("Location: index_admin.php");
    exit();
}

if (isset($_POST['modifier'])) {
    $id = (int)$_POST['id'];
    $reference = $_POST['reference'];
    $designation = $_POST['designation'];
    $type = $_POST['type'];
    $date_achat = !empty($_POST['date_achat']) ? $_POST['date_achat'] : null;
    $etat = $_POST['etat'];
    $quantite = (int)$_POST['quantite'];
    $descriptif = $_POST['descriptif'] ?? null;
    $lien_demo = $_POST['lien_demo'] ?? null;

    $photoPath = uploadPhoto($_FILES['photo'] ?? null);

    if ($photoPath) {
        $sql = "UPDATE materiel 
                SET reference = ?, designation = ?, photo = ?, type = ?, date_achat = ?, etat = ?, quantite = ?, descriptif = ?, lien_demo = ?
                WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$reference, $designation, $photoPath, $type, $date_achat, $etat, $quantite, $descriptif, $lien_demo, $id]);
    } else {
        $sql = "UPDATE materiel 
                SET reference = ?, designation = ?, type = ?, date_achat = ?, etat = ?, quantite = ?, descriptif = ?, lien_demo = ?
                WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$reference, $designation, $type, $date_achat, $etat, $quantite, $descriptif, $lien_demo, $id]);
    }

    header("Location: index_admin.php");
    exit();
}
?>









