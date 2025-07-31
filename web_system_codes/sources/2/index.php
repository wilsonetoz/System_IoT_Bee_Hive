<?php
session_start();
ob_start();
if ($_SESSION['iduser'] == "" || $_SESSION['nameuser'] == "") {
    $_SESSION['secury'] = "Erro, faça login.";
    header("Location: /login");
    exit();
}
$current_colmeia_id = 2;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta http-equiv="refresh" content="10">
    <title> Colmeia <?php echo $current_colmeia_id; ?></title>
    <link rel="shortcut icon" type="image/png" href="../Favicon.png" /> <link rel="stylesheet" href="../../bootstrap.min.css"> <script src="../../jquery-3.3.1.slim.min.js"></script> <script src="../../popper.min.js"></script> <script src="../../bootstrap.min.js"></script> <style>
        body { background-color: #E5E7E9; }
        .page-wrapper { width: 1000px; margin: 0 auto; }
        #active { color: #DAA520; }
        @media screen and (max-width: 640px) {
            table { max-width: auto; font-size: 70%; }
            table tr td b { margin: 2px; }
        }
    </style>
</head>
<body class="text-center">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">
            <img src="/Favicon.png" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item text-light nav-link" href="/">Início</a>
                <a class="nav-item text-light nav-link <?php echo ($current_colmeia_id == 1) ? 'active' : ''; ?>" href="/1" <?php echo ($current_colmeia_id == 1) ? 'id="active"' : ''; ?>>Colmeia 01<span class="sr-only">(current)</span></a>
                <a class="nav-item text-light nav-link <?php echo ($current_colmeia_id == 2) ? 'active' : ''; ?>" href="/2" <?php echo ($current_colmeia_id == 2) ? 'id="active"' : ''; ?>>Colmeia 02</a>
                <a class="nav-item text-light nav-link <?php echo ($current_colmeia_id == 3) ? 'active' : ''; ?>" href="/3" <?php echo ($current_colmeia_id == 3) ? 'id="active"' : ''; ?>>Colmeia 03</a>
                <a class="nav-item text-light nav-link <?php echo ($current_colmeia_id == 4) ? 'active' : ''; ?>" href="/4" <?php echo ($current_colmeia_id == 4) ? 'id="active"' : ''; ?>>Colmeia 04</a>
                <a class="nav-item text-light nav-link <?php echo ($current_colmeia_id == 5) ? 'active' : ''; ?>" href="/5" <?php echo ($current_colmeia_id == 5) ? 'id="active"' : ''; ?>>Colmeia 05</a>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="/closed.php">Sair<span class="sr-only"></span></a>
                </div>
            </div>
        </div>
    </nav>
    <div>
        <br/>
        <h2 align="center">Dados recebidos - Colmeia <?php echo $current_colmeia_id; ?></h2>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="width: 80%; margin: 20px auto;">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Data e Hora</th>
                    <th>Link do Mapa</th>
                    <th>Nº de Satélites</th>
                    <th>Tensão da Bateria (V)</th>
                    <th>Sinal RSSI</th>
                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin'): ?>
                        <th>Ações</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../conexao.php");
                $query = "SELECT * FROM tb_dados2 WHERE colmeia_id = " . $current_colmeia_id . " ORDER BY timeStamp DESC";
                $result = mysqli_query($conexao, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["timeStamp"] . "</td>";
                        echo "<td><a href='" . htmlspecialchars($row["link_maps"]) . "' target='_blank'>Ver Mapa</a></td>";
                        echo "<td>" . $row["n_sat"] . "</td>";
                        echo "<td>" . $row["volt_bat"] . "</td>";
                        echo "<td>" . $row["sinal"] . "</td>";
                        if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin') {
                            echo '<td>
                                    <form action="../1/delete.php" method="post" onsubmit="return confirm(\'Tem certeza que deseja deletar este registro?\');">
                                        <input type="hidden" name="id" value="' . $row["id"] . '">
                                        <input type="hidden" name="colmeia_id" value="' . $current_colmeia_id . '">
                                        <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                    </form>
                                  </td>';
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum dado encontrado para a Colmeia " . $current_colmeia_id . ".</td></tr>";
                }
                mysqli_free_result($result);
                mysqli_close($conexao);
                ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="../1/formulario_insercao.php?colmeia_id=<?php echo $current_colmeia_id; ?>" class="btn btn-success">Inserir Dados para Colmeia <?php echo $current_colmeia_id; ?></a>
    <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin'): ?>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteAllColmeia<?php echo $current_colmeia_id; ?>">
            Deletar Todos os Dados da Colmeia <?php echo $current_colmeia_id; ?>
        </button>
        <br><br>
        <div class="modal fade" id="modalDeleteAllColmeia<?php echo $current_colmeia_id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalDeleteAllColmeiaTitle<?php echo $current_colmeia_id; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-color:#1C1C1C">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteAllColmeiaTitle<?php echo $current_colmeia_id; ?>" style="color:white;">Confirmação de Exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color:white;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="background-color:#D7DF01">
                        <h5 class="modal-title" id="idModal1" style="color:red">Atenção!</h5>
                        <div>
                            Ao confirmar, todos os dados da Colmeia <?php echo $current_colmeia_id; ?> serão excluídos do banco de dados.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <a href="../1/delete.php?all=true&colmeia_id=<?php echo $current_colmeia_id; ?>" class="btn btn-danger">Confirmar Exclusão</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
