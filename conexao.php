<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$database = "seu_banco_de_dados";

// para a conexao com o banco de dados. como estamos utilizando o mysql, decidimos usar o mysqli como teste de conexao
$conn = mysqli_connect($servername, $username, $password, $database);

// para verificar se a conexao esta funcionando
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>
