<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $creci = $_POST['creci'];

    // Validação no PHP
    if (strlen($cpf) == 11 && is_numeric($cpf) && strlen($creci) >= 2 && strlen($nome) >= 2) {
        $sql = "INSERT INTO corretores (nome, cpf, creci) VALUES ('$nome', '$cpf', '$creci')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php?msg=sucesso");
            exit();
        } else {
            header("Location: index.php?msg=erro");
            exit();
        }
    } else {
        header("Location: index.php?msg=validacao");
        exit();
    }
}
