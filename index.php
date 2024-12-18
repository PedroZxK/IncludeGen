<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IncludeGen</title>
    <link rel="stylesheet" href="assets\css\landingPage.css">
    <link rel="stylesheet" href="assets/CSS/landingPageResponsivo.css">
    <link rel="shortcut icon" href="assets\img\logo.png" type="image/x-icon">
    <link rel="icon" href="logo.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="assets\img\logo.png" alt="Logo IncludeGen">
            </div>
            <ul class="nav-links">
                <li><a href="#inicio">Início</a></li>
                <li><a href="#categoria-missao">Missão</a></li>
                <li class="btn-nav-principal"><a href="login.php">Entrar</a></li>
                <li class="btn-nav-principal"><a href="cadastro.php">Cadastrar-se</a></li>
            </ul>
            <button class="hamburguer">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div id="sidebar">
                <button class="fechar" onclick="toggleMenu()">
                    X
                </button>
                <a class="sidebarlink" href="#inicio">Início</a>
                <a class="sidebarlink" href="#missao">Missão</a>
                <a class="sidebarlink" href="login.php">Entrar</a>
                <a class="sidebarlink" href="cadastro.php">Cadastre-se</a>
            </div>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-text">
            <h1>Unindo gerações através da inclusão</h1>
        </div>
        <div class="hero-image">
            <img src="assets\img\image 8.png" alt="Imagem inclusão">
        </div>
    </section>

    <div id="categoria-missao">
        <img src="assets\img\image 7.png" alt="" class="missao-img">
        <section class="mission">
            <h2>Conectando pessoas de todas as idades, criando um futuro mais inclusivo.</h2>
            <p>Incluir é unir, e no IncludeGen, essa é a nossa missão.</p>
            <a href="home.php">
                <button class="mission-button">Conhecer a missão</button>
            </a>
        </section>
    </div>

    <section class="features" id="missao">
        <h2>Nossa missão de inclusão com você</h2>
        <div class="feature-boxes">
            <div class="feature">
                <div id="figura"><img src="assets\img\Entretenimento.png" alt="Entretenimento para idosos"></div>
                <p>Entretenimento para idosos</p>
            </div>
            <div class="feature">
                <div id="figura"> <img src="assets\img\cuidadores.png" alt="Cadastro e procura de cuidadores"></div>
                <p>Cadastro e procura de cuidadores</p>
            </div>
            <div class="feature">
                <div id="figura"> <img src="assets\img\direito.png" alt="Direito dos idosos"></div>
                <p>Mais sobre o direito dos idosos</p>
            </div>
            <div class="feature">
                <div id="figura"> <img src="assets\img\atividadesfisicas.png" alt="Atividades físicas para idosos"></div>
                <p>Atividades físicas para idosos</p>
            </div>
        </div>
    </section>

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

    <script src="./assets/js/hamburguer.js"></script>
</body>

</html>