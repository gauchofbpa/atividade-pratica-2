<?php
    include '../banco_de_dados/db.php';
    $id_cliente = $_GET['id_cliente'];
    $sql = "DELETE FROM cliente WHERE id_cliente = '$id_cliente'";
    if($conn -> query($sql) === TRUE) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>". $conn -> error;
    }
    $conn -> close();
    header ("Location: read_cliente.php");
    exit();
?>