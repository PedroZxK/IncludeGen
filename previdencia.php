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
    <title>Sistema Previdenciário</title>
    <link rel="shortcut icon" href="assets\img\logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/previdencia.css">
    <link rel="stylesheet" href="assets/CSS/previdenciaResponsivo.css">
    <script src="./assets/js/hamburguer.js"></script>
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
                    <a class="sidebarlink" href="previdencia.php">Previdência</a>]         
                    <a class="sidebarlink" href="logout.php">Sair</a>
                </div>
        </nav>
    </div>
    <div class="container">

        <div class="section">
            <h2>O que é o sistema previdenciário?</h2>
            <p>O sistema previdenciário é um agrupamento de normas relacionadas a auxílios sociais e aposentadorias
                principalmente para trabalhadores e/ou contribuintes em geral. Ou seja, é uma forma de garantir uma
                aposentadoria para a população que atinge determinada idade.</p>
            <iframe class='iframe' width="560" height="315"  src="https://www.youtube.com/embed/5-FGMB6p_Sc?si=ox8VgyjcPURunB2Z"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>

        <div class="section">
            <h2>O que é o sistema de pontos?</h2>
            <p>O sistema consiste na soma da idade com os anos de contribuição, exigindo um mínimo de 30 anos para
                mulheres e 35 para homens. A reforma previdenciária introduziu variações nas regras de transição.
            </p>
            <table>
                <tr>
                    <th class="tituloTabela">Ano</th>
                    <th class="tituloTabela">Pontos (Homens)</th>
                    <th class="tituloTabela">Pontos (Mulheres)</th>
                </tr>
                <tr>
                    <td>2019</td>
                    <td>96</td>
                    <td>86</td>
                </tr>
                <tr>
                    <td>2020</td>
                    <td>97</td>
                    <td>87</td>
                </tr>
                <tr>
                    <td>2021</td>
                    <td>98</td>
                    <td>88</td>
                </tr>
                <tr>
                    <td>2022</td>
                    <td>99</td>
                    <td>89</td>
                </tr>
                <tr>
                    <td>2023</td>
                    <td>100</td>
                    <td>90</td>
                </tr>
                <tr>
                    <td>2024</td>
                    <td>101</td>
                    <td>91</td>
                </tr>
                <tr>
                    <td>2025</td>
                    <td>102</td>
                    <td>92</td>
                </tr>
                <tr>
                    <td>2026</td>
                    <td>103</td>
                    <td>93</td>
                </tr>
                <tr>
                    <td>2027</td>
                    <td>104</td>
                    <td>94</td>
                </tr>
                <tr>
                    <td>2028</td>
                    <td>105 (limite)</td>
                    <td>95</td>
                </tr>
                <tr>
                    <td>2029</td>
                    <td>105</td>
                    <td>96</td>
                </tr>
                <tr>
                    <td>2030</td>
                    <td>105</td>
                    <td>97</td>
                </tr>
                <tr>
                    <td>2031</td>
                    <td>105</td>
                    <td>98</td>
                </tr>
                <tr>
                    <td>2032</td>
                    <td>105</td>
                    <td>99</td>
                </tr>
                <tr>
                    <td>2033</td>
                    <td>105</td>
                    <td>100 (limite)</td>
                </tr>
                <tr>
                    <td>2034</td>
                    <td>105</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>...</td>
                    <td>105</td>
                    <td>100</td>
                </tr>

            </table>
        </div>

        <div class="section">
            <h2>Quais são os requisitos?</h2>
            <p><span>Pontuação necessária:</span> Homens precisam atingir 101 pontos e mulheres 91 pontos. A pontuação é
                uma
                soma
                da idade com o tempo de contribuição.</p>

            <p><span>Idade mínima:</span> A idade mínima de aposentadoria é de 65 anos para homens e 62 anos para
                mulheres.</p>

            <p><span>Tempo mínimo de contribuição:</span> É preciso ter, no mínimo, 15 anos de contribuição.</p>
        </div>


        <div class="section">
            <h2>Passo a passo para realizar seu pedido de aposentadoria</h2>
            <div class="step-by-step">
                <div class="step">
                    <li>1- Acesse o app Meu INSS e faça login;</li>
                    <img class="inss" src="assets/img/inss.jpg" alt="">
                </div>
                <div class="step">
                    <li>2- Na página inicial, clique em "Novo Pedido";</li>
                    <img class="inss" src="assets/img/inss2.jpg" alt="">
                </div>
            </div>
            <div class="step-by-step">
                <div class="step">
                    <li>3- Selecione o tipo de aposentadoria que deseja solicitar;</li>
                    <img class="inss" src="assets/img/inss3.jpg" alt="">
                </div>
                <div class="step">
                    <li>4- Clique em "Avançar" e responda as perguntas.</li>
                    <img class="inss" src="assets/img/inss4.jpeg" alt="">
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Como acompanhar o pedido de aposentadoria</h2>
            <p>Após solicitar seu benefício, é essencial que você acompanhe como está o andamento de sua solicitação. Da
                mesma forma do requerimento, seu pedido pode ser acompanhado pelo Portal Meu INSS (na opção consultar
                pedidos), ou você pode ligar para o 135, que é a central de atendimento do INSS.</p>
            <p>É interessante que você cheque o andamento do procedimento pelo menos uma vez por semana após realizar o
                pedido.</p>
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