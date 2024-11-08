<?php
date_default_timezone_set('America/Sao_Paulo');

include 'conexao.php';
include 'validacao.php';

$mysqli = new mysqli($hostname, $username, $password, $database);

if (isset($_GET['id'])) {
    $pergunta_id = $_GET['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensagem = isset($_POST['mensagem']) ? $_POST['mensagem'] : '';
    $pergunta_id = isset($_POST['pergunta_id']) ? $_POST['pergunta_id'] : '';

    if (!empty($mensagem) && !empty($pergunta_id)) {
        $nome_usuario = isset($_SESSION['name']) ? $_SESSION['name'] : '';

        $data_atual = date('Y-m-d H:i:s');

        $mysqli->query("INSERT INTO chat1 (nome, mensagem, data_envio, pergunta_id) VALUES ('$nome_usuario', '$mensagem', '$data_atual', '$pergunta_id')");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $ultimaMensagemID = isset($_GET['ultima_mensagem_id']) ? intval($_GET['ultima_mensagem_id']) : 0;
    $mensagens_query = "SELECT nome, mensagem, data_envio, id FROM chat1 WHERE pergunta_id = $pergunta_id AND id > $ultimaMensagemID ORDER BY id DESC";
    $mensagens_result = $mysqli->query($mensagens_query);
}

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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum:
        <?php echo isset($_GET['titulo']) ? htmlspecialchars($_GET['titulo']) : "Pergunta"; ?>
    </title>
    <link rel="stylesheet" href="assets/css/pergunta.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logourl.png">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

    <script src="assets/js/logout.js"></script>
    <script type="text/javascript">
        var ultimaMensagemID = 0;

        function ajax() {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('mensagens').innerHTML = req.responseText;
                }
            }

            req.open('GET', 'chat.php?pergunta_id=<?php echo $pergunta_id; ?>&ultima_mensagem_id=' + ultimaMensagemID, true);
            req.send();
        }

        setInterval(function () {
            ajax();
        }, 1000);
    </script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
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


        <div id="header">
            <h1 id="pergunta_titulo">
                <?php echo isset($_GET['titulo']) ? htmlspecialchars($_GET['titulo']) : "Pergunta"; ?>
            </h1>
            <a id="voltar" href="forum.php">Voltar</a>
        </div>

        <div id="mensagens">
        </div>

    </div>
    </div>
    <div class="main-content">
        <form method="post" action="" id="form-mensagem">
            <input type="text" name="mensagem" placeholder="Digite sua mensagem..." id="mensagem">
            <input type="hidden" name="pergunta_id" value="<?php echo $pergunta_id; ?>">
        </form>
    </div>

</body>

</html>

<?php
$mysqli->close();
?>