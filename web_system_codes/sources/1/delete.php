<?php
session_start();
ob_start();

if (!isset($_SESSION['iduser']) || !isset($_SESSION['nameuser'])) {
    $_SESSION['secury'] = "Erro, faça login";
    header("Location: /login");
    exit();
}

if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin') {
    include("../conexao.php");
    
    if ($conexao->connect_error) {
        echo '<p style="color: red; text-align: center;">Erro ao conectar ao banco de dados: ' . $conexao->connect_error . '</p>';
        echo '<meta http-equiv="refresh" content="5; URL=\'/1/\'"/>';
        exit();
    }

    $query = "";
    $target_colmeia_id = 1;
    
    if (isset($_GET['colmeia_id']) && is_numeric($_GET['colmeia_id'])) {
        $target_colmeia_id = intval($_GET['colmeia_id']);
    } elseif (isset($_POST['colmeia_id']) && is_numeric($_POST['colmeia_id'])) {
        $target_colmeia_id = intval($_POST['colmeia_id']);
    }

    $redirect_url = '/' . $target_colmeia_id . '/';

    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id_to_delete = $_POST['id'];
        $query = "DELETE FROM `tb_dados2` WHERE `id` = " . $id_to_delete;
    } elseif (isset($_GET['all']) && $_GET['all'] == 'true') {
        $query = "DELETE FROM `tb_dados2` WHERE `colmeia_id` = " . $target_colmeia_id;
    } else {
        echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="3; URL=\'' . $redirect_url . '\'"/>
    <title>Erro</title>
    <link rel="shortcut icon" type="image/png" href="/Favicon.png"/>
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body class="text-center">
    <div>
        <br/>
        <h1 align="center" style="color: orange;">Nenhuma ação de deleção válida especificada.</h1>
    </div>
</body>
</html>';
        exit();
    }

    if (!empty($query)) {
        if (mysqli_query($conexao, $query)) {
            echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="3; URL=\'' . $redirect_url . '\'"/>
    <title>Sucesso</title>
    <link rel="shortcut icon" type="image/png" href="/Favicon.png"/>
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body class="text-center">
    <div>
        <br/>
        <h2 align="center"> <img src="/bee2.png" height="50"> Dados deletados com sucesso!</h2>
    </div>
</body>
</html>';
        } else {
            echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="5; URL=\'' . $redirect_url . '\'"/>
    <title>Erro</title>
    <link rel="shortcut icon" type="image/png" href="/Favicon.png"/>
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body class="text-center">
    <div>
        <br/>
        <h1 align="center" style="color: red;">Erro ao deletar dados!</h1>
        <p align="center">Detalhes do erro: ' . mysqli_error($conexao) . '</p>
    </div>
</body>
</html>';
        }
    }
    mysqli_close($conexao);
} else {
    echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="5; URL=\'/login/\'"/>
    <title>Colmeia</title>
    <link rel="shortcut icon" type="image/png" href="/Favicon.png"/>
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body class="text-center">
    <div>
        <br/>
        <h1 align="center"> Ação não autorizada! </h1>
    </div>
</body>
</html>';
}
?>