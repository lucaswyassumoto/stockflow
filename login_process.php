<?php
session_start();
require_once 'db_connect.php'; // conexão com o banco, a qual sera alterada após a finalização do banco e do front

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// para consultar
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->execute([$usuario]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($senha, $user['senha'])) {
    // Login OK
    $_SESSION['usuario_id'] = $user['id'];
    $_SESSION['usuario_nome'] = $user['nome'];
    header("Location: dashboard.php");
    exit();
} else {
    // Login inválido
    echo "Usuário ou senha incorretos.";
}
?>
