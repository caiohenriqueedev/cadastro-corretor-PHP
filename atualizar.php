<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $creci = $_POST['creci'];

    $sql = "UPDATE corretores SET nome='$nome', cpf='$cpf', creci='$creci' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?msg=editado");
        exit();
    } else {
        header("Location: index.php?msg=erro");
        exit();
    }
}
?>
