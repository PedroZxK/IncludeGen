<?php
include 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\phpmailer\phpmailer\src\Exception.php';
require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'vendor\phpmailer\phpmailer\src\SMTP.php';

$emailEnviado = false;
$erroEnvio = '';
$erroEmailNaoExistente = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(32));

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'includegen@gmail.com';
            $mail->Password = 'wlxs hlgt jtca exky';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('includegen@gmail.com');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Redefinir Senha - IncludeGen';
            $mail->Body = 'Clique no link a seguir para redefinir sua senha: ' .
                '<a href="http://localhost/IncludeGen/IncludeGen/senha.php?token=' . $token . '">Redefinir Senha</a>';
            $mail->send();

            $emailEnviado = true;
        } catch (Exception $e) {
            $erroEnvio = $mail->ErrorInfo;
        }
    } else {
        $erroEmailNaoExistente = true;
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        <a href="cadastro.php">Não tem uma conta? Cadastre-se aqui.</a><br>
        <a href="login.php">Já tem uma conta? Logue aqui.</a>
    </div>

    <script>
        <?php if ($emailEnviado): ?>
            Swal.fire({
                icon: 'success',
                title: 'Email enviado!',
                text: 'Um email com as instruções para redefinir a senha foi enviado para o seu email.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'index.php';
            });
        <?php elseif ($erroEnvio): ?>
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Erro no envio do email: <?php echo addslashes($erroEnvio); ?>',
                confirmButtonText: 'OK'
            });
        <?php elseif ($erroEmailNaoExistente): ?>
            Swal.fire({
                icon: 'error',
                title: 'E-mail não encontrado',
                text: 'Este e-mail não está registrado em nossa base de dados.',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>
</body>

</html>