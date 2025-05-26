<?php
include '../pages/verif_admin.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID invalide");
}
$id = intval($_GET['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Choisir la date</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>
</head>
<body>
    <h2>Choisissez une date pour finaliser votre réservation</h2>
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridMonth',
                selectable: true,
                dateClick: function (info) {
                    if (confirm(`Valider la date ${info.dateStr} ?`)) {
                        fetch('save_date.php', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                            body: `id=<?= $id ?>&date_reservation=${encodeURIComponent(info.dateStr)}`
                        })
                        .then(res => res.text())
                        .then(() => {
                            alert("Date enregistrée !");
                            window.location.href = '../index.php'; // Redirection page accueil
                        })
                        .catch(() => alert("Erreur lors de la sauvegarde"));
                    }
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
