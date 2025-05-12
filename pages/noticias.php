<?php
require_once '../includes/conexao.php';

echo "<h3>Notícias da Clínica</h3>";

$noticias = $conn->query("SELECT * FROM noticias_rss ORDER BY data_publicacao DESC LIMIT 3");
if ($noticias->num_rows > 0) {
  while ($n = $noticias->fetch_assoc()) {
    echo "<div class='news-item'>";
    echo "<a href='" . htmlspecialchars($n['link']) . "' target='_blank'>" . htmlspecialchars($n['titulo']) . "</a>";
    echo "<p>" . date("d/m/Y H:i", strtotime($n['data_publicacao'])) . "</p>";
    echo "</div>";
  }
} else {
  echo "<p>Nenhuma notícia cadastrada pela clínica.</p>";
}

echo "<hr><h3>Notícias Nacionais</h3>";

$url = "https://www.gov.br/aids/pt-br/assuntos/noticias/site-feed/RSS";
$rss = simplexml_load_file($url);

if ($rss && isset($rss->item)) {
    echo "<h3>Notícias de Saúde - gov.br/aids</h3>";

    $limite = 5;
    $contador = 0;

    foreach ($rss->item as $item) {
        if ($contador >= $limite) break;

        $titulo = (string) $item->title;
        $link = (string) $item->link;
        $data = isset($item->children('dc', true)->date) 
                ? date("d/m/Y", strtotime((string) $item->children('dc', true)->date)) 
                : '';
        $imagem = "https://www.gov.br/aids/logo.png";        echo "<div class='news-item';>";
        echo "<img src='$imagem' alt='Imagem da notícia' style='max-width:120px; display:block; margin-bottom:8px; margin:auto;'>";
        echo "<a href='$link' target='_blank'>" . htmlspecialchars($titulo) . "</a><br>";
        if ($data) echo "<small>Publicado em: $data</small>";
        echo "</div><hr>";

        $contador++;
    }
} else {
    echo "<p>Não foi possível carregar as notícias do gov.br.</p>";
}
?>

