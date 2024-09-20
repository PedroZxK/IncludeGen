<?php

include 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(32));
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rigrovercontato@gmail.com';
        $mail->Password = 'n l m d e w f f b p v o r m x e';
        $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_SMTPS';
        $mail->Port = 587;


        $mail->setFrom('chickitopizzaria@gmail.com');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Redefinir Senha - Rig Rover';
        $mail->Body = 'Clique no link a seguir para redefinir sua senha: ' .
            '<a href="http://localhost/RigRover-1/senha.php?token=' . $token . '">Redefinir Senha</a>';
        $mail->send();

        echo "<script>alert('Um email com as instruções para redefinir a senha foi enviado para o seu email.'); window.location.href = 'index.php';</script>";
    } catch (Exception $e) {
        echo "Erro no envio do email: {$mail->ErrorInfo}";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - RigRover</title>
    <link rel="stylesheet" href="assets/css/redefinir_senha.css">
    <link rel="stylesheet" href="assets\css\responsividade\redefinir-senha-responsivo.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logourl.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="redefine-password">
        <div class="title">
            <h1>Redefinir senha</h1>
        </div>

        <form action="redefinir_senha" method="POST">
            <input type="email" name="email" placeholder="Insira o seu e-mail" class="email-icon" required>

            <button type="submit" class="btn-email">Enviar E-mail</button>
        </form>

        <a href="cadastro.php">Não tem uma conta? Cadastre-se aqui.</a><br>
        <a href="login.php">Já tem uma conta? Logue aqui.</a>
    </div>
</body>


</html>