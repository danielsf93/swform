<?php
//swform/receptores.php
session_start();
// Recupera o usuário da variável de sessão
$username = $_SESSION['username'];
$password = $_SESSION['password'];

// Verifique se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$mysqli = new mysqli("localhost", $username, $password, "swform");
if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receptores = $_POST['receptores'];

    // Prepare a consulta para inserir os dados na tabela 'receptores'
    $insertQuery = $mysqli->prepare("INSERT INTO receptores (receptores) VALUES (?)");

    if ($insertQuery === FALSE) {
        die("Erro ao preparar a consulta: " . $mysqli->error);
    }

    // Associe os parâmetros e execute a consulta
    $insertQuery->bind_param("s", $receptores);

    if ($insertQuery->execute() === TRUE) {
        print "<script>alert('Receptor cadastrado com sucesso.');</script>";
    } else {
        echo "Erro ao inserir dados na tabela 'receptores': " . $mysqli->error;
    }

    // Feche a consulta
    $insertQuery->close();
}

// Consulta para selecionar todos os registros da tabela 'receptores'
$selectQuery = "SELECT * FROM receptores";

$result = $mysqli->query($selectQuery);

if ($result === FALSE) {
    die("Erro ao executar a consulta: " . $mysqli->error);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Receptores</title>
</head>
<body>
    <h1>Receptores</h1>
    <form action="?page=receptores" method="post">
        <div class="mb-3">
            <label>Receptor</label>
            <textarea name="receptores" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
    <?php
    if ($result->num_rows > 0) {
        echo "<h2>Lista de Receptores Cadastrados</h2>";
        echo "<table class='table table-hover table-striped table-bordered'>";
        echo "<tr>";
        echo "<th>#</th>";
        echo "<th>Receptor</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['receptores'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p class='alert alert-danger'>Não foram encontrados receptores cadastrados.</p>";
    }
    $mysqli->close();
    ?>
</body>
</html>
