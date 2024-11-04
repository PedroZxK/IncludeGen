<?php
include 'conexao.php';
include 'validacao.php';

$id = $_SESSION['user_id'] ?? null;

if ($id) {
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $foto_perfil = $row['foto_perfil'];
            $date_of_birth = $row['date_of_birth'];
            $cpf = $row['cpf'];
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

// Processamento do upload da nova foto de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['nova_foto_perfil'])) {
    $novaFoto = $_FILES['nova_foto_perfil'];
    
    // Verifica se o upload foi realizado sem erros
    if ($novaFoto['error'] === UPLOAD_ERR_OK) {
        $nomeArquivo = $novaFoto['name'];
        $caminhoTemp = $novaFoto['tmp_name'];
        $diretorioDestino = 'imagens_perfil/';

        // Verifica se o diretório existe; se não, cria o diretório com permissão de escrita
        if (!is_dir($diretorioDestino)) {
            mkdir($diretorioDestino, 0777, true);
        }

        // Gera um novo nome de arquivo único
        $novoNomeArquivo = uniqid() . '_' . $nomeArquivo;
        $caminhoFinal = $diretorioDestino . $novoNomeArquivo;

        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($caminhoTemp, $caminhoFinal)) {
            // Atualiza o caminho da nova foto de perfil no banco de dados
            $stmt = $mysqli->prepare("UPDATE users SET foto_perfil = ? WHERE id = ?");
            $stmt->bind_param("si", $caminhoFinal, $id);
            $stmt->execute();
            $stmt->close();

            // Atualiza a variável $foto_perfil para exibir a nova imagem
            $foto_perfil = $caminhoFinal;
        } else {
            echo "Erro ao mover o arquivo de upload.";
        }
    } else {
        echo "Erro no upload da imagem.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Bem-vindo à IncludeGen, uma plataforma dedicada ao bem-estar e à inclusão da pessoa idosa. Encontre cuidadores de idosos, explore alternativas de entretenimento, descubra oportunidades de trabalho para a terceira idade e entenda o sistema previdenciário brasileiro.">

    <title>Perfil - IncludeGen</title>
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/responsivel-profile.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="profile-box-1">
        <div class="picture-profile">
            <img src="<?= htmlspecialchars($foto_perfil); ?>" alt="Avatar">
            <!-- Formulário para alterar a foto de perfil -->
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="nova_foto_perfil" accept="image/*" required>
                <button type="submit">Alterar foto de perfil</button>
            </form>
            <p><?= htmlspecialchars($username); ?></p>
            <a href="./logout.php">Sair</a>
        </div>
    </div>
    <div class="profile-box-2">
        <h2>Informações gerais</h2>
        <div class="container-info">
            <p>Email</p>
            <p class="info-text"><?= htmlspecialchars($email); ?></p>
        </div>
        <div class="container-info">
            <p>Telefone</p>
            <p class="info-text"><?= htmlspecialchars($phone); ?></p>
        </div>
        <div class="container-info">
            <p>Data de nascimento</p>
            <p class="info-text"><?= htmlspecialchars($date_of_birth); ?></p>
        </div>
        <div class="container-info">
            <p>Cpf</p>
            <p class="info-text"><?= htmlspecialchars($cpf); ?></p>
        </div>
    </div>

</body>
</html>