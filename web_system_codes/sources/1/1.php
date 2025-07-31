<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '../../../vendor/autoload.php';
include("../conexao.php");

$date = date("Y-m-d G:i:s");
$key = $_GET["k"];
$url = "https://maps.google.com/?q=" . $_GET["p"] . "&t=h";
$n_sat = $_GET["s"];
$volt = $_GET["t"];
$sinal = $_GET["a"];

if ($key == 'Vagalinha') {
    $query = "INSERT INTO `" . DB . "`.`tb_dados2` (`timeStamp`,`link_maps`,`n_sat`,`volt_bat`,`sinal`)
      VALUES ('$date','" . $url . "', '" . $n_sat . "', '" . $volt . "', '" . $sinal . "')";
    
    mysqli_query($conexao, $query);
    mysqli_close($conexao);

    $mail = new PHPMailer(true); 

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'testzx7213@gmail.com';
        $mail->Password = 'teste72@zx 13';
        $mail->Port = 587;

        $mail->setFrom('testzx7213@gmail.com', 'Wilson');
        $mail->addAddress('zhuezx13@gmail.com');

        $mail->isHTML(true);   
        $mail->Subject = 'Alerta do Sistema Colmeia: Dados Recebidos';
        $mail->Body    = 'Corpo do email em HTML. Dados: ' . $date . ', ' . $url . ', ' . $n_sat . ', ' . $volt . ', ' . $sinal; // <<<<< Corpo do e-mail em HTML

        $mail->send();
         echo 'Mensagem de e-mail enviada com sucesso!'; 

    } catch (Exception $e) {
        $erroLog = "Erro ao enviar mensagem: {$mail->ErrorInfo}";
         echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
}

?>
