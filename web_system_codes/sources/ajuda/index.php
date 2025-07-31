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
  <title>Ajuda - System IoT Bee Hive</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <a class="nav-link text-light" href="/sobre">Sobre</a>
      <a class="nav-link text-light" href="/ajuda" id="active">Ajuda</a>
    </div>
    <div class="navbar-nav">
      <a class="nav-link text-light" href="/login">Entrar</a>
    </div>
  </div>
</nav>

<div class="container">
  <h2 class="mb-4 text-center">Central de Ajuda 🛠️</h2>

  <h5>❓ Como acessar o sistema?</h5>
  <p>Para acessar o sistema, clique em "Entrar" no canto superior direito e informe seu usuário e senha cadastrados.</p>

  <h5>📊 O que posso visualizar?</h5>
  <p>Após o login, você terá acesso às páginas com os dados da colmeia, histórico de registros, e gráficos de sensores (dependendo da integração com o dispositivo físico).</p>

  <h5>🧑‍🔧 Como configurar o dispositivo físico?</h5>
  <p>O microcontrolador deve ser programado com o código localizado em <code>/physical_device_codes/master.ino</code>. Ele coleta dados como temperatura e umidade e envia para o banco de dados.</p>

  <h5>🐞 Erros comuns</h5>
  <ul>
    <li><strong>Página em branco:</strong> Verifique se todos os arquivos CSS/JS estão corretamente carregados.</li>
    <li><strong>Erro de banco de dados:</strong> Confirme que o container do MySQL está rodando e que os dados estão corretos no <code>conexao.php</code>.</li>
    <li><strong>Dispositivo não envia dados:</strong> Verifique a conexão Wi-Fi, a configuração do IP e se o banco de dados está acessível.</li>
  </ul>

  <h5>📦 Como executar o sistema?</h5>
  <ol>
    <li>Certifique-se de ter o Docker instalado.</li>
    <li>Na raiz do projeto, execute: <code>docker compose up --build</code>.</li>
    <li>Acesse o sistema em: <code>http://localhost:8080</code>.</li>
  </ol>

  <h5>📨 Suporte</h5>
  <p>Em caso de dúvidas técnicas ou problemas com o sistema, entre em contato pela página <a href="/contato">Contato</a>.</p>

  <p class="text-center mt-5">
    <small>Projeto desenvolvido com fins acadêmicos. Última atualização: 2025</small>
  </p>
</div>

</body>
</html>
