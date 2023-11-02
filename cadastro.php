<?php
//swform/cadastro.php
session_start();
// Recupera o usuário da variável de sessão
$username = $_SESSION['username'];
$password = $_SESSION['password'];

// Verifique se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $horario = $_POST['horario'];
    $data = $_POST['data'];
    $local = $_POST['local'];
    $frequencia = $_POST['frequencia'];
    $emissora = $_POST['emissora'];
    $idioma = $_POST['idioma'];
    $pais = $_POST['pais'];
    $equipamento = $_POST['equipamento'];
    $antena = $_POST['antena'];
    $observacao = $_POST['observacao'];
    $distancia = $_POST['distancia'];
    $alvo = $_POST['alvo'];

    // Conecte-se ao banco de dados usando as variáveis de sessão
    $mysqli = new mysqli("localhost", $username, $password, "swform");

    if ($mysqli->connect_error) {
        die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
    }

    // Prepare a consulta para inserir os dados na tabela 'form'
    $insertQuery = $mysqli->prepare("INSERT INTO form (horario, data, local, frequencia, emissora, idioma, pais, equipamento, antena, observacao, distancia, alvo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($insertQuery === FALSE) {
        die("Erro ao preparar a consulta: " . $mysqli->error);
    }

    // Associe os parâmetros e execute a consulta
    $insertQuery->bind_param("ssssssssssss", $horario, $data, $local, $frequencia, $emissora, $idioma, $pais, $equipamento, $antena, $observacao, $distancia, $alvo);

    if ($insertQuery->execute() === TRUE) {
        echo "Dados inseridos com sucesso.";
    } else {
        echo "Erro ao inserir dados na tabela 'form': " . $mysqli->error;
    }

    // Feche a consulta e a conexão com o banco de dados
    $insertQuery->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro</h1>
    <form action="?page=cadastro" method="post">
        <div class="mb-3">
            <label>Horário (exemplo: 0000)</label>
            <input type="text" name="horario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Data</label>
            <input type="date" name="data" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Local</label>
            <textarea name="local" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Frequência</label>
            <input type="number" name="frequencia" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Emissora</label>
            <textarea name="emissora" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Idioma</label>
            <textarea name="idioma" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>País</label>
            <textarea name="pais" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Equipamento</label>
            <textarea name="equipamento" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Antena</label>
            <textarea name="antena" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Observação</label>
            <textarea name="observacao" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Distância</label>
            <textarea name="distancia" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Alvo</label>
            <textarea name="alvo" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</body>
</html>
