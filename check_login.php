<?php
session_start();

// Recebe os dados do formulário
$username = $_POST['username'];
$password = $_POST['password'];

// Conexão com o servidor MariaDB
$mysqli = new mysqli("localhost", $username, $password);

if ($mysqli->connect_error) {
    die("Erro na conexão com o servidor MariaDB: " . $mysqli->connect_error);
}

// Cria o banco de dados "swform" se ele não existir
$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS swform";
if ($mysqli->query($createDatabaseQuery) === TRUE) {
    echo "Banco de dados 'swform' criado com sucesso ou já existente.<br>";
} else {
    die("Erro ao criar o banco de dados 'swform': " . $mysqli->error);
}

// Seleciona o banco de dados "swform"
$mysqli->select_db("swform");

// Cria a tabela "form" com as colunas corretas
$createTableQuery = "CREATE TABLE IF NOT EXISTS form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data DATE,
    hora VARCHAR(4),
    frequencia INT
)";
if ($mysqli->query($createTableQuery) === TRUE) {
    echo "Tabela 'form' criada com sucesso ou já existente.<br>";
} else {
    die("Erro ao criar a tabela 'form': " . $mysqli->error);
}

// Verifica se a conexão com o banco de dados foi bem-sucedida
if ($mysqli->ping()) {
    // Login bem-sucedido
    $_SESSION['username'] = $username;
    header('Location: welcome.php');
} else {
    // Login falhou
    echo "Credenciais inválidas. Tente novamente.";
}

$mysqli->close();
?>