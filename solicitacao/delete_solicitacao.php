<?php
    include '../banco_de_dados/db.php';
    $id_solicitacao = $_GET['id_solicitacao'];
    $sql = "DELETE FROM solicitacao WHERE id_solicitacao = '$id_solicitacao'";
    if($conn -> query($sql) === TRUE) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>". $conn -> error;
    }
    $conn -> close();
    header ("Location: read_solicitacao.php");
    exit();
?>