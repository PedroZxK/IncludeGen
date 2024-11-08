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
    <meta name="description" content="IncludeGen - Bem-estar e inclusão para a pessoa idosa.">
    <title>Alzheimer - IncludeGen</title>
    <link rel="stylesheet" href="assets/css/alzheimer.css">
    <link rel="stylesheet" href="assets/CSS/alzheimerResponsivo.css">
    <script src="./assets/js/hamburguer.js"></script>
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
    </div>

    <div id="background-voltar">
        <a href="javascript:history.back()">
            <button>← Voltar</button>
        </a>
        <div class="background-info">
            <h1>Alzheimer: Saiba tudo sobre a doença</h1>
        </div>
    </div>

    <div id="background-page">
        <p>A doença de Alzheimer é um distúrbio neurodegenerativo progressivo que afeta a memória, o pensamento e o comportamento. Ela é a forma mais comum de demência, responsável por aproximadamente 60% a 80% dos casos de demência em todo o mundo.</p>
        <img src="assets/img/saiba_sobre_alzheimer.jpg" alt="Pensador">

        <h1>O que é a Doença de Alzheimer?</h1>
        <p>O Alzheimer é uma doença que provoca a morte das células cerebrais, levando à perda de memória e a um declínio em outras habilidades cognitivas. À medida que a doença avança, as pessoas podem perder a capacidade de realizar tarefas diárias e podem precisar de assistência constante. A doença geralmente se manifesta em pessoas com mais de 65 anos, embora também possa ocorrer em pessoas mais jovens.</p>

        <h1>Sintomas da Doença de Alzheimer</h1>
        <p>Os sintomas do Alzheimer incluem perda de memória, confusão, dificuldade para resolver problemas, desorientação quanto ao tempo e espaço, dificuldade para se comunicar, mudanças de humor e comportamento, e perda de iniciativa. No estágio inicial, a perda de memória pode ser sutil, mas com o tempo, os sintomas se tornam mais graves e afetam significativamente a vida diária.</p>

        <h1>Causas e Fatores de Risco</h1>
        <p>A causa exata do Alzheimer ainda não é completamente compreendida, mas sabe-se que envolve a formação de placas e emaranhados no cérebro, causados por proteínas chamadas beta-amiloide e tau. Fatores de risco incluem idade avançada, histórico familiar, e fatores genéticos. Além disso, fatores de estilo de vida, como sedentarismo, alimentação inadequada e falta de atividade mental, podem aumentar o risco.</p>

        <h1>Tratamento e Prevenção</h1>
        <p>Embora não haja cura para o Alzheimer, tratamentos estão disponíveis para ajudar a aliviar alguns sintomas e melhorar a qualidade de vida dos pacientes. Medicações e terapias focadas na cognição, exercício físico e uma dieta saudável podem ajudar a reduzir o risco e a progressão da doença. Pesquisas estão em andamento para encontrar tratamentos mais eficazes e, possivelmente, uma cura para o Alzheimer.</p>

        <iframe
            width="100%"
            height="315"
            src="https://www.youtube.com/embed/ArFbR6-wKSI"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
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