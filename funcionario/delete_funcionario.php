<?php
    include '../banco_de_dados/db.php';
    $id_funcionario = $_GET['id_funcionario'];
    $sql = "DELETE FROM funcionario WHERE id_funcionario = '$id_funcionario'";
    if($conn -> query($sql) === TRUE) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>". $conn -> error;
    }
    $conn -> close();
    header ("Location: read_funcionario.php");
    exit();
?>