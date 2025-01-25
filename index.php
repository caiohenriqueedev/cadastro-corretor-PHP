<?php
// Conexão com o banco de dados
require_once "conexao.php";

// Recuperar os registros da tabela
$sql = "SELECT id, nome, cpf, creci FROM corretores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Corretor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .feedback {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .feedback.success {
            color: #155724;
            background-color: #d4edda;
        }
        .feedback.error {
            color: #721c24;
            background-color: #f8d7da;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        .actions button {
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #ffc107;
            color: #fff;
        }
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-edit:hover {
            background-color: #e0a800;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_GET['msg'])): ?>
            <div class="feedback 
                <?php echo ($_GET['msg'] == 'sucesso' || $_GET['msg'] == 'editado' || $_GET['msg'] == 'excluido') ? 'success' : 'error'; ?>">
                <?php
                if ($_GET['msg'] == 'sucesso') echo "Cadastro realizado com sucesso!";
                elseif ($_GET['msg'] == 'erro') echo "Ocorreu um erro ao processar sua solicitação.";
                elseif ($_GET['msg'] == 'excluido') echo "Registro excluído com sucesso!";
                elseif ($_GET['msg'] == 'editado') echo "Registro atualizado com sucesso!";
                elseif ($_GET['msg'] == 'validacao') echo "Erro de validação: Preencha todos os campos corretamente.";
                ?>
            </div>
        <?php endif; ?>

        <h1>Cadastro de Corretor</h1>

        <!-- Formulário -->
        <form method="POST" action="processar.php">
            <div class="form-group">
                <input 
                    type="text" 
                    name="cpf" 
                    placeholder="Digite seu CPF" 
                    maxlength="11" 
                    required 
                    pattern="\d{11}" 
                    title="O CPF deve conter exatamente 11 dígitos numéricos">
            </div>
            <div class="form-group">
                <input 
                    type="text" 
                    name="creci" 
                    placeholder="Digite seu Creci" 
                    minlength="2" 
                    required 
                    title="O Creci deve ter no mínimo 2 caracteres">
            </div>
            <div class="form-group">
                <input 
                    type="text" 
                    name="nome" 
                    placeholder="Digite seu nome" 
                    minlength="2" 
                    required 
                    title="O Nome deve ter no mínimo 2 caracteres">
            </div>
            <button type="submit">Enviar</button>
        </form>

        <!-- Tabela de Corretores -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Creci</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['cpf']; ?></td>
                            <td><?php echo $row['creci']; ?></td>
                            <td class="actions">
                                <a href="editar.php?id=<?php echo $row['id']; ?>">
                                    <button class="btn-edit">Editar</button>
                                </a>
                                <a href="excluir.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">
                                    <button class="btn-delete">Excluir</button>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Nenhum registro encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
