<?php
    include '../banco_de_dados/db.php';
    $id_solicitacao = $_GET['id_solicitacao'];
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $descricao = $_POST['descricao'];
        if ($_POST['urgencia'] == "alta") {
            $urgencia = 'Alta';   
        } else {
            if ($_POST['urgencia'] == "media") {
                $urgencia = 'Média';            
            } else {
                if ($_POST['urgencia'] == "baixa") {
                $urgencia = 'Baixa';
                }
            }
        }  
        if ($_POST['status_solicitacao'] == "pendente") {
            $status_solicitacao = 'Pendente';   
        } else {
            if ($_POST['status_solicitacao'] == "em_andamento") {
                $status_solicitacao = 'Em andamento';            
            } else {
                if ($_POST['status_solicitacao'] == "finalizada") {
                $status_solicitacao = 'Finalizada';
                }
            }
        } 
        $cliente = $_POST['cliente'];
        $funcionario = $_POST['funcionario'];
        $sql = "UPDATE solicitacao SET descricao = '$descricao', urgencia = '$urgencia', status_solicitacao = '$status_solicitacao', id_cliente_solicitacao = '$cliente', id_funcionario_solicitacao = '$funcionario' WHERE id_solicitacao = '$id_solicitacao'"; 
        if($conn -> query($sql) === TRUE) {
            echo "Registro atualizado com sucesso";
        } else {
            echo "Erro: " . $sql . "<br>". $conn -> error;
        }
        $conn -> close();
        header ("Location: read_solicitacao.php");
        exit();
    }
    $sql = "SELECT id_cliente, cliente.nome AS 'nome_cliente', id_solicitacao, descricao, urgencia, status_solicitacao, data_abertura, id_cliente_solicitacao, id_funcionario_solicitacao, id_funcionario, funcionario.nome AS 'nome_funcionario'
    FROM CLIENTE
    INNER JOIN solicitacao
    ON id_cliente = id_cliente_solicitacao
    LEFT JOIN funcionario
    ON id_funcionario = id_funcionario_solicitacao;";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    
    $sql_status = "SELECT status_solicitacao FROM solicitacao WHERE id_solicitacao = '$id_solicitacao'";
    $result_status = $conn -> query($sql_status);
    $row_status = $result_status -> fetch_assoc();
    $status_solicitacao = $row['status_solicitacao'];

    $sql_urgencia = "SELECT urgencia FROM solicitacao WHERE id_solicitacao = '$id_solicitacao'";
    $result_urgencia = $conn -> query($sql_urgencia);
    $row_urgencia = $result_urgencia -> fetch_assoc();
    $urgencia = $row['urgencia'];

    $sql_cliente = "SELECT * FROM cliente";
    $result_cliente = $conn -> query($sql_cliente);
    
    $sql_funcionario = "SELECT * FROM funcionario";
    $result_funcionario = $conn -> query($sql_funcionario);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/styles.css">
    <title>Gerenciamento de Solicitações</title>
</head>
<body>
    <h1>Atualizar informações da solicitação</h1>
    <form method="POST" action="update_solicitacao.php?id=<?php echo $row['id_solicitacao'];?>">
        <label for="descricao">Descrição:</label> <br>
        <textarea name="descricao" required> <?php echo $row['descricao'];?> </textarea> 
        <br> <br>
        <label for="urgencia">urgencia:</label> <br>
        <input type="radio" name="urgencia" value="alta" required <?php if($urgencia == 'Alta') echo 'checked' ?>>Alta <br>
        <input type="radio" name="urgencia" value="media" <?php if($urgencia == 'Média') echo 'checked' ?>>Média <br>
        <input type="radio" name="urgencia" value="baixa" <?php if($urgencia == 'Baixa') echo 'checked' ?>>Baixa <br> 
        <br>
        <label for="status_solicitacao">Status do solicitacao:</label> <br>
        <input type="radio" name="status_solicitacao" value="pendente" required <?php if($status_solicitacao == 'Pendente') echo 'checked' ?>>Pendente <br>
        <input type="radio" name="status_solicitacao" value="em_andamento" <?php if($status_solicitacao == 'Em andamento') echo 'checked' ?>>Em andamento <br>
        <input type="radio" name="status_solicitacao" value="finalizada" <?php if($status_solicitacao == 'Finalizada') echo 'checked' ?>>Finalizada <br>
        <br>
        <label for="cliente">Cliente:</label>
        <select name="cliente" required>
        <option disabled value="<?php echo $row['id_cliente'];?>"><?php echo $row['nome'];?></option>
        <option disabled>Acima o cliente atual</option>
        <?php 
        if ($result_cliente -> num_rows > 0) { 
            while($row_cliente = $result_cliente -> fetch_assoc()) {
        ?> <option value="<?php echo $row_cliente['id_cliente'];?>"><?php echo $row_cliente['nome']; ?></option>
        <?php } }?>
        </select>
        <br> <br>
        <br>
        <label for="funcionario">Funcionário:</label>
        <select name="funcionario" required>
        <option disabled value="<?php echo $row['id_funcionario'];?>"><?php echo $row['nome'];?></option>
        <option disabled>Acima o cliente atual</option>
        <?php 
        if ($result_funcionario -> num_rows > 0) { 
            while($row_funcionario = $result_funcionario -> fetch_assoc()) {
        ?> <option value="<?php echo $row_funcionario['id_funcionario'];?>"><?php echo $row_funcionario['nome']; ?></option>
        <?php } }?>
        </select>
        <br>
        <br> <br>
        <input type="hidden" value="">
        <input type="submit" value="Atualizar">
    </form>
    <a href="read_solicitacao.php">Voltar</a>
</body>
</html>