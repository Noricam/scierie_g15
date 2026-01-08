document.addEventListener('DOMContentLoaded', async () => {
  const container = document.getElementById('container');
  if (!container) return;

  try {
    const res = await fetch('/app/controleur/initFormListeProduits.php', {
      method: 'GET',
      credentials: 'same-origin',
      headers: { 'Accept': 'text/html' },
      cache: 'no-store'
    });

    if (!res.ok) {
      throw new Error(`HTTP ${res.status}`);
    }

    const html = await res.text();
    container.innerHTML = html;
  } catch (err) {
    console.error('Erreur chargement produits:', err);
    container.textContent = "Impossible de charger les produits pour le moment.";
  }
});
