document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.sidebar-nav a');
  const container = document.getElementById('contenido-dinamico');

  links.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const page = this.getAttribute('data-page');

      fetch(page)
        .then(res => res.text())
        .then(html => {
          container.innerHTML = html;
        })
        .catch(() => {
          container.innerHTML = "<p>Error al cargar el contenido.</p>";
        });
    });
  });
});
