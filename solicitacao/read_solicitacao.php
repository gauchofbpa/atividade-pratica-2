<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/styles.css">
    <title>Gerenciamento de Solicitações</title>
</head>
<body>
    <h1>Visualizar as solicitações</h1>
    <table>
        <thead>
            <th>Código da Solicitação</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Data de abertura</th>
            <th>Cliente</th>
            <th>Funcionário responsável</th>
        </thead>
        <tbody>
            <?php
                include '../banco_de_dados/db.php';
                $sql = "SELECT id_cliente, cliente.nome AS 'nome_cliente', id_solicitacao, descricao, urgencia, status_solicitacao, data_abertura, id_cliente_solicitacao, id_funcionario_solicitacao, id_funcionario, funcionario.nome AS 'nome_funcionario'
                FROM CLIENTE
                INNER JOIN solicitacao
                ON id_cliente = id_cliente_solicitacao
                LEFT JOIN funcionario
                ON id_funcionario = id_funcionario_solicitacao;";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                    while ($row = $result -> fetch_assoc()) {
                        echo "<tr>
                        <th scope='row'> {$row['id_solicitacao']} </th>
                        <td>{$row['descricao']}</td>
                        <td>{$row['urgencia']}</td>
                        <td>{$row['status_solicitacao']}</td>
                        <td>{$row['data_abertura']}</td>
                        <td>{$row['nome_cliente']}</td>
                        <td>{$row['nome_funcionario']}</td>
                        <td>
                            <a href='update_solicitacao.php?id_solicitacao={$row['id_solicitacao']}'>Editar</a> |
                            <a href='delete_solicitacao.php?id_solicitacao={$row['id_solicitacao']}'>Excluir</a>
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
    <a href="create_solicitacao.php">Adicionar nova solicitação</a>  
    <br> <br>
    <a href="../cliente/read_cliente.php">Visualizar todas os clientes</a>
    <br> <br>
    <a href="../funcionario/read_funcionario.php">Visualizar todos os funcionários</a>    
</body>
</html>