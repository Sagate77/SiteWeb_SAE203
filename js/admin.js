// Attend que la page soit chargée
document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('nav a:not(.exception)');
  const sections = document.querySelectorAll('.section');

  // Affiche la première section par défaut
  if (sections.length > 0) {
      sections[0].classList.add('active'); // Première section visible par défaut
      links[0].classList.add('active'); // Premier lien actif
  }

  links.forEach(link => {
      link.addEventListener('click', (e) => {
          e.preventDefault();

          // Retirer 'active' de tous les liens et sections
          links.forEach(l => l.classList.remove('active'));
          sections.forEach(s => s.classList.remove('active'));

          // Ajouter 'active' au lien cliqué
          link.classList.add('active');

          // Récupère l'ID de la section ciblée
          const targetId = link.getAttribute('data-target');
          const targetSection = document.getElementById(targetId);

          // Applique la classe 'active' pour afficher la bonne section
          if (targetSection) {
              targetSection.classList.add('active');
          }
      });
  });
});

  
  
  

