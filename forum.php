<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login");
    exit;
}

include 'conexao.php';

$mysqli = new mysqli($hostname, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['criar_pergunta'])) {
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];

        $sql = "INSERT INTO perguntas (titulo, descricao) VALUES ('$titulo', '$descricao')";
        $resultado = $mysqli->query($sql);

        header("Location: forum");
        exit();
    }

    if (isset($_POST['editar_pergunta'])) {
        $id = $_POST['editar_pergunta'];
        header("Location: editar_noticia?id=$id");
        exit();
    }

    if (isset($_POST['excluir_pergunta'])) {
        $id = $_POST['excluir_pergunta'];
        if ($_SESSION['email'] === 'admin@gmail.com') {
            echo '<script>';
            echo 'if (confirm("Tem certeza de que deseja excluir esta pergunta?")) {';
            echo 'window.location.href = "excluir_noticia?id=' . $id . '";';
            echo '}';
            echo '</script>';
        }
    }
}

$sql = "SELECT * FROM perguntas";
$resultado = $mysqli->query($sql);
$perguntas = array();

while ($pergunta = $resultado->fetch_assoc()) {
    $perguntas[] = $pergunta;
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
    <title>Fórum - RigRover</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/forum.css">
    <link rel="stylesheet" href="assets\css\responsividade\forum-responsivo.css">
    <script src="assets/js/hamburguinho.js"></script>
    <script src="assets/js/dropdownuser.js"></script>
    <script src="assets/js/logout.js"></script>

        <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        <div class="main-content">
            <div class="noticias">

                <form method="post" action="">

                    <div class="criar-pergunta">
                    <div class="prencher">
                        <div class="titulo-criar">     
                            <textarea id="titulo" name="titulo" placeholder="Titulo" rows="4" required></textarea>
                        </div>
                        <div class="descricao-criar">
                            <textarea id="descricao" name="descricao"  placeholder="Descrição" rows="4" required></textarea>
                        </div>
                        </div>
                        <input class="btn-criar" type="submit" name="criar_pergunta" value="Criar Pergunta">
                    </div>
                   
                </form>

                <?php foreach ($perguntas as $pergunta): ?>
                    <div class="pergunta">
                        <h2><a href="pergunta.php?id=<?php echo $pergunta['id']; ?>&titulo=<?php echo urlencode($pergunta['titulo']); ?>"
                                class="titulo-pergunta">
                                <?php echo $pergunta['titulo']; ?>
                            </a></h2>
                        <p>
                            <?php echo $pergunta['descricao']; ?>
                        </p>
                        <?php
                        $sql = "SELECT COUNT(*) AS total FROM chat1 WHERE pergunta_id = '" . $pergunta['id'] . "'";
                        $result = $mysqli->query($sql);
                        $row = $result->fetch_assoc();
                        $numero_elementos = $row['total'];

                        if ($numero_elementos > 0) {
                            $ultimaMensagemQuery = "SELECT mensagem, data_envio FROM chat1 WHERE pergunta_id = '" . $pergunta['id'] . "' ORDER BY id DESC LIMIT 1";
                            $ultimaMensagemResult = $mysqli->query($ultimaMensagemQuery);
                            $ultimaMensagemRow = $ultimaMensagemResult->fetch_assoc();
                            $ultimaMensagem = $ultimaMensagemRow['mensagem'];
                            $data_envio = $ultimaMensagemRow['data_envio'];
                            $textoIntervalo = "";
                            if ($data_envio) {
                                $data_envio = strtotime($data_envio);
                                $agora = time();
                                $diff = $agora - $data_envio;
                                if ($diff < 60) {
                                    $textoIntervalo = "Agora";
                                } elseif ($diff < 3600) {
                                    $textoIntervalo = floor($diff / 60) . " min atrás";
                                } elseif ($diff < 86400) {
                                    $textoIntervalo = floor($diff / 3600) . " horas atrás";
                                } else {
                                    $textoIntervalo = date("d/m/Y H:i:s", $data_envio);
                                }
                            }
                        } else {
                            $textoIntervalo = "Nenhuma mensagem";
                        }

                        echo '<div class="elements-csv">';
                        echo '<img src="https://icones.pro/wp-content/uploads/2021/05/message-ballons-symbole-noir.png" alt="Ícone" />';
                        echo '<p class="numero-elementos">' . $numero_elementos . '</p>';
                        echo '<p class="ultima-mensagem">' . $textoIntervalo . '</p>';
                        echo '</div>';
                        if ($_SESSION['email'] === 'admin@gmail.com'): ?>
                            <div class="btn-div-crud">
                                <form method="post" action="">
                                    <input onclick="editarPergunta(<?php echo $pergunta['id']; ?>)" type="button"
                                        name="editar_pergunta" class="btn-crud" value="Editar">
                                </form>
                                <form method="post" action="">
                                    <input onclick="excluirPergunta(<?php echo $pergunta['id']; ?>)" type="button"
                                        name="excluir_pergunta" class="btn-crud2" value="Excluir">
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
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


    <script>
        function editarPergunta(id) {
            window.location.href = "editar_pergunta.php?id=" + id;
        }

    function excluirPergunta(id) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você está prestes a excluir esta pergunta. Essa ação não pode ser revertida!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, exclua!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "excluir_pergunta?id=" + id;
            }
        });
    }
</script>
    </script>
</body>

</html>