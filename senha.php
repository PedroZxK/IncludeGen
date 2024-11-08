<?php

include 'conexao.php';

$emailEnviado = false;
$erroEnvio = '';
$erroEmailNaoExistente = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $novaSenha = $_POST['novaSenha'];
    $confirmaSenha = $_POST['confirmaSenha'];

    $verificaEmail = "SELECT * FROM users WHERE email = '$email'";
    $resultado = $mysqli->query($verificaEmail);

    if ($resultado->num_rows == 0) {
        $erroEmailNaoExistente = true;
    } else {
        if ($novaSenha !== $confirmaSenha) {
            $erroEnvio = 'As senhas não coincidem.';
        } else {
            $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = '$novaSenhaHash' WHERE email = '$email'";

            if ($mysqli->query($sql) === TRUE) {
                $emailEnviado = true;
            } else {
                $erroEnvio = 'Erro ao atualizar a senha.';
            }
        }
    }

    $mysqli->close();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - IncludeGen</title>
    <link rel="stylesheet" href="assets/css/senha.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="password_esq">
        <div class="titulo">
            <h1>Redefinir senha</h1>
        </div>

        <form action="" method="POST">
            <input type="email" name="email" placeholder="Insira o seu e-mail" class="email-icon" required>
            <input type="password" name="novaSenha" placeholder="Insira a sua nova senha" class="senha-icon" required>
            <input type="password" name="confirmaSenha" placeholder="Insira a sua nova senha novamente"
                class="senha-icon" required>
            <button type="submit" class="btn-cad">Alterar Senha</button>
        </form>

        <a href="cadastro.php">Não tem uma conta? Cadastre-se aqui.</a><br>
        <a href="login.php">Já tem uma conta? Logue aqui.</a>
    </div>

    <script>
        <?php if ($emailEnviado): ?>
            Swal.fire({
                icon: 'success',
                title: 'Senha alterada com sucesso!',
                text: 'Sua senha foi alterada com sucesso.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'login.php';
            });
        <?php elseif ($erroEnvio): ?>
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: '<?php echo addslashes($erroEnvio); ?>',
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