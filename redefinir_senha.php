<?php

include 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\phpmailer\phpmailer\src\Exception.php';
require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'vendor\phpmailer\phpmailer\src\SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(32));
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'includegen@gmail.com'; // Seu e-mail Gmail
        $mail->Password = 'wlxs hlgt jtca exky'; // Senha do aplicativo ou autenticação de duas etapas
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('includegen@gmail.com'); // Remetente
        $mail->addAddress($email); // Destinatário

        $mail->isHTML(true);
        $mail->Subject = 'Redefinir Senha - IncludeGen';
        $mail->Body = 'Clique no link a seguir para redefinir sua senha: ' .
            '<a href="http://localhost/IncludeGen/assets/senha.php?token=' . $token . '">Redefinir Senha</a>';
        $mail->send();

        echo "<script>alert('Um email com as instruções para redefinir a senha foi enviado para o seu email.'); window.location.href = 'index.php';</script>";
    } catch (Exception $e) {
        echo "Erro no envio do email: {$mail->ErrorInfo}";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Bem-vindo à IncludeGen, uma plataforma dedicada ao bem-estar e à inclusão da pessoa idosa. Encontre cuidadores de idosos, explore alternativas de entretenimento, descubra oportunidades de trabalho para a terceira idade e entenda o sistema previdenciário brasileiro.">
    <title>Redefinir senha - IncludeGen</title>
    <link rel="stylesheet" href="assets/css/redefinir_senha.css">
    <link rel="stylesheet" href="assets/css/responsivel-redefinir_senha.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
</head>

<body>
    <div class="password_esq">
        <div class="titulo">
            <h1>Redefinir senha</h1>
        </div>

        <form action="" method="POST">
    <input type="email" name="email" placeholder="Insira o seu e-mail" class="email-icon" required>
    <button type="submit" class="btn-cad">Enviar E-mail</button>
</form>


        <a href="cadastro">Não tem uma conta? Cadastre-se aqui.</a><br>
        <a href="login">Já tem uma conta? Logue aqui.</a>
    </div>
</body>

</html>