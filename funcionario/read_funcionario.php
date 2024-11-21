<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/styles.css">
    <title>Gerenciamento de Solicitações</title>
</head>
<body>
    <h1>Visualizar os funcionários</h1>
    <table>
        <thead>
            <th>Código do Funcionário</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Telefone</th>
        </thead>
        <tbody>
            <?php
                include '../banco_de_dados/db.php';
                $sql = "SELECT * FROM funcionario";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                    while ($row = $result -> fetch_assoc()) {
                        echo "<tr>
                        <th scope='row'> {$row['id_funcionario']} </th>
                        <td>{$row['nome']}</td>
                        <td>{$row['cpf']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['telefone']}</td>
                        <td>
                            <a href='update_funcionario.php?id_funcionario={$row['id_funcionario']}'>Editar</a> |
                            <a href='delete_funcionario.php?id_funcionario={$row['id_funcionario']}'>Excluir</a>
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
    <a href="create_funcionario.php">Registrar novo funcionario</a>  
    <br> <br>
    <a href="../solicitacao/read_solicitacao.php">Visualizar todas as solicitações</a>
    <br> <br>
    <a href="../funcionario/read_funcionario.php">Visualizar todos os funcionarios</a>    
</body>
</html>