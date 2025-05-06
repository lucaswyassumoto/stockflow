<?php
require_once 'db_connect.php'; // para importação do banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    // isso ira verificar se o usuario ja é existente
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);

    if ($stmt->fetch()) {
        echo "Erro: Usuário já existe!";
        exit();
    }

    // ao criar a senha, um hash sera utilizado para criptografá-la, aumentando a segurança da conta
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // esse é o comando que será inserido ao término do cadastro do usuario. ao clicar em "Criar", o comando automaticamente subirá para o banco.
    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, nome, senha) VALUES (?, ?, ?)");
    if ($stmt->execute([$usuario, $nome, $senha_hash])) {
        echo "Cadastro realizado com sucesso!";
        header("Location: login.php"); // Redireciona para a tela de login
        exit();
    } else {
        echo "Erro ao cadastrar!";
    }
}
?>
