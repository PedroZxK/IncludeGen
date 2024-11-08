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
  <title>Saúde e Bem-Estar</title>
  <link rel="stylesheet" href="assets\css\saude.css">
  <link rel="stylesheet" href="assets/CSS/saudeResponsivo.css">
  <script src="./assets/js/hamburguer.js"></script>
  <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
  </div>

  <section class="hero">
    <img src="assets/img/sorrindo-idosos.png" alt="Idosos sorrindo">
  </section>


  <section class="profissionais">
    <h2>Encontre profissionais da região para te ajudar</h2>
    <div class="cards-container">
      <div class="card">
        <img src="assets/img/padrao.png" alt="Ana Laura">
        <h3>Padrão Enfermagem</h3>
        <p>A Padrão Enfermagem São José dos Campos é uma empresa especializada na intermediação de profissionais da Enfermagem e Cuidadores de Idosos, Adultos e Crianças.</p>
        <button><a href="sobreEmpresa1.php">Saiba mais</a></button>
      </div>
      <div class="card">
        <img src="assets/img/family.png" alt="Ana Laura">
        <h3>Family Care Senior</h3>
        <p>Precisa de cuidador de idosos de confiança? Family Care Senior, o melhor custo benefício do Vale do Paraíba. Oferecem uma gama completa de serviços de cuidado, voltados para atender todas as necessidades dos clientes.</p>
        <button><a href="sobreEmpresa2.php">Saiba mais</a></button>
      </div>
      <div class="card">
        <img src="assets/img/cuida.png" alt="Ana Laura">
        <h3>Cuidadores do Vale</h3>
        <p>Atender a necessidade do mercado oferecendo segurança e conforto ao assistido, assim como prestar sempre um serviço de elevado padrão de qualidade, garantindo tranquilidade para a família que contrata a prestação do serviço.</p>
        <button><a href="sobreEmpresa3.php">Saiba mais</a></button>
      </div>
    </div>
  </section>


  <section class="saude">
    <h2>Saúde nunca é demais</h2>
    <div class="cards-container">
      <div class="card">
        <img src="assets/img/alzheimer.png" alt="Alzheimer">
        <h3>Alzheimer: Saiba tudo sobre ela</h3>
        <p>O que é o Alzheimer, causas, prevenção e tratamento.</p>
        <a href="alzheimer.php"><button>Saiba mais</button></a>
      </div>
      <div class="card">
        <img src="assets/img/alzheimer.png" alt="Alzheimer">
        <h3>Alzheimer: Saiba tudo sobre ela</h3>
        <p>O que é o Alzheimer, causas, prevenção e tratamento.</p>
        <a href="alzheimer.php"><button>Saiba mais</button></a>
      </div>
      <div class="card">
        <img src="assets/img/alzheimer.png" alt="Alzheimer">
        <h3>Alzheimer: Saiba tudo sobre ela</h3>
        <p>O que é o Alzheimer, causas, prevenção e tratamento.</p>
        <a href="alzheimer.php"><button>Saiba mais</button></a>
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