<?php
//swform/listar.php
session_start();
// Recupera o usuário e senha da variável de sessão
$username = $_SESSION['username'];
$password = $_SESSION['password'];

// Verifique se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Conecte-se ao banco de dados usando as variáveis de sessão
$mysqli = new mysqli("localhost", $username, $password, "swform");

if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

// Consulta para selecionar todos os registros da tabela 'form'
$selectQuery = "SELECT * FROM form";

$result = $mysqli->query($selectQuery);

if ($result === FALSE) {
    die("Erro ao executar a consulta: " . $mysqli->error);
}

if ($result->num_rows > 0) {
    echo "<h1>Listar Registros</h1>";
    echo "<table class='table table-hover table-striped table-bordered'>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Horário</th>";
    echo "<th>Data</th>";
    echo "<th>Local</th>";
    echo "<th>Frequência</th>";
    echo "<th>Emissora</th>";
    echo "<th>Idioma</th>";
    echo "<th>País</th>";
    echo "<th>Equipamento</th>";
    echo "<th>Antena</th>";
    echo "<th>Observação</th>";
    echo "<th>Distância</th>";
    echo "<th>Alvo</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['horario'] . "</td>";
        echo "<td>" . $row['data'] . "</td>";
        echo "<td>" . $row['local'] . "</td>";
        echo "<td>" . $row['frequencia'] . "</td>";
        echo "<td>" . $row['emissora'] . "</td>";
        echo "<td>" . $row['idioma'] . "</td>";
        echo "<td>" . $row['pais'] . "</td>";
        echo "<td>" . $row['equipamento'] . "</td>";
        echo "<td>" . $row['antena'] . "</td>";
        echo "<td>" . $row['observacao'] . "</td>";
        echo "<td>" . $row['distancia'] . "</td>";
        echo "<td>" . $row['alvo'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p class='alert alert-danger'>Não foram encontrados registros.</p>";
}

$mysqli->close();
?>
