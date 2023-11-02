<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="check_login.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
