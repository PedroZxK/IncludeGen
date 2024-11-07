<?php
include 'conexao.php';
include 'validacao.php';

$id = $_SESSION['user_id'] ?? null;

if ($id) {
    $stmt = $mysqli->prepare("SELECT name FROM users WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['name'];
        } else {
            $username = "Usuário não encontrado";
        }
        $stmt->close();
    } else {
        echo 'Erro ao preparar a declaração: ' . $mysqli->error;
    }
} else {
    $username = "ID de usuário não definido";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Bem-vindo à IncludeGen, uma plataforma dedicada ao bem-estar e à inclusão da pessoa idosa. Encontre cuidadores de idosos, explore alternativas de entretenimento, descubra oportunidades de trabalho para a terceira idade e entenda o sistema previdenciário brasileiro.">
    <title>Entretenimento - IncludeGen</title>
    <link rel="stylesheet" href="assets/css/atividade1.css">
    <link rel="stylesheet" href="assets/css/responsivel-atividade1.css">
    <link rel="shortcut icon" type="imagex/png"
        href="assets/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
</head>

<body>

    <div id="content">
        <nav id="navbar">
            <div class="navbar-includeGen">
                <div class="left-nav-div">
                    <img src="assets/img/logo.png" alt="Logo">
                </div>
                <div class="itens-nav-div">
                    <ul>
                        <li><a href="home.php">Página inicial</a></li>
                        <li><a href="saude.php">Saúde</a></li>
                        <li><a href="forum.php">Fórum</a></li>
                        <li><a href="entretenimento.php">Entretenimento </a></li>
                        <li><a href="previdencia.php">Previdência</a></li>
                    </ul>
                </div>
                <div class="right-nav-div">
                    <img src="assets/img/avatar_temp.webp" alt="Avatar">
                    <p style="color: white;"><?= htmlspecialchars($username); ?></p>
                </div>
                <div><a href="logout.php" class="img-sair"><img src="assets/img/sair.png" alt=""></a></div>
        </nav>

        <div id="banner">
            <div class="botao">
                <button class="button-voltar" onclick="history.back()">
                    <p>⬅ Voltar</p>
                </button>
            </div>
            <img src="./assets/img/image (7).png" class="idosos" alt="Idosos jogando carta.">
        </div>

        <div id="text">
            <div class="content">
                <h2>Jogos de memória</h2>
                <p>Jogos de memória são atividades cognitivas que ajudam a melhorar e manter a função cerebral. Esses jogos incluem quebra-cabeças, jogos de associação e jogos de palavras, que podem ser feitos individualmente ou em grupo. São ideais para manter a mente ativa e são recomendados para idosos com perda leve de memória. </p>
                <h4>Benefícios:</h4>
                <li>
                    <ul>Desenvolvimento cognitivo: Exercitam a memória, a concentração e o raciocínio lógico. </ul>
                    <ul>Prevenção do declínio mental: Podem ajudar a atrasar o progresso de doenças como o Alzheimer.</ul>
                    <ul>Estimulação mental divertida: Proporcionam diversão enquanto desafiam a mente. </ul>
                </li>
                <h4>Práticas recomendadas:</h4>
                <li>
                    <ul>Escolher jogos de diferentes níveis de dificuldade, para que sejam adequados às capacidades de cada idoso. </ul>
                    <ul>Oferecer desafios moderados que possam ser completados com facilidade, para manter a autoestima elevada. </ul>
                    <ul>Criar um ambiente calmo e estimulante para a atividade. </ul>
                </li>
            </div>
        </div>

        <div id="footer-div">
            <footer class="includeGen-footer">
                <div class="left-footer">
                    <img src="assets/img/logo.png" class="img-footer-logo" alt="Logo Include Gen" width="50vh">
                    <p>Unindo gerações através da inclusão</p>
                </div>

                <div class="right-footer">
                    <div class="contact-links">
                        <a href="https://instagram.com" target="_blank">
                            <img src="assets/img/instagram.png" id="instagram-contact" alt="Instagram IncludeGen">
                        </a>
                        <a href="https://facebook.com" target="_blank">
                            <img src="assets/img/facebook.png" id="facebook-contact" alt="Facebook IncludeGen">
                        </a>
                        <a href="https://twitter.com" target="_blank">
                            <img src="assets/img/x.png" id="twitter-contact" alt="Twitter IncludeGen">
                        </a>
                        <p>© 2024 IncludeGen. Todos os direitos reservados.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

</body>

</html>