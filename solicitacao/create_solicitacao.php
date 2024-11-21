<?php
    include '../banco_de_dados/db.php';
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
    <h1>Cadastrar uma solicitação</h1>
    <form method="POST" action="create_solicitacao.php">
        <label for="descricao">Descrição:</label> <br>
        <textarea name="descricao" required></textarea>
        <br> <br>
        <label for="urgencia">Urgência</label> <br>
        <input type="radio" name="urgencia" value="alta" required>Alta <br>
        <input type="radio" name="urgencia" value="media">Média <br>
        <input type="radio" name="urgencia" value="baixa">Baixa <br>     
        <br> <br>
        <label for="cliente">Cliente:</label>
        <select name="cliente" required>
        <option disabled>Selecione um cliente</option>
        <?php 
        if ($result_cliente -> num_rows > 0) { 
            while($row_cliente = $result_cliente -> fetch_assoc()) {
        ?> 
        <option value="<?php echo $row_cliente['id_cliente'];?>"><?php echo $row_cliente['nome']; ?></option>
        <?php } } else { ?>
        <option disabled><?php echo 'Sem nenhum cliente cadastrado'; } ?></option>
        </select>
        <br> <br>
        <label for="funcionario">Funcionário:</label>
        <select name="funcionario" required>
        <option disabled>Selecione um funcionário</option>
        <option>Sem funcionário</option>
        <?php 
        if ($result_funcionario -> num_rows > 0) { 
            while($row_funcionario = $result_funcionario -> fetch_assoc()) {
        ?> 
        <option value="<?php echo $row_funcionario['id_funcionario'];?>"><?php echo $row_funcionario['nome']; ?></option>
        <?php } } else { ?>
        <option disabled><?php echo 'Sem nenhum cliente cadastrado'; } ?></option>
        </select>
        <br> <br>
        <input type="submit" value="Adicionar">
    </form>
    <a href="read_solicitacao.php">Visualizar todas as solicitações cadastradas</a>
    <br> <br>
</body>
</html>
<?php
    include '../banco_de_dados/db.php';
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
        $cliente = $_POST['cliente'];
        if ($_POST['funcionario'] == "Sem funcionário") {
            $funcionario = null;
        } else {
            $funcionario = $_POST['funcionario'];
        }
        if ($funcionario == null) {
            $sql = "INSERT INTO solicitacao (descricao, urgencia, status_solicitacao, id_cliente_solicitacao) VALUE ('$descricao', '$urgencia', 'Pendente', '$cliente')";
        } else {
            $sql = "INSERT INTO solicitacao (descricao, urgencia, status_solicitacao, id_cliente_solicitacao, id_funcionario_solicitacao) VALUE ('$descricao', '$urgencia', 'Pendente', '$cliente', '$funcionario')";
        }
        if($conn -> query($sql) === TRUE) {
            echo "Novo registro adicionado com sucesso";
        } else {
            echo "Erro: " . $sql . "<br>". $conn -> error;
        }
    }
    $conn -> close();
?>