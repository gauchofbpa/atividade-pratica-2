<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/styles.css">
    <title>Gerenciamento de Solicitações</title>
</head>
<body>
    <h1>Visualizar os clientes</h1>
    <table>
        <thead>
            <th>Código do Cliente</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Telefone</th>
        </thead>
        <tbody>
            <?php
                include '../banco_de_dados/db.php';
                $sql = "SELECT * FROM cliente";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                    while ($row = $result -> fetch_assoc()) {
                        echo "<tr>
                        <th scope='row'> {$row['id_cliente']} </th>
                        <td>{$row['nome']}</td>
                        <td>{$row['cpf']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['telefone']}</td>
                        <td>
                            <a href='update_cliente.php?id_cliente={$row['id_cliente']}'>Editar</a> |
                            <a href='delete_cliente.php?id_cliente={$row['id_cliente']}'>Excluir</a>
                        </td>
                        </tr>";
                        }
                    } else {
                        echo "Nenhum registro encontrado";
                    }
                    $conn -> close();
            ?>
        </tbody>    
    </table>  
    <br>
    <a href="create_cliente.php">Registrar novo cliente</a>  
    <br> <br>
    <a href="../solicitacao/read_solicitacao.php">Visualizar todas as solicitações</a>
    <br> <br>
    <a href="../funcionario/read_funcionario.php">Visualizar todos os funcionários</a>    
</body>
</html>