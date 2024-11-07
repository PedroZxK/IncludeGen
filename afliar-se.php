<?php

include 'conexao.php';

$emailCookie = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["email"]) && isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["biography"]) && isset($_POST["date-of-birth"]) && isset($_POST["cpf"]) && isset($_POST["password"])) {

        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $biography = $_POST["biography"];
        $date_of_birth = $_POST["date-of-birth"];
        $cpf = $_POST["cpf"];
        $password = $_POST["password"];

        if (strlen($password) < 8) {
            echo 'A senha deve conter no mínimo 8 caracteres!';
            exit();
        }       

        $sql = "INSERT INTO users (email, name, phone, biography, date_of_birth, cpf, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param('sssssss', $email, $name, $phone, $biography, $date_of_birth, $cpf, $hashed_password);

            if (isset($_POST['remember'])) {
                setcookie('email', $email, time() + (86400 * 30), "/");
            } else {
                setcookie('email', '', time() - 3600, "/");
            }

            if ($stmt->execute()) {
                echo '<script>alert("Usuário cadastrado com sucesso!");window.location.href="login.php";</script>';
            } else {
                echo 'Erro ao cadastrar usuário.';
            }

            $stmt->close();
        } else {
            echo 'Erro na preparação da declaração: ' . $mysqli->error;
        }
    } else {
        echo 'Por favor, preencha todos os campos do formulário.';
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

    <title>Afiliar-se - IncludeGen</title>
    <link rel="stylesheet" href="assets/css/afiliar-se.css">
    <link rel="stylesheet" href="assets/css/responsivel-afiliar-se.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png">
</head>

<body>
    <div class="sign-left">
    </div>
    <div id="sign-square">
        <div id="sign-right">
            <form id="loginForm" method="POST">
                <div id="form-id">
                    <img src="assets/img/logo.png" alt="Logo">
                    <h1>Afiliar-se</h1>

                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" required placeholder="Insira seu nome">

                    <label for="username">E-mail:</label>
                    <input type="email" id="username" name="email" required placeholder="exemplo@gmail.com"
                        value="<?php echo htmlspecialchars($emailCookie); ?>">


                    <label for="phone">Biografia:</label>
                    <input type="text" id="biography" name="biography" required
                        placeholder="Descreva um pouco sobre os seus serviços">

                    <label for="date-of-birth">Data de Nascimento:</label>
                    <input type="date" id="date-of-birth" name="date-of-birth" required>

                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required placeholder="Insira o seu CPF">

                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required placeholder="*********">

                    <label class="control control-checkbox">
                        Lembrar-me
                        <input type="checkbox" name="remember" value="1" <?php echo $emailCookie ? 'checked' : ''; ?> />
                        <div class="control_indicator"></div>
                    </label>

                    <button type="submit">Registrar</button>
                </div>
            </form>

            <div class="already-account">
                Voltar para <a href="login.php">Login</a>
            </div>
        </div>
    </div>
</body>

</html>