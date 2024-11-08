<?php
include 'conexao.php';
include 'validacao.php';

$mysqli = new mysqli($hostname, $username, $password, $database);

if (isset($_GET['pergunta_id']) && !empty($_GET['pergunta_id'])) {
    $pergunta_id = $_GET['pergunta_id'];
}

// Busca o nome do usuário logado
$id = $_SESSION['user_id'] ?? null;

if ($id) {
    $stmt = $mysqli->prepare("SELECT name, foto_perfil FROM users WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['name'];
            $foto_perfil = $row['foto_perfil'] ?: 'assets/img/avatar_temp.webp'; // Avatar padrão se não houver
        } else {
            $username = "Usuário não encontrado";
            $foto_perfil = 'assets/img/avatar_temp.webp';
        }
        $stmt->close();
    } else {
        echo 'Erro ao preparar a declaração: ' . $mysqli->error;
    }
} else {
    $username = "ID de usuário não definido";
    $foto_perfil = 'assets/img/avatar_temp.webp';
}

// Estilos para a estrutura das mensagens
echo "
<style>
.mensagem-div {
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 10px;
    overflow: hidden;
    background-color: rgba(243, 243, 243, 0.8);
    max-width: 70%;
    margin: 10px auto;
}

.minha-mensagem {
    text-align: left;
}

.outra-mensagem {
    text-align: left;
}

.nome-usuario {
    font-weight: bold;
    margin-bottom: 5px;
}

.data-mensagem {
    color: gray;
    font-size: 12px;
}

.mensagem {
    margin-top: 5px;
}

.avatar {
    width: 40px;
    height: 40px;
    margin-right: 10px;
    float: left;
    border-radius: 50%;
}
</style>
";

$sql = $mysqli->query("SELECT * FROM chat1 WHERE pergunta_id = '$pergunta_id'");
if ($sql->num_rows > 0) {
    while ($key = $sql->fetch_assoc()) {
        $classe_mensagem = ($key['nome'] == $username) ? 'minha-mensagem' : 'outra-mensagem';
        echo "<div class='mensagem-div $classe_mensagem'>";
        echo "<img src='" . htmlspecialchars($foto_perfil) . "' alt='Avatar' class='avatar'>";
        echo "<p class='nome-usuario'>" . htmlspecialchars($username) . "</p>";
        echo "<p class='mensagem'>" . htmlspecialchars($key['mensagem']) . "</p>";
        echo "<p class='data-mensagem'>" . htmlspecialchars($key['data_envio']) . "</p>";
        echo "</div>";
    }   
}
?>
