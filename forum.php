<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login");
    exit;
}

include 'conexao.php';

$mysqli = new mysqli($hostname, $username, $password, $database);

// Lista de palavras proibidas
$palavras_proibidas = [
    'estruprador', 'estuprado', 'estuprador', 'estuprar', 'estupro',
    'l.o.l.i', 'l0l1', 'l0l1z1nh4', 'l0li', 'lloli', 'lol1', 'loli', 'lolicon', 'lolismo', 'lolli',
    'n-word', 'n1gg3r', 'n1gg4', 'n1gga', 'nazism', 'nazismo', 'nazista',
    'nigg4', 'nigga', 'nigger',
    'p3d0f1l0', 'ped0f1l14', 'ped0fil0', 'pedofilia', 'pedofilo',
    'porno', 'pornô',
    'smt', 'Se Mata', 'se mata', 'semata', '$emata', '$mt', '$e mata', '$e Mata', 'Viado', 'Viadinho', 'viadinho', 'viado', 'Bicha', 'Boiola', 'gayzinho', 'Gayzinho',
    'tr4aveco', 'tr4v3c0', 'tr4vec0', 'trav3c0', 'travecão', 'traveco', 'travecozinho',
    'xvideos', 'zoofilia'
];

// Função para verificar se o título ou descrição é inapropriado
function conteudo_inapropriado($texto, $palavras_proibidas) {
    foreach ($palavras_proibidas as $palavra) {
        if (stripos($texto, $palavra) !== false) {
            return true;
        }
    }
    return false;
}

// Lida com os formulários de criação, edição e exclusão de perguntas
// Lida com os formulários de criação, edição e exclusão de perguntas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['criar_pergunta'])) {
        $titulo = htmlspecialchars($_POST['titulo']);
        $descricao = htmlspecialchars($_POST['descricao']);


        // Verifica se o título ou descrição contém conteúdo inapropriado
        if (conteudo_inapropriado($titulo, $palavras_proibidas) || conteudo_inapropriado($descricao, $palavras_proibidas)) {
            // Bloqueia a criação e não exibe mensagem de alerta
            header("Location: forum.php");
            exit();
        }

        // Se não for inapropriado, cria a pergunta
        $sql = "INSERT INTO perguntas (titulo, descricao) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $titulo, $descricao);
        $stmt->execute();
        $stmt->close();

        header("Location: forum.php");
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

// Busca todas as perguntas
$sql = "SELECT * FROM perguntas";
$resultado = $mysqli->query($sql);
$perguntas = array();

while ($pergunta = $resultado->fetch_assoc()) {
    $perguntas[] = $pergunta;
}

// Busca o nome do usuário logado
$id = $_SESSION['user_id'] ?? null;

if ($id) {
    $stmt = $mysqli->prepare("SELECT name, foto_perfil FROM users WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['name'];
            $foto_perfil = $row['foto_perfil'];
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
    <title>Fórum - IncludeGen</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/forum.css">
    <link rel="stylesheet" href="assets\css\forumResponsivo.css">
    <script src="assets/js/hamburguer.js"></script>
    <script src="assets/js/dropdownuser.js"></script>
    <script src="assets/js/logout.js"></script>

    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">

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
                        <li><a href="entretenimento.php">Entretenimento</a></li>
                        <li><a href="previdencia.php">Previdência</a></li>
                    </ul>
                </div>
                <div class="right-nav-div">
                    <img src="<?= htmlspecialchars($foto_perfil ?: 'assets/img/avatar_temp.webp'); ?>" alt="Avatar">
                    <div class="profile">
                        <p class="profile-name"><?= htmlspecialchars($username); ?></p>
                        <a class="view-profile-link" href="./perfil.php">ver perfil</a>
                    </div>
                </div>
                <div><a href="#" onclick="confirmLogout(event)" class="img-sair"><img src="assets/img/sair.png" alt=""></a></div>

                <script>
            function confirmLogout(event) {
            event.preventDefault(); // Evita o redirecionamento imediato
                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Deseja realmente sair?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, sair',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                     window.location.href = 'logout.php'; // Redireciona para a página de logout
                    }
                });
            }
        </script>
            </div>

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

    <div id="forum-content">
        <div class="search-category-section">
            <h2>Fórum</h2>
            <p class="texto-pesquisa">Converse com pessoas e tire suas duvidas com elas </p>
            <div class="search-bar">
                <input type="text" name="search" placeholder="Pesquise algum fórum" class="noticia-icon"
                    oninput="pesquisarNoticia()">
            </div>
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
                                <textarea id="descricao" name="descricao" placeholder="Descrição" rows="4"
                                    required></textarea>
                            </div>
                        </div>
                        <input class="btn-criar" type="submit" name="criar_pergunta" value="Publicar">
                    </div>
                </form>

                <!-- Exibição das perguntas -->
                <?php foreach ($perguntas as $pergunta): ?>
                    <div class="ntc-pergunta">
                        <h2><a href="pergunta.php?id=<?php echo $pergunta['id']; ?>" class="titulo-pergunta">
                                <?php echo $pergunta['titulo']; ?>
                            </a></h2>
                        <p><?php echo $pergunta['descricao']; ?></p>
                    </div>
                <?php endforeach; ?>
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

    <script>
        function pesquisarNoticia() {
            var input = document.querySelector('.noticia-icon');
            var filtro = input.value.toUpperCase();
            var noticias = document.querySelectorAll('.ntc-pergunta');

            noticias.forEach(function (noticia) {
                var titulo = noticia.querySelector('.titulo-pergunta');
                if (titulo.innerText.toUpperCase().indexOf(filtro) > -1) {
                    noticia.style.display = 'block';
                } else {
                    noticia.style.display = 'none';
                }
            });
        }
    </script>

    <?php
    $mysqli->close();
    ?>
</body>

</html>