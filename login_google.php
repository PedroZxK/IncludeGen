<?php
session_start();
include 'conexao.php';

require 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('299295953821-nqbqqb8va16klodnvebgdja6h40mogc5.apps.googleusercontent.com');

$data = json_decode(file_get_contents('php://input'), true);
$credential = $data['credential'] ?? null;

if ($credential) {
    $payload = $client->verifyIdToken($credential);
    if ($payload) {
        $email = $payload['email'];

        // Verifique se o usuário já existe
        $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Usuário existe, faça login
            $stmt->bind_result($id);
            $stmt->fetch();
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;

            echo json_encode(['success' => true]);
        } else {
            // Usuário não existe, crie uma nova conta e faça login
            $stmt->close();
            $stmt = $mysqli->prepare("INSERT INTO users (email) VALUES (?)");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $user_id = $stmt->insert_id;

            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;

            echo json_encode(['success' => true]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Token inválido']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nenhum token recebido']);
}

$mysqli->close();
?>
