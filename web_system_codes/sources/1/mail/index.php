<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '../../../vendor/autoload.php';

include("connect.php"); // Certifique-se de que este caminho está correto também

$date = date("Y-m-d G:i:s");
$key = $_GET["k"];
$url = "https://maps.google.com/?q=" . $_GET["p"] . "&t=h";
$n_sat = $_GET["s"];
$volt = $_GET["t"];
$sinal = $_GET["a"];

if ($key == '<key>') { // Substitua <key> pela sua chave real!
    $query = "INSERT INTO `" . DB . "`.`tb_dados2` (`timeStamp`,`link_maps`,`n_sat`,`volt_bat`,`sinal`)
      VALUES ('$date','\" . $url . \"', '\" . $n_sat . \"', '\" . $volt . \"', '\" . $sinal . \"')";
    mysqli_query($conexao, $query);
    mysqli_close($conexao);

    $mail = new PHPMailer(true); // O 'true' habilita exceções para tratamento de erros

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.service'; // Seu servidor SMTP (ex: smtp.gmail.com)
        $mail->SMTPAuth = true;
        $mail->Username = 'mail_from'; // Seu endereço de e-mail (ex: seuemail@dominio.com)
        $mail->Password = 'pass';      // Sua senha do e-mail
        $mail->Port = 587;             // Porta SMTP (587 para TLS, 465 para SSL)
        $mail->setFrom('mail_from', 'name'); // Remetente: seu_email, seu_nome
        $mail->addAddress('mail_send');       // Destinatário: email_do_destinatario
        $mail->isHTML(true); // Define o formato do e-mail como HTML
        $mail->Subject = 'subject'; // Assunto do e-mail
        $mail->Body = 'text';       // Corpo do e-mail em HTML

        $mail->send(); // Envia o e-mail
    } catch (Exception $e) {
        $erroLog = "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
}

?>