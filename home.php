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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Bem-vindo à IncludeGen, uma plataforma dedicada ao bem-estar e à inclusão da pessoa idosa. Encontre cuidadores de idosos, explore alternativas de entretenimento, descubra oportunidades de trabalho para a terceira idade e entenda o sistema previdenciário brasileiro.">

    <title>Home - IncludeGen</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/responsivel-home.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
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
                        <li><a href="#">Página inicial</a></li>
                        <li><a href="#">Saúde</a></li>
                        <li><a href="#">Fórum</a></li>
                        <li><a href="#">Previdência</a></li>
                    </ul>
                </div>
                <div class="right-nav-div">
                    <img src="assets/img/avatar_temp.webp" alt="Avatar">
                    <p style="color: white;"><?= htmlspecialchars($username); ?></p>
                </div>
            </div>
        </nav>


        <div id="presentation">
            <div class="presentation-left">
                <h1>Unindo gerações através da inclusão</h1>
                <button>Saiba mais</button>
            </div>
            <div class="presentation-right">
                <img src="assets/img/presentation_seniors.png" alt="Idosos se abraçando">
            </div>
        </div>

        <div id="about-me">
            <div class="left-about-me">
                <h1>Sobre nós</h1>
                <p>Nulla facilisi. Vivamus congue tincidunt euismod. Proin nec ornare urna. Sed ullamcorper ante at nibh
                    finibus, tincidunt finibus odio varius. Curabitur et semper quam, eget posuere leo. Sed pharetra ex
                    ac sapien mattis convallis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet,
                    sapien quis dapibus placerat, quam dolor rutrum nunc, quis tristique mi diam vel nisi. Aenean
                    vehicula venenatis ligula. Fusce vehicula turpis quis sapien pellentesque pharetra. Pellentesque
                    habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis nec arcu vel
                    massa congue rhoncus.</p>
            </div>
            <div class="right-about-me">
                <img src="assets/img/about_me_seniors.png" alt="Idosos sobre mim">
            </div>
        </div>

        <div id="meet-seniors">
            <div class="left-meet-seniors">
                <h1>Encontre cuidadores de idosos</h1>
                <button>Explorar</button>
            </div>
            <div class="right-meet-seniors">
                <div class="carousel" id="carousel">
                    <img src="assets/img/meet_seniors_1.png" alt="Encontre Idosos imagem 1">
                    <img src="assets/img/meet_seniors_2.png" alt="Encontre Idosos imagem 2">
                    <img src="assets/img/meet_seniors_1.png" alt="Encontre Idosos imagem 1">
                    <img src="assets/img/meet_seniors_2.png" alt="Encontre Idosos imagem 2">
                </div>
            </div>
        </div>

        <div id="card-seniors">
            <div class="card">
                <div class="background-text">
                    <h2>Espaço saúde do idoso</h2>
                </div>
                <img src="assets/img/seniors_card1.png" alt="Encontre Idosos imagem 1" class="card-image">
                <div class="arrow-card">
                    <img src="assets/img/seta.webp" alt="Seta" width="50vh" class="arrow-image">
                </div>
            </div>

            <a href="atividades.php">
                <div class="card">
                    <div class="background-text">
                        <h2>Entretenimento para idosos</h2>
                    </div>
                    <img src="assets/img/seniors_card2.png" alt="Encontre Idosos imagem 2" class="card-image">
                    <div class="arrow-card">
                        <img src="assets/img/seta.webp" alt="Seta" width="50vh" class="arrow-image">
                    </div>
                </div>
            </a>

            <div class="card">
                <div class="background-text">
                    <h2>Trabalho para maioridade</h2>
                </div>
                <img src="assets/img/seniors_card3.png" alt="Encontre Idosos imagem 3" class="card-image">
                <div class="arrow-card">
                    <img src="assets/img/seta.webp" alt="Seta" width="50vh" class="arrow-image">
                </div>
            </div>
            <div class="card">
                <div class="background-text">
                    <h2>Cálculo e notícias da previdência</h2>
                </div>
                <img src="assets/img/seniors_card4.png" alt="Encontre Idosos imagem 4" class="card-image">
                <div class="arrow-card">
                    <img src="assets/img/seta.webp" alt="Seta" width="50vh" class="arrow-image">
                </div>
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
                        <a href="https://instagram.com"><img src="assets/img/instagram.png" id="instagram-contact"
                                alt="Instagram IncludeGen" width="50vh"></a>
                        <a href="https://facebook.com"><img src="assets/img/facebook.webp" id="facebook-contact"
                                alt="Facebook IncludeGen" width="50vh"></a>
                        <a href="https://twitter.com"><img src="assets/img/twitter.png" id="twitter-contact"
                                alt="Twitter IncludeGen" width="50vh"></a>
                        <p>© 2024 IncludeGen. Todos os direitos reservados.</p>
                    </div>
                </div>
            </footer>
        </div>

    </div>

    <a href="logout.php">sair</a>
    <script src="assets/js/home.js"></script>
</body>

</html>