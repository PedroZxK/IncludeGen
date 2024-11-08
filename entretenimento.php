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
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Bem-vindo à IncludeGen, uma plataforma dedicada ao bem-estar e à inclusão da pessoa idosa. Encontre cuidadores de idosos, explore alternativas de entretenimento, descubra oportunidades de trabalho para a terceira idade e entenda o sistema previdenciário brasileiro.">
    <title>Entretenimento - IncludeGen</title>
    <link rel="stylesheet" href="assets/css/entretenimento.css">
    <link rel="stylesheet" href="assets/css/entretenimentoResponsivo.css">
    <script src="./assets/js/hamburguer.js"></script>
    <link rel="shortcut icon" type="imagex/png"
        href="assets/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
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
          <a class="sidebarlink" href="logout.php">Sair</a>
        </div>
    </nav>

    <div id="content">
        <div id="banner">
            <img class="banner" src="assets/img/entretenimento-banner.png" alt="Idoso andando de bicicleta">
        </div>

        <div id="topicos">

            <div class="card1">
                <div class="card-img">
                    <img class="card-img" src="./assets/img/image (1).jpg" alt="Idosos se divertindo com jogos">
                </div>
                <p class="title">Jogos de memória</p>
                <p class="card-text">Jogos de memória são atividades cognitivas que ajudam a melhorar e manter a função cerebral.</p>
                <a href="atividade1.php">
                    <button>
                        <p>Saiba mais</p>
                    </button>
                </a>

            </div>

            <div class="card1">
                <div class="card-img">
                    <img class="card-img" src="./assets/img/image (2).jpg" alt="Idosos se divertindo com jogos">
                </div>
                <p class="title">Passeios ao ar livre</p>
                <p class="card-text">Os passeios ao ar livre são fundamentais para a saúde física e mental dos idosos.</p>
                <a href="atividade2.php">
                    <button>
                        <p>Saiba mais</p>
                    </button>
                </a>
            </div>

            <div class="card1">
                <div class="card-img">
                    <img class="card-img" src="./assets/img/image (3).jpg" alt="Idosos se divertindo com jogos">
                </div>
                <p class="title">Jogos de tabuleiro</p>
                <p class="card-text">Jogos de tabuleiro são atividades cognitivas e sociais ideais para idosos.</p>
                <a href="atividade3.php">
                    <button>
                        <p>Saiba mais</p>
                    </button>
                </a>
            </div>

            <div class="card1">
                <div class="card-img">
                    <img class="card-img" src="./assets/img/image (4).jpg" alt="Idosos se divertindo com jogos">
                </div>
                <p class="title">Grupos de leitura</p>
                <p class="card-text">Grupos de leitura incentivam a leitura em conjunto e oferecem espaço para discussões sobre livros e temas variados.</p>
                <a href="atividade4.php">
                    <button>
                        <p>Saiba mais</p>
                    </button>
                </a>
            </div>

            <div class="card1">
                <div class="card-img">
                    <img class="card-img" src="./assets/img/image (5).jpg" alt="Idosos se divertindo com jogos">
                </div>
                <p class="title">Aulas de dança</p>
                <p class="card-text">As aulas de dança são muito populares entre idosos, promovendo atividade física, coordenação motora, equilíbrio e socialização.</p>
                <a href="atividade5.php">
                    <button>
                        <p>Saiba mais</p>
                    </button>
                </a>
            </div>

            <div class="card1">
                <div class="card-img">
                    <img class="card-img" src="./assets/img/image (6).jpg" alt="Idosos se divertindo com jogos">
                </div>
                <p class="title">Música e canto</p>
                <p class="card-text">A música e o canto têm efeitos profundos na saúde mental e emocional dos idosos.</p>
                <a href="atividade6.php">
                    <button>
                        <p>Saiba mais</p>
                    </button>
                </a>
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

</body>

</html>