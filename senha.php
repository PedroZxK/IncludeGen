<?php

include 'conexao.php';

$mysqli = new mysqli(hostname: $hostname, username: $username, password: $password, database: $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $novaSenha = $_POST['novaSenha'];
    $confirmaSenha = $_POST['confirmaSenha'];

    $verificaEmail = "SELECT * FROM users WHERE email = '$email'";
    $resultado = $mysqli->query(query: $verificaEmail);

    if ($resultado->num_rows == 0) {
        echo "<script>alert('Email não encontrado.');window.location.href = 'senha.php';</script>";
        exit();
    }

    if ($novaSenha !== $confirmaSenha) {
        echo "<script>alert('As senhas não coincidem.');window.location.href = 'senha.php';</script>";
        exit();
    }

    $novaSenhaHash = password_hash(password: $novaSenha, algo: PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = '$novaSenhaHash' WHERE email = '$email'";

    if ($mysqli->query(query: $sql) === TRUE) {
        echo "<script>alert('Senha alterada com Sucesso.'); window.location.href = 'index.php';</script>";
        exit();
    } else {
        echo "Erro ao atualizar a senha: " . $mysqli->error;
    }

    $mysqli->close();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - Include Gen</title>
    <link rel="stylesheet" href="assets/css/senha.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logourl.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div id="reset-password">
        <div class="password_esq">
            <div class="titulo">
                <h1>Redefinir senha</h1>
            </div>

            <form action="" method="POST">
                <input type="email" id="email" name="email" placeholder="Insira o seu e-mail" class="email-icon"
                    required>
                <input type="password" id="novaSenha" name="novaSenha" placeholder="Insira a sua nova senha"
                    class="senha-icon" required>
                <input type="password" id="confirmaSenha" name="confirmaSenha"
                    placeholder="Insira a sua nova senha novamente" class="senha-icon" required>

                <button type="submit" class="btn-cad">Alterar Senha</button>
            </form>


            <a href="cadastro">Não tem uma conta? Cadastre-se aqui.</a><br>
            <a href="login">Já tem uma conta? Logue aqui.</a>
        </div>
    </div>
</body>

</html>