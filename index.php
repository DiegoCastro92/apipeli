<?php
include('main.css');

//Llamamos a la api para conseguir los datos
const API_URL = "https://whenisthenextmcufilm.com/api";
//Iniciamos las peticiones
$ch = curl_init(API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Conseguimos el json de la api
$result = curl_exec($ch);
$data = json_decode($result);
//Cerramos la conexión curl
curl_close($ch);

if (isset($_GET['lang'])) {
  // Obtiene el valor de 'lang'
  $lang = $_GET['lang'];
} else {
  // Si 'lang' no está presente, puedes definir un valor predeterminado
  $lang = 'es'; // Por ejemplo, inglés por defecto
}

switch ($lang) {
  case 'es':
    $encabezado = "La próxima película es: ";
    $encabezado1 = " y se estrena en ";
    $proxima = "La siguiente película es: ";
    $proxima1 = "que se estrenará el próximo ";
    $elegir = "Elige el idioma a mostrar en la web:";
    $español = "Español";
    $ingles = "Inglés";
    $default = "Español";
    break;
  case 'en':
    $encabezado = "The next movie is: ";
    $encabezado1 = " and it will be released in ";
    $proxima = "Next movie is: ";
    $proxima1 = "which will be released on the following ";
    $elegir = "Choose the language to display on the website:";
    $español = "Spanish";
    $ingles = "English";
    $default = "Spanish";
    break;
  default:
    $encabezado = "El siguiente film es: ";
    $encabezado1 = " y saldrá el día ";
    $proxima = "El siguiente film es: ";
    $proxima1 = "el cual se estrenará el día ";
    $elegir = "Selecciona el idioma que deseas ver en la web:";
    $español = "Español (es)";
    $ingles = "Ingles (en)";
    $default  = "Default Español (es)";
    break;
}
?>

<header>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
</header>

<body>
  <div class="container">
    <?= $elegir; ?>
    <br><br>
    <a href="?lang=es"><?= $español; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
    <a href="?lang=en"><?= $ingles; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
    <a href="?lang=default"><?= $default; ?></a>
    <br><br>
  </div>
  <hr>
  <div class="container">
    <h3><?= $encabezado; ?> <?= $data->title; ?> <?= $encabezado1; ?> <?= $data->release_date; ?> </h3>
    <img src="<?= $data->poster_url; ?>" alt="<?= $data->title; ?>">
    <h5><?= $data->overview; ?></h5>
    <hr>
    <h3><?= $proxima; ?> <?= $data->following_production->title; ?> <?= $proxima1; ?> <?= $data->following_production->release_date; ?></h3>
    <img src="<?= $data->following_production->poster_url; ?>" alt="<?= $data->following_production->title; ?>">
    <h5><?= $data->overview; ?></h5>
  </div>
</body>