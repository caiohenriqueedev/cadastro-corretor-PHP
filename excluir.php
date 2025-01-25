<?php
require 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM corretores WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?msg=excluido");
        exit();
    } else {
        header("Location: index.php?msg=erro");
        exit();
    }
}
?>
