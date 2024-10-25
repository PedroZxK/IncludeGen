<?php

include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["email"]) && isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["date-of-birth"]) && isset($_POST["password"]) && isset($_POST["confirm-password"]) && isset($_POST["role"])) {

        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $date_of_birth = $_POST["date-of-birth"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm-password"];
        $role = $_POST["role"];

        if (strlen($password) < 8) {
            echo 'A senha deve conter no mínimo 8 caracteres!';
            exit();
        }

        if ($password !== $confirm_password) {
            echo 'As senhas não coincidem!';
            exit();
        }

        $sql = "INSERT INTO users (email, name, phone, date_of_birth, password, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param('ssssss', $email, $name, $phone, $date_of_birth, $hashed_password, $role);

            if ($stmt->execute()) {
                echo '<script>alert("Usuário cadastrado com sucesso!");window.location.href="index.php";</script>';
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
    <meta name="description" content="Bem-vindo à IncludeGen, uma plataforma dedicada ao bem-estar e à inclusão da pessoa idosa. Encontre cuidadores de idosos, explore alternativas de entretenimento, descubra oportunidades de trabalho para a terceira idade e entenda o sistema previdenciário brasileiro.">

    <title>Cadastro - IncludeGen</title>
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <link rel="stylesheet" href="assets/css/responsivel-cadastro.css">
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
                    <h1>Cadastro</h1>

                    <label for="username">E-mail:</label>
                    <input type="email" id="username" name="email" required>

                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="phone">Telefone:</label>
                    <input type="number" id="phone" name="phone" required>

                    <label for="date-of-birth">Data de Nascimento:</label>
                    <input type="date" id="date-of-birth" name="date-of-birth" required>

                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>

                    <label for="confirm-password">Confirmar Senha:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>

                    <p>Você é um:</p>
                    <div class="role-options">
                        <label><input type="radio" name="role" value="Idoso" required> Idoso</label>
                        <label><input type="radio" name="role" value="Cuidador de idoso" required> Cuidador de Idoso</label>
                    </div>


                    <button type="submit">Cadastrar</button>
                </div>
            </form>

            <div class="already-account">
                Já tem uma conta? <a href="login.php">Entre aqui.</a>
            </div>
        </div>
    </div>
</body>

</html>