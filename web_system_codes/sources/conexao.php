<?php
require 'config.php';
$conexao = new mysqli(HOST, USER, PASS, DB);
if ($conexao->connect_error) {
	echo "Erro ao conectar ao banco de dados". $conexao->connect_error;
}else {
	//echo "Conexao feita com sucesso";
}
?>