<?php
include 'conexao.php';

$emailCookie = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $remember = isset($_POST['remember']);

    if ($remember) {
        setcookie('email', $email, time() + (86400 * 30), "/");
    } else {
        setcookie('email', '', time() - 3600, "/");
    }

    header('Location: login.php');
    exit();
}

$mysqli->close();
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
    <link rel="shortcut icon" type="imagex/png"
        href="assets/img/logo.png">
</head>

<body>
    <div class="sign-left"></div>
    <div id="sign-square">
        <div id="sign-right">
            <form id="loginForm" method="POST">
                <div id="form-id">
                    <img src="assets/img/logo.png" alt="Logo">
                    <h1>Redefinir Senha</h1>
                    <?php if (isset($error_message)) : ?>
                        <p style="color: red;"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <label for="password">Nova senha:</label>
                    <input type="password" name="new_password" required value="<?php echo htmlspecialchars($emailCookie); ?>">

                    <label for="password">Confirmar senha:</label>
                    <input type="password" name="password" required>

                    <label class="control control-checkbox">
                        Lembrar-me
                        <input type="checkbox" name="remember" value="1" <?php echo $emailCookie ? 'checked' : ''; ?> />
                        <div class="control_indicator"></div>
                    </label>

                    <button type="submit">Redefinir</button>
                </div>
            </form>
            <div class="no-account">
                Não tem uma conta? <a href="cadastro.php">Cadastre-se</a>
            </div>
            <div class="remembered-password">
                Lembrei da minha senha <a href="login.php">Entrar</a>
            </div>
        </div>
    </div>
</body>

</html>