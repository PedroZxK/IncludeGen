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
    <link rel="stylesheet" href="assets\css\perfilee.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png"> 
    <title>Perfil - Ana Laura</title>
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
                <div><a href="logout.php" class="img-sair"><img src="assets/img/sair.png" alt=""></a></div>
                </nav>
            </div>
            

            <section class="hero">
  <img src="assets/img/sorrindo-idosos.png" alt="Idosos sorrindo">
</section>

<main class="profile-container">
  <div class="profile-card">
    <img src="assets/img/padrao.png" alt="Foto de Ana Laura" class="profile-photo">
    <h2>Padrão Enfermagem</h2>
    <p>35 anos</p>
    <p>analauracontato@gmail.com</p>
    <p>(12)345678910</p>
    <div class="social-icons">
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-x-twitter"></i></a>
      <a href="#"><i class="fab fa-whatsapp"></i></a>
      <a href="#"><i class="fab fa-linkedin"></i></a>
    </div>
  </div>
  
  <div class="bio-card">
    <h2>Sobre</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eget dui in ex lobortis dignissim. Quisque non turpis nunc. Curabitur fermentum nulla eget sapien suscipit consequat ac quis enim. Nulla convallis magna id enim viverra, et mollis orci malesuada. Mauris non massa mi. Aliquam eu ante non.</p>
  </div>
</main>

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