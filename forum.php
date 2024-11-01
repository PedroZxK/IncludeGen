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
    <link rel="stylesheet" href="assets/css/forum.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
    <title>Forum</title>
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

            <div id="forum-content">
    <div class="search-category-section">
        <div class="search-bar">
            <input type="text" placeholder="Pesquise algum fórum">
            <button>🔍</button>
        </div>
        <div class="category-section">
            <h3>Categoria</h3>
            <ul>
                <li><a href="#">Tudo</a></li>
                <li><a href="#">Saúde</a></li>
                <li><a href="#">Entretenimento</a></li>
                <li><a href="#">Dúvida</a></li>
                <li><a href="#">Conselho</a></li>
                <li><a href="#">Recomendação</a></li>
            </ul>
        </div>
    </div>

    <div class="forum-post-section">
        <div class="new-post">
            <input type="text" placeholder="Título">
            <textarea placeholder="Descrição"></textarea>
            <div class="tag-buttons">
                <span>#Saúde</span>
                <span>#Dúvida</span>
                <span>#Conselho</span>
                <span>#Recomendação</span>
                <span>#Entretenimento</span>
            </div>
            <button class="publish-btn">Publicar</button>
        </div>

        <div class="post">
            <h4>O que eu devo fazer para aumentar minha imunidade?</h4>
            <p>eu acho que a minha imunidade está muito baixa, gostaria de aumentar ela mas não sei quais alimentos eu devo consumir para aumentá-la</p>
            <div class="post-tags">
                <span>#Saúde</span>
                <span>#Dúvida</span>
                <span>#Conselho</span>
                <span>#Recomendação</span>
            </div>
            <div class="post-info">
                <span>6 comentários</span>
                <span>6 horas atrás</span>
                <span>❤️ 666</span>
            </div>
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
                        <a href="https://instagram.com"><img src="assets/img/instagram.png" id="instagram-contact" alt="Instagram IncludeGen"></a>
                        <a href="https://facebook.com"><img src="assets/img/facebook.png" id="facebook-contact" alt="Facebook IncludeGen"></a>
                        <a href="https://twitter.com"><img src="assets/img/x.png" id="twitter-contact" alt="Twitter IncludeGen"></a>
                        <p>© 2024 IncludeGen. Todos os direitos reservados.</p>
                    </div>
                </div>
            </footer>
        </div>
</body>
</html>