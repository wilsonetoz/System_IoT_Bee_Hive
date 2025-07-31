<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '../../../vendor/autoload.php';

include("../../conexao.php");

$date = date("Y-m-d G:i:s");
$key = $_GET["k"];
$url = "https://maps.google.com/?q=" . $_GET["p"] . "&t=h";
$n_sat = $_GET["s"];
$volt = $_GET["t"];
$sinal = $_GET["a"];

if ($key == '<key>') {
    $query = "INSERT INTO `" . DB . "`.`tb_dados2` (`timeStamp`,`link_maps`,`n_sat`,`volt_bat`,`sinal`)
      VALUES ('$date','\" . $url . \"', '\" . $n_sat . \"', '\" . $volt . \"', '\" . $sinal . \"')";
    mysqli_query($conexao, $query);
    mysqli_close($conexao);

    $mail = new PHPMailer(true); 

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.service';
        $mail->SMTPAuth = true;
        $mail->Username = 'mail_from'; 
        $mail->Password = 'pass';
        $mail->Port = 587;
        $mail->setFrom('mail_from', 'name');
        $mail->addAddress('mail_send');
        $mail->isHTML(true); 
        $mail->Subject = 'subject';
        $mail->Body = 'text';

        $mail->send(); 
    } catch (Exception $e) {
        $erroLog = "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
}

?>
