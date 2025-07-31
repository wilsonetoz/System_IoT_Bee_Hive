<?php
// Inclui o arquivo de conexão principal
require '../conexao.php'; // Caminho corrigido para conexao.php
$mysqli = $conexao; // Usa a conexão já estabelecida em conexao.php

if ($mysqli->connect_error) {
    echo "Falha na conexão: " . $mysqli->connect_error;
    exit();
}

// Obtém o colmeia_id da URL, com um valor padrão de 1
$colmeia_id = isset($_GET['colmeia_id']) ? intval($_GET['colmeia_id']) : 1;

// Inserção ao enviar formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_hora = $_POST["data_hora"];
    $localizacao = $_POST["localizacao"];
    $num_satelites = $_POST["num_satelites"];
    $tensao_bateria = $_POST["tensao_bateria"];
    $rssi = $_POST["rssi"];

    // Altera para tb_dados2 e inclui colmeia_id
    $sql = "INSERT INTO tb_dados2 (timeStamp, link_maps, n_sat, volt_bat, sinal, colmeia_id)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);
    // Ajusta os tipos e o número de parâmetros para incluir colmeia_id
    // 's' para string (data_hora, link_maps), 'i' para int (n_sat, sinal, colmeia_id), 'd' para double/decimal (volt_bat)
    $stmt->bind_param("ssiidi", $data_hora, $localizacao, $num_satelites, $tensao_bateria, $rssi, $colmeia_id);

    if ($stmt->execute()) {
        echo "<p>✅ Dados inseridos com sucesso!</p>";
    } else {
        echo "<p>❌ Erro ao inserir dados: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inserir Dados da Colmeia</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <style>
        body { padding: 20px; }
        form { max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { display: block; margin-bottom: 5px; }
        input[type="datetime-local"],
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2 align="center">Inserir Dados Manualmente para Colmeia ID: <?php echo htmlspecialchars($colmeia_id); ?></h2>
    <form method="post">
        <label>Data e Hora:</label><br>
        <input type="datetime-local" name="data_hora" required><br><br>

        <label>Localização (Link Maps):</label><br>
        <input type="text" name="localizacao" placeholder="Ex: https://maps.app.goo.gl/..." required><br><br>

        <label>Nº de Satélites:</label><br>
        <input type="number" name="num_satelites" required><br><br>

        <label>Tensão da Bateria:</label><br>
        <input type="number" step="0.01" name="tensao_bateria" required><br><br>

        <label>Sinal RSSI:</label><br>
        <input type="number" name="rssi" required><br><br>

        <button type="submit">Inserir Dados</button>
        <a href="/1/" class="btn btn-secondary">Voltar para Colmeia 01</a>
    </form>
</body>
</html>