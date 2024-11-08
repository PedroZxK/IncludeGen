<?php
include 'conexao.php';
include 'validacao.php';

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
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\css\perfilee.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Contato</title>
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
                <img src="<?= htmlspecialchars($foto_perfil); ?>" alt="Avatar">
                <div class="profile">
                    <p class="profile-name"><?= htmlspecialchars($username); ?></p>
                    <a class="view-profile-link" href="./perfil.php">ver perfil</a>
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
        </nav>
    </div>


    <section class="hero">
        <img src="assets/img/sorrindo-idosos.png" alt="Idosos sorrindo">
    </section>

    <main class="profile-container">
        <div class="profile-card">
            <img src="assets/img/family.png" alt="Foto de Ana Laura" class="profile-photo">
            <h2>Family Care Senior</h2>
            <p>(12) 99139-9075</p>
            <p>contato@familycaresenior.com.br</p>
            <p>Av Nove de Julho, 765 - Sala 31 - Jardim Apolo I São José dos Campos/SP</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-x-twitter"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        <div class="bio-card">
            <h2>Sobre</h2>
            <p>
                "Na Family Care Senior, entendemos que cuidar de um ente querido é uma responsabilidade repleta de amor, dedicação e, muitas vezes, desafios.

                É por isso que estamos aqui para oferecer um suporte acolhedor e profissional, garantindo que cada idoso receba o cuidado e a atenção que merece.

                Atendendo com carinho e excelência na região do Vale do Paraíba, nos dedicamos a transformar o cuidado aos idosos em uma experiência positiva e reconfortante."</p>
        </div>
    </main>

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

</body>

</html>