<?php
include 'conexao.php';
include 'validacao.php';

$mysqli = new mysqli($hostname, $username, $password, $database);

if (isset($_GET['pergunta_id']) && !empty($_GET['pergunta_id'])) {
    $pergunta_id = $_GET['pergunta_id'];
}

$nome_usuario = $_SESSION['name'] ?? 'Usuário não definido';

echo "
<style>
.mensagem-div {
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 10px;
    overflow: hidden;
    background-color: rgba(243, 243, 243, 0.8);
    max-width: 70%;
    margin: 0 auto;
    margin-top: 10px;
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
    height: auto;
    margin-right: 10px;
    float: left;
    border-radius: 50%;
}
</style>
";

$sql = $mysqli->query("SELECT * FROM chat1 WHERE pergunta_id = '$pergunta_id'");
if ($sql->num_rows > 0) {
    while ($key = $sql->fetch_assoc()) {
        $classe_mensagem = ($key['nome'] == $nome_usuario) ? 'minha-mensagem' : 'outra-mensagem';
        echo "<div class='mensagem-div $classe_mensagem'>";
        echo "<img src='https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_1280.png' class='avatar'>";
        echo "<h3 class='nome-usuario'>" . htmlspecialchars($key['nome']) . "</h3>";
        echo "<p class='mensagem'>" . htmlspecialchars($key['mensagem']) . "</p>";
        echo "<p class='data-mensagem'>" . htmlspecialchars($key['data_envio']) . "</p>";
        echo "</div>";
    }
}
