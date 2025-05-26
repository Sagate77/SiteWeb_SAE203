<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Réservations</title>
        <link rel="stylesheet" href="../../css/structure.css">
        <link href="../../css/formulaire.css" rel="stylesheet" media="all">
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
                <h1>Réserver</h1>
            </div>
        </section>

        <div class="a4-container">
            <h2>Formulaire de réservation de matériel</h2>

            <form action="../formulaire/reservation_materiel_handler.php" method="POST">

                <div class="consignes">
                    <p>Informations de l’étudiant référent, responsable de récupérer et de remettre les clés de la salle à l'accueil. Il est tenu responsable du matériel. À la fin de l'utilisation, il doit remettre le matériel à sa place et fermer la porte à clé.</p>
                </div>

                <table>
                    <tr><td>Nom</td><td><input type="text" name="nom" required></td></tr>
                    <tr><td>Prénom</td><td><input type="text" name="prenom" required></td></tr>
                    <tr><td>Numéro Étudiant</td><td><input type="text" name="num_etudiant" required></td></tr>
                    <tr><td>Adresse Email</td><td><input type="email" name="adresse_email" required></td></tr>
                    <tr><td>Groupe TP</td><td><input type="text" name="groupe_tp" required></td></tr>
                    <tr><td>Matériel à réserver</td><td><input type="text" name="materiel" required></td></tr>
                    <tr><td>Heure de début (à partir de 8h30)</td><td><input type="time" name="heure_debut" min="08:30"></td></tr>
                    <tr>
                        <td>Heure de fin (jusqu'à 18h00)
                            <p class="note">
                                Respect obligatoire de l’horaire. Un contrôle du matériel sera effectué après.
                            </p>
                        </td>
                        <td><input type="time" name="heure_fin" max="18:00"></td>
                    </tr>
                </table>

                <h3>Motif de réservation :</h3>
                <textarea name="motif" rows="4"></textarea>

                <h3>Nom des étudiants participants au projet</h3>
                <table>
                    <tr>
                        <td>
                            Liste complète des participants
                            <p class="note">
                                Seules les personnes listées ici peuvent utiliser le matériel.
                            </p>
                        </td>
                        <td><textarea class="noms" name="nom_etudiant" rows="4"></textarea></td>
                    </tr>
                </table>

                <h3>Commentaires éventuels :</h3>
                <textarea name="commentaires" rows="5"></textarea>

                <div class="signature">
                    <label for="signature"><strong>Signature</strong></label>
                    <input type="text" name="signature" placeholder="Nom complet ou 'lu et approuvé'" required>
                    <p class="note">
                        Si vous ne pouvez pas signer électroniquement, vous pouvez joindre une photo de votre signature par mail.
                    </p>
                    <label for="uploadSignature">Importer une signature :</label>
                    <input type="file" id="uploadSignature" accept="image/*" onchange="previewSignature(event)">
                    <img id="signaturePreview" src="">
                </div>

                <div class="submit-container">
                    <button type="submit">Réserver</button>
                </div>
            </form>
        </div>

        <script>
            function previewSignature(event) {
                const output = document.getElementById('signaturePreview');
                output.src = URL.createObjectURL(event.target.files[0]);
            }
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
