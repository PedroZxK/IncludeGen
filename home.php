<?php
include 'conexao.php';
include 'validacao.php';

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
            $foto_perfil = $row['foto_perfil'];
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
    <link rel="stylesheet" href="assets/css/homeResponsivo.css">
    <script src="./assets/js/hamburguer.js"></script>
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
</head>

<body>
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
                <img src="<?= htmlspecialchars($foto_perfil); ?>" alt="Avatar">
                <div class="profile">
                    <p class="profile-name"><?= htmlspecialchars($username); ?></p>
                    <a class="view-profile-link" href="./perfil.php">ver perfil</a>
                </div>
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
            </div>
    </nav>

    <div id="content">
        <div id="presentation">
            <div class="presentation-left">
                <h1>Unindo gerações através da inclusão</h1>
                <a href="#about-me">
                    <button>Saiba mais</button>
                </a>
            </div>
            <div class="presentation-right">
                <img src="assets/img/idosoimghome.png" alt="Idosos se abraçando">
            </div>
        </div>

        <div id="about-me">
            <div class="left-about-me">
                <h1>Sobre nós</h1>
                <p>Na IncludeGen, nossa missão é apoiar os idosos, oferecendo informações
                    essenciais para seu bem-estar e autonomia. Sabemos que o mundo está
                    em constante mudança, e queremos garantir que todos, independentemente
                    da idade, tenham acesso às novidades que impactam suas vidas. Nossa equipe
                    está dedicada a fornecer conteúdos relevantes e de fácil compreensão,
                    ajudando-os a ficar por dentro de assuntos importantes como saúde, entretenimento
                    e cuidados especiais. Estamos aqui para tornar a inclusão digital uma
                    realidade para todos.</p>
            </div>
            <div class="right-about-me">
                <img src="assets/img/about_me_seniors.png" alt="Idosos sobre mim">
            </div>
        </div>

        <div id="meet-seniors">
            <div class="left-meet-seniors">
                <h1>Encontre cuidadores de idosos</h1>
                <a href="saude.php">
                    <button>Explorar</button>
                </a>
            </div>
            <div class="right-meet-seniors">
                <div class="img-container">
                    <img src="./assets/img/cuidador-de-idosos1.jpg">
                    <img src="./assets/img/cuidador-de-idosos2.jpg">
                    <img src="./assets/img/cuidador-de-idosos3.jpg">
                    <img src="./assets/img/cuidador-de-idosos4.jpg">
                    <img src="./assets/img/cuidador-de-idosos1.jpg">
                    <img src="./assets/img/cuidador-de-idosos2.jpg">
                    <img src="./assets/img/cuidador-de-idosos3.jpg">
                    <img src="./assets/img/cuidador-de-idosos4.jpg">
                </div>
            </div>
        </div>

        <div id="card-seniors">
            <a href="saude.php">
                <div class="card">
                    <div class="background-text">
                        <h2>Espaço saúde do idoso</h2>
                    </div>
                    <img src="assets/img/seniors_card1.png" alt="Encontre Idosos imagem 1" class="card-image">
                    <div class="arrow-card">
                        <img src="assets/img/seta.webp" alt="Seta" width="50vh" class="arrow-image">
                    </div>
                </div>
            </a>

            <a href="entretenimento.php">
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

            <a href="forum.php">
                <div class="card">
                    <div class="background-text">
                        <h2>Forum para mentoria e suporte</h2>
                    </div>
                    <img src="assets/img/seniors_card3.png" alt="Encontre Idosos imagem 3" class="card-image">
                    <div class="arrow-card">
                        <img src="assets/img/seta.webp" alt="Seta" width="50vh" class="arrow-image">
                    </div>
                </div>
            </a>
            <a href="previdencia.php">
                <div class="card">
                    <div class="background-text">
                        <h2>Cálculo e notícias da previdência</h2>
                    </div>
                    <img src="assets/img/seniors_card4.png" alt="Encontre Idosos imagem 4" class="card-image">
                    <div class="arrow-card">
                        <img src="assets/img/seta.webp" alt="Seta" width="50vh" class="arrow-image">
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div id="footer-div">
        <footer class="includeGen-footer">
            <div class="left-footer">
                <img src="assets/img/logo.png" class="img-footer-logo" alt="Logo Include Gen" width="50vh">
                <p>Unindo gerações através da inclusão</p>
            </div>

            <div class="right-footer">
                <div class="documents">
                    <a href="termos.php" target="_blank" class="termos">Termos de serviço</a>
                    <a href="politicas.php" target="_blank" class="termos">Política de privacidade</a>
                </div>
                <div class="contact-links">
                    <a href="https://www.instagram.com/senaitaubate/" target="_blank">
                        <img src="assets/img/instagram.png" id="instagram-contact" alt="Instagram IncludeGen">
                    </a>
                    <a href="https://www.facebook.com/senaisp.taubate" target="_blank">
                        <img src="assets/img/facebook.png" id="facebook-contact" alt="Facebook IncludeGen">
                    </a>
                    <p>© 2024 IncludeGen. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/js/home.js"></script>
</body>

</html>