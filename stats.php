<?php
require_once 'data/lib/vendor/autoload.php';

   use SensioLabs\AnsiConverter\AnsiToHtmlConverter;

   $converter = new AnsiToHtmlConverter();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Biblioteki i czcionki zewnętrzne -->
  <link href="data/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <script src="data/lib/bootstrap/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400&display=swap"
    rel="stylesheet">
  <!-- Własne css i js -->
  <script src="data/js/src/stats.js" type="module"></script> <!-- TODO: Ustawić na data/js/min/stats.min.js kiedy skończę pisać javascripty, na razie zostawiam tak dla testów -->
  <link rel="stylesheet" href="style.css">
  <title>Pistacja</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light" style="background-color:#B20D3B;">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">
            <img src="data/images/pistacja-logo.svg" alt="Logo" width="32" height="32"
              class="d-inline-block align-text-top">
            <b><span class="primarycolor">Pi</b></span>stacja
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.html">Strona główna</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="stats.php">Statystyki</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://github.com/chixPL/pistacja">GitHub</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>


    <div id="main" class="container-fluid">
        <!-- Główny kontener-->
        <div class="row">
        <div class="col-lg-6 col-md-8">
            <div class="row">
                <h1>Miesięczne wyniki</h1>
            </div>
            <br class="d-none d-sm-inline-block">
            <div class="row row-cols-lg-2">
            <div class="col-lg-6">
                <div class="row">
                <div class="chart-container" style="position: relative">
                <canvas id="chart1"></canvas>
                <canvas id="chart3"></canvas>
                </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                <div class="chart-container" style="position: relative">
                <canvas id="chart2"></canvas>
                <canvas id="chart4"></canvas>
                </div>
                </div>
            </div>
        </div>
          <div class="row">
            <h3>Zakres danych:</h3>
          <div class="btn-group" role="group" aria-label="Zakres danych wykresu">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
          <label class="btn btn-outline-primary" for="btnradio1">7 dni</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
          <label class="btn btn-outline-primary" for="btnradio2">14 dni</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
          <label class="btn btn-outline-primary" for="btnradio3">30 dni</label>
          </div>
          </div>

          <div class="row g-0 float-end">
          <div class="col">
          <button id="bar_chart" title="Wykres kolumnowy" type="button" class="btn btn-primary btn-sm"><i class="bi bi-bar-chart-fill"></i></button>
          </div>
          <div class="col">
          <button id="line_chart" title="Wykres liniowy" type="button" class="btn btn-secondary btn-sm"><i class="bi bi-graph-up"></i></button>
          </div>
        </div>
        </div>

        <div class="col-lg">
            <div class="row">
            <h1>Uptime:</h1>
            </div>
            <div class="row">
            <span id="uptime"></span>
            </div>
            <div class="row">
              <pre class="fetch font-monospace me-1">
              <?php
                if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) { // sprawdzamy czy użytkownik korzysta z telefonu
                  $file = file_get_contents('.db/fetch_noart.txt'); // wersja bez grafiki
                  // todo: dodać ansi2html i prawdziwy exec neofetch
                } else {
                  // exec('neofetch > .db/fetch.txt'); mamy problem: nie mogę tego wgrać na serwer, trzeba będzie to w jakiś sposób pobierać z pistacji
                  $file = file_get_contents('.db/fetch.txt'); // pełna wersja
                }

                echo $converter->convert($file)
                //echo $file;
                
              ?>
              </pre>
            </div>
        </div>
    </div>
  </div>
</body>
</html>