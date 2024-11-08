<?php
session_start();
require_once 'vendor/autoload.php'; // Google API Client

use Google\Client;

$input = json_decode(file_get_contents('php://input'), true);
$token = $input['token'];

if (!$token) {
    echo json_encode(['success' => false, 'message' => 'Token não enviado']);
    exit();
}

// Configurar o cliente Google
$client = new Client();
$client->setClientId("299295953821-nqbqqb8va16klodnvebgdja6h40mogc5.apps.googleusercontent.com");

try {
    // Verificar e decodificar o token
    $payload = $client->verifyIdToken($token);
    if ($payload) {
        // O token é válido, obter o email do usuário
        $email = $payload['email'];

        // Conectar ao banco de dados
        include 'conexao.php';

        // Verificar se o usuário existe no banco de dados
        $sql = "SELECT id, email FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($id, $dbEmail);
        if ($stmt->fetch()) {
            // Usuário encontrado, iniciar sessão
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $dbEmail;
            echo json_encode(['success' => true]);
        } else {
            // Usuário não encontrado, opcionalmente crie uma conta ou envie um erro
            echo json_encode(['success' => false, 'message' => 'Usuário não encontrado']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Token inválido']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao validar token: ' . $e->getMessage()]);
}

$mysqli->close();