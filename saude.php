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
                          <li><a href="entretenimento.php">Entretenimento </a></li>
                          <li><a href="previdencia.php">Previdência</a></li>
                      </ul>
                  </div>
                  <div class="right-nav-div">
                      <img src="assets/img/avatar_temp.webp" alt="Avatar">
                      <p style="color: white;"><?= htmlspecialchars($username); ?></p>
                  </div>
                  </nav>
              </div>
              
  <section class="hero">
    <img src="assets/img/sorrindo-idosos.png" alt="Idosos sorrindo">
  </section>


  <section class="profissionais">
    <h2>Encontre profissionais para te ajudar</h2>
    <div class="cards-container">
      <div class="card">
        <img src="assets/img/mulher.png" alt="Ana Laura">
        <h3>Ana Laura</h3>
        <p>Me chamo Ana Laura tenho 35 anos e possuo 10 anos de experiência com cuidados com idosos.</p>
        <button><a href="perfil-AnaLaura.php">Saiba mais</a></button>
      </div>
      <div class="card">
        <img src="assets/img/mulher.png" alt="Ana Laura">
        <h3>Ana Laura</h3>
        <p>Me chamo Ana Laura tenho 35 anos e possuo 10 anos de experiência com cuidados com idosos.</p>
        <button><a href="perfil.php">Saiba mais</a></button>
      </div>
      <div class="card">
        <img src="assets/img/mulher.png" alt="Ana Laura">
        <h3>Ana Laura</h3>
        <p>Me chamo Ana Laura tenho 35 anos e possuo 10 anos de experiência com cuidados com idosos.</p>
        <button><a href="perfil.php">Saiba mais</a></button>
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
        <button>Saiba mais</button>
      </div>
      <div class="card">
        <img src="assets/img/alzheimer.png" alt="Alzheimer">
        <h3>Alzheimer: Saiba tudo sobre ela</h3>
        <p>O que é o Alzheimer, causas, prevenção e tratamento.</p>
        <button>Saiba mais</button>
      </div>
      <div class="card">
        <img src="assets/img/alzheimer.png" alt="Alzheimer">
        <h3>Alzheimer: Saiba tudo sobre ela</h3>
        <p>O que é o Alzheimer, causas, prevenção e tratamento.</p>
        <button>Saiba mais</button>
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
