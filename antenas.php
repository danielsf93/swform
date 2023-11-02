<?php
//swform/antenas.php
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
    $antena = $_POST['antena'];

    // Prepare a consulta para inserir os dados na tabela 'antena'
    $insertQuery = $mysqli->prepare("INSERT INTO antena (antena) VALUES (?)");

    if ($insertQuery === FALSE) {
        die("Erro ao preparar a consulta: " . $mysqli->error);
    }

    // Associe os parâmetros e execute a consulta
    $insertQuery->bind_param("s", $antena);

    if ($insertQuery->execute() === TRUE) {
        print "<script>alert('Antena cadastrada com sucesso.');</script>";
        print "<script>location.href='?page=antenas';</script>";
    } else {
        echo "Erro ao inserir dados na tabela 'antena': " . $mysqli->error;
    }

    // Feche a consulta
    $insertQuery->close();
}

// Consulta para selecionar todas as antenas na tabela 'antena'
$selectQuery = "SELECT * FROM antena";

$result = $mysqli->query($selectQuery);

if ($result === FALSE) {
    die("Erro ao executar a consulta: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Antenas</title>
</head>
<body>
    <h1>Antenas</h1>
    <form action="?page=antenas" method="post">
        <div class="mb-3">
            <label>Antena</label>
            <textarea name="antena" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>

    <?php
    if ($result->num_rows > 0) {
        echo "<h2>Antenas Cadastradas</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['antena'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p class='alert alert-danger'>Não foram encontradas antenas cadastradas.</p>";
    }
    ?>

</body>
</html>
