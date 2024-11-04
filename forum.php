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

        <link rel="shortcut icon" type="imagex/png" href="assets/img/logourl.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="rigrover-1">
        <nav class="navbar">
            <ul>
                <li>
                    <a href="home" id="btn-nav">Página Inicial</a>
                </li>
                <li>
                    <a href="noticias" id="btn-nav">Notícias</a>
                </li>
                <li>
                    <a href="eventos" id="btn-nav">Eventos</a>
                </li>
                <li>
                    <a href="forum" id="btn-nav">Fórum</a>
                </li>
                <li>
                    <a href="hardware" id="btn-nav">Hardware</a>
                </li>
                <li>
                    <a href="games.php" id="btn-nav">Wiki Jogos</a>
                </li>
                <div class="dropdown">
                    <a href="#" onclick="toggleDropdown(event)"><img class="dropbtn" src="assets/img/imagemuserdrop.png" alt=""></a>
                    <div class="dropdown-content">
                        <a class="btn-dropdown" href="#" onclick="confirmLogout()">Sair</a>
                    </div>
                </div>

            </ul>
        </nav>

        <!-- --------Hamburguinho Menu----------  -->
        <div class="topnav">
            <div class="active">
                <a href="#myLinks"></a>
            </div>

            <div id="myLinks">
                <a href="home">Página Inicial</a>
                <a href="noticias">Notícias</a>
                <a href="eventos">Eventos</a>
                <a href="forum">Fórum</a>
                <a href="comparar_hardwares">Hardware</a>
                <a href="games.php">Wiki Jogos</a>
                <a href="logout">Deslogar da Conta</a>
            </div>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <!-- ----------------------------------------- -->

        <div class="main-content">
            <h3>Fórum Rig Rover</h3>
            <div class="noticias">

                <form method="post" action="">

                    <div class="criar-pergunta">
                    <h3>Criar Nova Pergunta</h3>
                        <div class="titulo-criar">     
                            <textarea id="titulo" name="titulo" placeholder="Digite o título do fórum" rows="4" required></textarea>
                        </div>
                        <div class="descricao-criar">
                            <textarea id="descricao" name="descricao"  placeholder="Escreva a descrição dele" rows="4" required></textarea>
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
        <footer>
            <div class="cont-1">
                <img src="assets\img\mascoterigrover.png" alt="Mascote Rigrover" class="img-footer-logo">
                <ul>
                    <li><a href="index">Página Inicial</a></li>
                    <li><a href="#quem-somos">Quem Somos?</a></li>
                    <li><a href="#equipe-desenvolvedora">Equipe Desenvolvedora</a></li>
                </ul>
            </div>
            <div class="cont-2">
                <div>
                <div class="redes-footer">
                            <a id="instarigrover"><img src="assets/img/iconinstagram.png" alt=""></a>
                            <a id="twiterrigrover"><img src="assets/img/iconx.png" alt=""></a>
                            <a id="facerigrover"><img src="assets/img/iconfacebook.png" alt=""></a>
                            <a id="youtuberigrover"><img src="assets/img/iconyoutube.png" alt=""></a>
                        </div>
                        <script>
                            document.getElementById('instarigrover').addEventListener('click', function() {
                            window.open('https://www.instagram.com/rigrovergames/', '_blank');
                            });

                            document.getElementById('twiterrigrover').addEventListener('click', function() {
                            window.open('https://twitter.com/RigRoverGames', '_blank');
                            });

                            document.getElementById('facerigrover').addEventListener('click', function() {
                            window.open('https://www.facebook.com/profile.php?id=61556959637519', '_blank');
                            });

                            document.getElementById('youtuberigrover').addEventListener('click', function() {
                            window.open('https://www.youtube.com/channel/UCi9tZH0GeYkvskNO2d8mzIg', '_blank');
                            });
                            </script>
                    <ul>
                        <li>
                            <a href="fale_conosco">Fale Conosco</a>
                        </li>
                        <li>
                            <a href="politicas_de_privacidade">Políticas de Privacidade</a>
                        </li>
                        <li>
                            <a href="termo_e_condicoes">Termos e Condições</a>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
    </footer>

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