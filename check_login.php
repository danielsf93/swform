<?php
//swform/check_login.php
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
$createTableFormQuery = "CREATE TABLE IF NOT EXISTS form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    horario VARCHAR(4),
    data DATE,
    local TEXT,
    frequencia INT,
    emissora TEXT,
    idioma TEXT,
    pais TEXT,
    equipamento TEXT,
    antena TEXT,
    observacao TEXT,
    distancia TEXT,
    alvo TEXT
)";
if ($mysqli->query($createTableFormQuery) === TRUE) {
    echo "Tabela 'form' criada com sucesso ou já existente.<br>";
} else {
    die("Erro ao criar a tabela 'form': " . $mysqli->error);
}

// Cria a tabela "local" com a coluna "endereco"
$createTableLocalQuery = "CREATE TABLE IF NOT EXISTS local (
    id INT AUTO_INCREMENT PRIMARY KEY,
    endereco TEXT
)";
if ($mysqli->query($createTableLocalQuery) === TRUE) {
    echo "Tabela 'local' criada com sucesso ou já existente.<br>";
} else {
    die("Erro ao criar a tabela 'local': " . $mysqli->error);
}

// Cria a tabela "radio" com a coluna "radio"
$createTableRadioQuery = "CREATE TABLE IF NOT EXISTS radio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    radio TEXT
)";
if ($mysqli->query($createTableRadioQuery) === TRUE) {
    echo "Tabela 'radio' criada com sucesso ou já existente.<br>";
} else {
    die("Erro ao criar a tabela 'radio': " . $mysqli->error);
}

// Cria a tabela "antena" com a coluna "antena"
$createTableAntenaQuery = "CREATE TABLE IF NOT EXISTS antena (
    id INT AUTO_INCREMENT PRIMARY KEY,
    antena TEXT
)";
if ($mysqli->query($createTableAntenaQuery) === TRUE) {
    echo "Tabela 'antena' criada com sucesso ou já existente.<br>";
} else {
    die("Erro ao criar a tabela 'antena': " . $mysqli->error);
}

// Verifica se a conexão com o banco de dados foi bem-sucedida
if ($mysqli->ping()) {
    // Login bem-sucedido
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;  // Defina a senha na variável de sessão
    header('Location: welcome.php');
} else {
    // Login falhou
    echo "Credenciais inválidas. Tente novamente.";
}

$mysqli->close();
?>
