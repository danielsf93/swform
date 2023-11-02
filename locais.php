<?php
//swform/locais.php
session_start();
// Recupera o usuário da variável de sessão
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

// Verifique se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $endereco = $_POST['endereco'];

    // Prepare a consulta para inserir os dados na tabela 'local'
    $insertQuery = $mysqli->prepare("INSERT INTO local (endereco) VALUES (?)");

    if ($insertQuery === FALSE) {
        die("Erro ao preparar a consulta: " . $mysqli->error);
    }

    // Associe os parâmetros e execute a consulta
    $insertQuery->bind_param("s", $endereco);

    if ($insertQuery->execute() === TRUE) {
        print "<script>alert('Local cadastrado com sucesso.');</script>";
        print "<script>location.href='?page=locais';</script>";
    } else {
        echo "Erro ao inserir dados na tabela 'local': " . $mysqli->error;
    }

    // Feche a consulta
    $insertQuery->close();
}

// Consulta para selecionar todos os locais na tabela 'local'
$selectQuery = "SELECT * FROM local";

$result = $mysqli->query($selectQuery);

if ($result === FALSE) {
    die("Erro ao executar a consulta: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Locais</title>
</head>
<body>
    <h1>Locais</h1>
    <form action="?page=locais" method="post">
        <div class="mb-3">
            <label>Endereço</label>
            <textarea name="endereco" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>

    <?php
    if ($result->num_rows > 0) {
        echo "<h2>Locais Cadastrados</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['endereco'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p class='alert alert-danger'>Não foram encontrados locais cadastrados.</p>";
    }
    ?>

</body>
</html>
