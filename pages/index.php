<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clínica Saúde</title>
  <link rel="stylesheet" href="../assets/css/style.css?v=1.2">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Dancing+Script:wght@400..700&family=Italiana&family=Josefin+Slab:ital,wght@0,100..700;1,100..700&family=Jost:ital,wght@0,100..900;1,100..900&family=Lemonada:wght@300..700&family=Lobster&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Playwrite+AU+SA:wght@100..400&family=Playwrite+SK:wght@100..400&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
  <header>
    <div class="container">
      <h1 class="logo">Clínica Saúde</h1>
      <nav>
        <ul class="menu">
          <li><a href=".container">Home</a></li>
          <li>
            <a href="#" id="btn-sobre" class="btn-login" style="background-color:#034370;">Sobre Nós</a>
            <div id="modal-sobre" class="modal-sobre"></div></li>
          <li><a href=".menu">Planos</a></li>
        </ul>
        <a href="login.php" class="btn-login">Entrar</a>
      </nav>
    </div>
  </header>
  <section>
  <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../assets/image/torres_de_lisboa1.jpg" class="d-block w-100" style="height: 100vh;" alt="...">
      <div class="position-absolute top-50 start-50 translate-middle d-flex justify-content-center gap-3" style="z-index: 10;">
          <div class="card" >
            <div class="card-body">
              <h5 class="card-title">Plano Basic</h5>
              <p class="card-text">Ideal para consultas básicas. Inclui 5 especialidades.</p>
              <p><strong>€19,90/mês</strong></p>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Plano Plus</h5>
              <p class="card-text">Cobertura ampliada com exames laboratoriais.</p>
              <p><strong>€29,90/mês</strong></p>
            </div>
          </div>
          <div class="card" >
            <div class="card-body">
              <h5 class="card-title">Plano Premium</h5>
              <p class="card-text">Acesso completo a todas as especialidades + urgência.</p>
              <p><strong>€49,90/mês</strong></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../assets//image/BLOG-AFFIX.png" class="d-block w-100 h" alt="..." style="height: 100vh;">
    </div>
    <div class="carousel-item">
      <img src="../assets/image/plano-de-saude-empresarial.jpg" class="d-block w-100" style="height: 100vh;" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
  </section>
  <main>
<section class="news-box">
  <h2>Últimas Notícias</h2>
  <div id="noticias-rss">
    <p>Carregando notícias...</p>
  </div>
</section>

  </main>
  <footer>
    <div class="footer-container">
      <div class="company-info">
        <h3>Clínica Saúde</h3>
        <p>Endereço: Rua das Flores, 123 – Centro, São Paulo – SP</p>
        <p>Telefone: (11) 1234-5678</p>
        <p>Email: contato@clinicasaude.com.br</p>
      </div>
      <div class="map-box">
        <h4>Localização da Clínica</h4>
        <div id="map"></div>
      </div>
    </div>
    <div class="social-media">
      <a href="#"><img src="../assets/image/facebookpq.png" alt="Facebook"></a>
      <a href="#"><img src="../assets/image/instagrampq.png" alt="Instagram"></a>
      <a href="#"><img src="../assets/image/twitterpq.png" alt="Twitter"></a>
    </div>
  </footer>
  <script src="../assets/js/maps.js"></script>
  <script src="../assets/js/noticias.js"></script>
  <script src="../assets/js/sobre.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
