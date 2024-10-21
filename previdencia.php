<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Previdenciário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #navbar {
            background-color: #111111;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-includeGen {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
        }

        .itens-nav-div ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .itens-nav-div ul li {
            margin: 0 15px;
        }

        .itens-nav-div ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        .itens-nav-div ul li a:hover {
            color: #ddd;
        }

        .right-nav-div img,
        .left-nav-div img {
            border-radius: 50%;
            height: 50px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .section {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section2 {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0px 160px 20px 160px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .inss {
            width: 200px;
            margin-left: 80px;
        }

        li {
            margin-bottom: 20px;
        }

        .step-by-step {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .step {
            flex-basis: 48%;
            margin-left: 70px;
        }

        #footer-div {
    background-color: #111111;
    color: white;
    padding: 20px;
}

.includeGen-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.left-footer {
    display: flex;
    align-items: center;
}

.img-footer-logo {
    margin-right: 10px;
}

.right-footer {
    display: flex;
    align-items: center;
}

.contact-links {
    display: flex;
    align-items: center;
}

.contact-links a {
    margin: 0 5px;
}

.contact-links p {
    margin-left: 10px;
    font-size: 14px;
}

    </style>
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
                        <li><a href="#">Saúde</a></li>
                        <li><a href="#">Fórum</a></li>
                        <li><a href="previdencia.php">Previdência</a></li>
                    </ul>
                </div>
                <div class="right-nav-div">
                    <img src="assets/img/avatar_temp.webp" alt="Avatar">
                </div>
            </div>
        </nav>
        <div class="header">
            <h1>Sistema Previdenciário</h1>
        </div>

        <div class="container">

            <div class="section">
                <h2>O que é o sistema previdenciário?</h2>
                <p>O sistema previdenciário é um agrupamento de normas relacionadas a auxílios sociais e aposentadorias
                    principalmente para trabalhadores e/ou contribuintes em geral. Ou seja, é uma forma de garantir uma
                    aposentadoria para a população que atinge determinada idade.</p>
                <img class="img-carteira" src="assets/img/carteira.png" alt="Carteira de Trabalho"
                    style="width:100%; max-width:800px; display:block; margin: 0 auto;">
            </div>

            <div class="section">
                <h2>O que é o sistema de pontos?</h2>
                <p>O sistema consiste na soma da idade com os anos de contribuição, exigindo um mínimo de 30 anos para
                    mulheres e 35 para homens. A reforma previdenciária introduziu variações nas regras de transição.
                </p>
                <table>
                    <tr>
                        <th>Ano</th>
                        <th>Pontos (Homens)</th>
                        <th>Pontos (Mulheres)</th>
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
                        <td>105 (limite)</td>
                        <td>96</td>
                    </tr>
                    <tr>
                        <td>2030</td>
                        <td>105 (limite)</td>
                        <td>97</td>
                    </tr>
                    <tr>
                        <td>2031</td>
                        <td>105 (limite)</td>
                        <td>98</td>
                    </tr>
                    <tr>
                        <td>2032</td>
                        <td>105 (limite)</td>
                        <td>99</td>
                    </tr>
                    <tr>
                        <td>2033</td>
                        <td>105 (limite)</td>
                        <td>100 (limite)</td>
                    </tr>
                    <tr>
                        <td>2034</td>
                        <td>105 (limite)</td>
                        <td>100 (limite)</td>
                    </tr>
                    <tr>
                        <td>...s</td>
                        <td>105 (limite)</td>
                        <td>100 (limite)</td>
                    </tr>

                </table>
            </div>

            <div class="section">
                <h2>Quais são os requisitos?</h2>
                <p>- Pontuação necessária: Homens precisam atingir 101 pontos e mulheres 91 pontos. A pontuação é uma
                    soma
                    da idade com o tempo de contribuição.<br>

                    - Idade mínima: A idade mínima de aposentadoria é de 65 anos para homens e 62 anos para
                    mulheres.<br>

                    - Tempo mínimo de contribuição: É preciso ter, no mínimo, 15 anos de contribuição.<br></p>
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
        </div>
        <div class="section2">
            <h2>Como acompanhar o pedido de aposentadoria</h2>
            <p>Após solicitar seu benefício, é essencial que você acompanhe como está o andamento de sua solicitação. Da
                mesma forma do requerimento, seu pedido pode ser acompanhado pelo Portal Meu INSS (na opção consultar
                pedidos), ou você pode ligar para o 135, que é a central de atendimento do INSS.<br> 
                É interessante que você cheque o andamento do procedimento pelo menos uma vez por semana após realizar o pedido.</p>
        </div>

        <div id="footer-div">
            <footer class="includeGen-footer">
                <div class="left-footer">
                    <img src="assets/img/logo.png" class="img-footer-logo" alt="Logo Include Gen" width="50vh">
                    <p>Unindo gerações através da inclusão</p>
                </div>

                <div class="right-footer">
                    <div class="contact-links">
                        <a href="https://instagram.com"><img src="assets/img/instagram.png" id="instagram-contact" alt="Instagram IncludeGen" width="50vh"></a>
                        <a href="https://facebook.com"><img src="assets/img/facebook.webp" id="facebook-contact" alt="Facebook IncludeGen" width="50vh"></a>
                        <a href="https://twitter.com"><img src="assets/img/twitter.png" id="twitter-contact" alt="Twitter IncludeGen" width="50vh"></a>
                        <p>© 2024 IncludeGen. Todos os direitos reservados.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>