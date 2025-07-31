<?php
session_start();
if(isset($_SESSION['nameuser'])){
    header("Location: /inicio");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Contato - System IoT Bee Hive</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/Favicon.png" type="image/png">
  <link rel="stylesheet" href="/bootstrap.min.css">
  <script src="/jquery-3.3.1.slim.min.js"></script>
  <script src="/popper.min.js"></script>
  <script src="/bootstrap.min.js"></script>
  <style>
    .container {
      margin-top: 40px;
      max-width: 800px;
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
      <a class="nav-link text-light" href="/contato" id="active">Contato</a>
      <a class="nav-link text-light" href="/sobre">Sobre</a>
      <a class="nav-link text-light" href="/ajuda">Ajuda</a>
    </div>
    <div class="navbar-nav">
      <a class="nav-link text-light" href="/login">Entrar</a>
    </div>
  </div>
</nav>

<div class="container">
  <h2 class="mb-4 text-center">Fale Conosco 📬</h2>
  
  <p class="text-center">Tem alguma dúvida, sugestão ou problema técnico? Envie uma mensagem abaixo:</p>

  <form>
    <div class="form-group">
      <label for="nome">Nome completo</label>
      <input type="text" class="form-control" id="nome" placeholder="Seu nome" required>
    </div>

    <div class="form-group">
      <label for="email">Endereço de e-mail</label>
      <input type="email" class="form-control" id="email" placeholder="seuemail@exemplo.com" required>
    </div>

    <div class="form-group">
      <label for="mensagem">Mensagem</label>
      <textarea class="form-control" id="mensagem" rows="5" placeholder="Digite sua mensagem aqui..." required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>

  <p class="text-muted text-center mt-4">
    Este formulário é apenas ilustrativo.<br>
    Para suporte oficial, entre em contato com o professor responsável ou equipe do projeto.
  </p>
</div>

</body>
</html>
