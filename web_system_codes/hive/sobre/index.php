<?php
session_start();
if (isset($_SESSION['nameuser'])) {
    $usuario = $_SESSION['nameuser'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre o Projeto</title>
  <link rel="shortcut icon" href="/Favicon.png" type="image/png">
  <link rel="stylesheet" href="/bootstrap.min.css">
  <script src="/jquery-3.3.1.slim.min.js"></script>
  <script src="/popper.min.js"></script>
  <script src="/bootstrap.min.js"></script>
  <style>
    .container {
      margin-top: 40px;
      max-width: 960px;
    }
    #active {
      color: #DAA520;
    }
  </style>
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">
    <img src="/Favicon.png" height="40" alt="Logo">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
    <div class="navbar-nav">
      <a class="nav-link text-light" href="/">Início</a>
      <a class="nav-link text-light" href="/contato">Contato</a>
      <a class="nav-link text-light" href="/sobre" id="active">Sobre</a>
      <a class="nav-link text-light" href="/ajuda">Ajuda</a>
    </div>
    <div class="navbar-nav">
      <a class="nav-link text-light" href="/login">Entrar</a>
    </div>
  </div>
</nav>

<div class="container">
  <h2 class="mb-4 text-center">Sobre o Projeto System IoT Bee Hive 🐝</h2>

  <p>
    O <strong>System IoT Bee Hive</strong> é um sistema desenvolvido para auxiliar no monitoramento e gerenciamento de colmeias inteligentes. O objetivo do projeto é permitir o acompanhamento remoto das condições internas da colmeia, promovendo a saúde e produtividade das abelhas.
  </p>

  <h4>🔧 Componentes do Projeto</h4>
  <ul>
    <li><strong>Frontend/Backend em PHP:</strong> Interface web com páginas de login, dashboard e gerenciamento de sensores.</li>
    <li><strong>Banco de Dados MySQL:</strong> Armazena os dados coletados do ambiente e do dispositivo físico.</li>
    <li><strong>Dispositivo Físico (IoT):</strong> Microcontrolador programado em Arduino que coleta e envia dados como temperatura e umidade da colmeia.</li>
    <li><strong>Deploy via Docker:</strong> Toda a aplicação foi empacotada e executada em containers com Docker e Docker Compose.</li>
  </ul>

  <h4>📦 Estrutura de Diretórios</h4>
  <ul>
    <li><code>web_system_codes/</code>: Código da interface web.</li>
    <li><code>physical_device_codes/</code>: Código Arduino do dispositivo de monitoramento (arquivo <code>master.ino</code>).</li>
    <li><code>docker-compose.yml</code> e <code>Dockerfile</code>: Arquivos para implantação da aplicação em containers.</li>
  </ul>

  <h4>🧠 Tecnologias Utilizadas</h4>
  <p>
    PHP 7.4, Apache, MySQL 8.0, Docker, HTML5, Bootstrap, Arduino C++.
  </p>

  <h4>💡 Observação</h4>
  <p>
    Para que o sistema funcione corretamente, é necessário executar os containers Docker, garantindo que o banco de dados esteja ativo e que os arquivos estejam no diretório correto.
  </p>

  <p class="text-center mt-5">
    <small>Desenvolvido como projeto acadêmico com fins educativos.</small>
  </p>
</div>

</body>
</html>
