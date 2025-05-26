<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier de Réservation</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
    <link rel="stylesheet" href="../../css/calendar.css">
    <link rel="stylesheet" href="../../css/structure.css">
</head>
<body>
    <nav class="menu">
        <img class="left" src="../../images/uge.png" alt="logo">
        <a href="index.php" class="overlay_left"></a>
        <div class="pages">
            <a href="./materiel.php"><div>Catalogue</div></a>
            <a href="./reserver_materiel.php"><div>Matériel</div></a>
            <a href="./reserver_salles.php"><div>Salles</div></a>
            <a href="./reservations.php"><div>Mes Réservations</div></a>
            <a href="./index_admin.php"><div>Administrateur</div></a>
        </div>
        <img class="right" src="../../images/compte.png" alt="compte">
        <a href="compte.php" class="overlay_right"></a>
    </nav>

    <section class="banniere">
        <div class="img-banniere"></div>
        <div class="txt_banniere">
            <h1>Calendrier</h1>
        </div>
    </section>

    <div id='calendar'></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                dateClick: function (info) {
                    if (confirm(`Réserver le matériel pour le ${info.dateStr} ?`)) {
                        fetch('save_date.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `date_reservation=${encodeURIComponent(info.dateStr)}`
                        })
                        .then(response => response.text())
                        .then(data => {
                            alert('Date réservée avec succès : ' + info.dateStr);
                            console.log(data);
                            window.location.href = 'index.php'; // redirection après succès
                        })
                        .catch(error => {
                            alert("Erreur lors de la réservation.");
                            console.error(error);
                        });
                    }
                }
            });
            calendar.render();
        });
    </script>

    <footer>
        <div class="footer-container">
            <div class="footer-middle">
                <p>2024-2025 BUT MMI</p>
                <img src="../../images/uge.png" alt="Logo MMI" class="footer-logo">
            </div>
            <div class="footer-links">
                <a href="../../html/propos.html">À propos</a>
                <a href="../../html/propos.html">Mentions légales</a>
            </div>
        </div>
    </footer>
</body>
</html>
