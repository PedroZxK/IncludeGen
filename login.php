<?php
session_start();

include 'conexao.php';

$emailCookie = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if (empty($email) || empty($password)) {
        $error_message = 'Por favor, preencha todos os campos do formulário.';
    } else {
        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($id, $dbEmail, $dbPassword);
            if ($stmt->fetch() && password_verify($password, $dbPassword)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $id;
                $_SESSION['email'] = $dbEmail;

                if ($remember) {
                    setcookie('email', $email, time() + (86400 * 30), "/");
                } else {
                    setcookie('email', '', time() - 3600, "/");
                }

                header('Location: home.php');
                exit();
            } else {
                $error_message = 'Credenciais inválidas.';
            }
            $stmt->close();
        } else {
            echo 'Erro ao preparar a declaração: ' . $mysqli->error;
        }
    }
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
    <title>Login - IncludeGen</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">

    <script src="https://accounts.google.com/gsi/client" async></script>
    <script src="https://unpkg.com/jwt-decode/build/jwt-decode.js"></script>

    <script>
        function handleCredentialResponse(response) {
            const token = response.credential;

            // Enviar o token para o servidor para validação
            fetch('validate_google_token.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ token: token })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Sucesso, redirecionar para home.php
                        window.location.href = 'home.php';
                    } else {
                        alert("Erro ao validar a conta Google.");
                    }
                })
                .catch(error => {
                    console.error('Erro ao enviar o token para validação:', error);
                });
        }

        window.onload = function () {
            google.accounts.id.initialize({
                client_id: "299295953821-nqbqqb8va16klodnvebgdja6h40mogc5.apps.googleusercontent.com",
                callback: handleCredentialResponse
            });

            google.accounts.id.renderButton(
                document.getElementById("buttonDiv"),
                {
                    theme: "outline",
                    size: "large",
                    type: "standard",
                    shape: "pill",
                    text: "continue_with",
                    logo_alignment: "center",
                    width: "300"
                }
            );

            google.accounts.id.prompt(); // Exibe o One Tap dialog
        }
    </script>

</head>

<body>
    <div class="sign-left"></div>
    <div id="sign-square">
        <div id="sign-right">
            <form id="loginForm" method="POST">
                <div id="form-id">
                    <img src="assets/img/logo.png" alt="Logo">
                    <h1>Entre na sua conta</h1>
                    <div style="display: flex; justify-content: center;">
                        <div id="buttonDiv"></div>
                    </div>
                    <p>------------- ou entre com seu e-mail -------------</p>
                    <label for="email">Email:</label>
                    <input type="email" name="email" required placeholder="exemplo@gmail.com"
                        value="<?php echo htmlspecialchars($emailCookie); ?>">
                    <label for="password">Password:</label>
                    <input type="password" name="password" required>
                    <?php if (isset($error_message)): ?>
                        <p style="color: red;"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <label class="control control-checkbox">
                        Lembrar-me
                        <input type="checkbox" name="remember" value="1" <?php echo $emailCookie ? 'checked' : ''; ?> />
                        <div class="control_indicator"></div>
                    </label>

                    <button type="submit">Entrar</button>
                </div>
            </form>
            <div class="no-account">
                Ainda não está registrado? <a href="cadastro.php">Crie uma nova conta.</a>
            </div>
            <div class="remember-password">
                <a href="redefinir_senha.php">Esqueceu a senha?</a>
            </div>
        </div>
    </div>
</body>

</html>