<?php
include 'connection.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");


$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$novaSenha = $data['senha'];

// Verifica se o ID é válido
if ($id <= 0) {
    echo json_encode(["success" => false, "message" => "ID inválido!"]);
    exit;
}

// Prepara a query para atualizar a senha
$stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");

$hashedNovaSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

$stmt->bind_param("si", $hashedNovaSenha, $id);


// Executa a query
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Senha redefinida com sucesso!"]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao redefinir senha: " . $conn->error]);
}

// Fecha a conexão com o banco de dados
$stmt->close();
$conn->close();
