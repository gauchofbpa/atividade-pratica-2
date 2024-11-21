<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/styles.css">
    <title>Gerenciamento de Solicitações</title>
</head>
<body>
    <h1>Cadastrar um cliente</h1>
    <form method="POST" action="create_cliente.php">
        <label for="name">Nome:</label>
        <input type="text" name="name" required>
        <br> <br>
        <label for="cpf">CPF:</label>
        <input type="number" name="cpf" required>
        <br> <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br> <br>
        <label for="telefone">Telefone:</label>
        <input type="number" name="telefone" required>
        <br>
        <br>
        <input type="submit" value="Adicionar">
    </form>
    <a href="read_cliente.php">Visualizar todos os clientes cadastrados</a>
    <br> <br>
</body>
</html>
<?php
    include '../banco_de_dados/db.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $sql = "INSERT INTO cliente (nome, cpf, email, telefone) VALUE ('$name', '$cpf', '$email', '$telefone')";
        if($conn -> query($sql) === TRUE) {
            echo "Novo registro adicionado com sucesso";
        } else {
            echo "Erro: " . $sql . "<br>". $conn -> error;
        }
    }
    $conn -> close();
?>