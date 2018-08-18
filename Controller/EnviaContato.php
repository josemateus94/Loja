<?php
session_start();
require_once '../PhpMailer/PHPMailerAutoload.php';

$nome = $_POST['nome'];
$emailDestinatatio = $_POST['email'];
$mailRemetente = "";
$mensagem = $_POST['mensagem'];

$mail = new phpMailer();
$mail->isSMTP();
$mail->Host = 'smtp.live.com';
$mail->Port = '587';
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = 'true';
$mail->Username = $mailRemetente;// e-amil que será responsavel pelo envio
$mail->Password = '*************';

$mail->setFrom($mailRemetente, "teste");// mesmo e-mail de cima
$mail->addAddress($emailDestinatatio);//email que ira receber
$mail->Subject = "Email de contato da loja";
$mail->msgHTML("<html> de {$nome}</br>email:{$emailDestinatatio}</br>mensagem:{$mensagem}</html>");
$mail->AtlBody = ("de: {$nome}\n email: {$emailDestinatatio}\n mensagem: {$mensagem}");

if ($mail->send()) {
    $_SESSION['success'] = "Mensagem enviada com sucesso.";
    header("location: ../View/Index.php");
}else{
    $_SESSION['danger'] = "Erro ao enviar mensagem.". $mail->ErrorInfo;
    header("Location: ../View/Contato.php");
}
die();
?>