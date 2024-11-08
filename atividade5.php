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
    <link rel="stylesheet" href="assets/CSS/atividade1Responsivo.css">
    <script src="./assets/js/hamburguer.js"></script>
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
                    <li><a href="entretenimento.php">Entretenimento</a></li>
                    <li><a href="previdencia.php">Previdência</a></li>
                </ul>
            </div>
            <div class="right-nav-div">
                <img src="assets/img/avatar_temp.webp" alt="Avatar">
                <p style="color: white;"><?= htmlspecialchars($username); ?></p>
            </div>
            <div><a href="logout.php" class="img-sair"><img src="assets/img/sair.png" alt=""></a></div>

            <button class="hamburguer">
          <span></span>
          <span></span>
          <span></span>
        </button>

        <div id="sidebar">
          <button class="fechar" onclick="toggleMenu()">
            X
          </button>
          <a class="sidebarlink" href="home.php">Página Inicial</a>
          <a class="sidebarlink" href="saude.php">Saúde</a>
          <a class="sidebarlink" href="forum.php">Fórum</a>
          <a class="sidebarlink" href="entretenimento.php">Entretenimento</a>
          <a class="sidebarlink" href="previdencia.php">Previdência</a>
          <a class="sidebarlink" href="logout.php">Sair</a>
        </div>
    </nav>

        <div id="banner">
            <div class="botao">
                <button class="button-voltar" onclick="history.back()">
                    <p>⬅ Voltar</p>
                </button>
            </div>
            <img src="./assets/img/image (11).png" class="idosos" alt="Idosos jogando carta.">
        </div>

        <div id="text">
            <div class="content">
                <h2>Aulas de dança</h2>
                <p>As aulas de dança são muito populares entre idosos, promovendo atividade física, coordenação motora, equilíbrio e socialização. Danças como valsa, samba e danças de salão são particularmente apreciadas. Além disso, a música presente nas aulas pode ter efeitos emocionais positivos, trazendo recordações agradáveis.</p>
                <h4>Benefícios:</h4>
                <li>
                    <ul>Saúde física: Melhora o condicionamento físico, o equilíbrio e a força.</ul>
                    <ul>Saúde mental e emocional: A música e o movimento são estimulantes e ajudam a reduzir sintomas de ansiedade e depressão.</ul>
                    <ul>Estimulação mental divertida: Proporcionam diversão enquanto desafiam a mente.</ul>
                </li>
                <h4>Práticas recomendadas:</h4>
                <li>
                    <ul>Oferecer aulas com ritmos variados, adequados para a faixa etária e o condicionamento físico.</ul>
                    <ul>Criar um ambiente de acolhimento e diversão, onde os idosos se sintam confortáveis para participar.</ul>
                    <ul>Adaptar os movimentos para respeitar os limites físicos de cada participante.</ul>
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