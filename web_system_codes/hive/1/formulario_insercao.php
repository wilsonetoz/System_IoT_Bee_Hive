<?php
session_start();
ob_start();

if (!isset($_SESSION['iduser']) || !isset($_SESSION['nameuser']) || $_SESSION['type'] !== 'admin') {
    $_SESSION['secury'] = "Acesso negado. Apenas administradores podem inserir dados.";
    header("Location: /login/");
    exit();
}

include("../conexao.php");

if ($conexao->connect_error) {
    echo "Falha na conexão com o banco de dados: " . $conexao->connect_error;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_hora = $_POST["data_hora"];
    $localizacao = $_POST["localizacao"];
    $num_satelites = $_POST["num_satelites"];
    $tensao_bateria = $_POST["tensao_bateria"];
    $rssi = $_POST["rssi"];

    $colmeia_id = isset($_GET['colmeia_id']) ? intval($_GET['colmeia_id']) : 0;

    if ($colmeia_id > 0) {
        $sql = "INSERT INTO tb_dados2 (timeStamp, link_maps, n_sat, volt_bat, sinal, colmeia_id)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);

        $stmt->bind_param("ssiddi", $data_hora, $localizacao, $num_satelites, $tensao_bateria, $rssi, $colmeia_id);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>✅ Dados inseridos com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>❌ Erro ao inserir dados: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p style='color: red;'>❌ Erro: ID da colmeia inválido para inserção.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inserir Dados da Colmeia</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <style>
        body { background-color: #E5E7E9; text-align: center; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; text-align: left; }
        input[type="datetime-local"], input[type="text"], input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inserir Dados Manualmente</h2>
        <form method="post">
            <label for="data_hora">Data e Hora:</label>
            <input type="datetime-local" id="data_hora" name="data_hora" required><br>

            <label for="localizacao">Localização (Link Maps):</label>
            <input type="text" id="localizacao" name="localizacao" placeholder="Ex: https://maps.app.goo.gl/abcdefg" required><br>

            <label for="num_satelites">Nº de Satélites:</label>
            <input type="number" id="num_satelites" name="num_satelites" required><br>

            <label for="tensao_bateria">Tensão da Bateria:</label>
            <input type="number" id="tensao_bateria" name="tensao_bateria" step="0.01" required><br>

            <label for="rssi">Sinal RSSI:</label>
            <input type="number" id="rssi" name="rssi" required><br>

            <button type="submit">Inserir Dados</button>
        </form>
        <a href="/inicio/" class="btn btn-secondary">Voltar para o inicio</a>
    </div>
</body>
</html>
