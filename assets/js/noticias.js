document.addEventListener("DOMContentLoaded", function () {
    fetch('noticias.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('noticias-rss').innerHTML = data;
      })
      .catch(error => {
        document.getElementById('noticias-rss').innerHTML = "<p>Erro ao carregar notícias.</p>";
        console.error('Erro ao carregar o RSS:', error);
      });
  });
  