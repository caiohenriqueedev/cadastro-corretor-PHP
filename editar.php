<?php
require_once "conexao.php";

// Verifica se o ID foi passado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?msg=erro");
    exit();
}

// Recupera o registro para edição
$id = intval($_GET['id']);
$sql = "SELECT * FROM corretores WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: index.php?msg=erro");
    exit();
}

$corretor = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Corretor</title>
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
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
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
        a.button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
        }
        a.button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Corretor</h1>

        <form method="POST" action="atualizar.php">
            <!-- ID oculto para envio -->
            <input type="hidden" name="id" value="<?php echo $corretor['id']; ?>">

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input 
                    type="text" 
                    name="cpf" 
                    id="cpf" 
                    value="<?php echo htmlspecialchars($corretor['cpf']); ?>" 
                    maxlength="11" 
                    required 
                    pattern="\d{11}" 
                    title="O CPF deve conter exatamente 11 dígitos numéricos">
            </div>

            <div class="form-group">
                <label for="creci">Creci:</label>
                <input 
                    type="text" 
                    name="creci" 
                    id="creci" 
                    value="<?php echo htmlspecialchars($corretor['creci']); ?>" 
                    minlength="2" 
                    required 
                    title="O Creci deve ter no mínimo 2 caracteres">
            </div>

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input 
                    type="text" 
                    name="nome" 
                    id="nome" 
                    value="<?php echo htmlspecialchars($corretor['nome']); ?>" 
                    minlength="2" 
                    required 
                    title="O Nome deve ter no mínimo 2 caracteres">
            </div>

            <button type="submit">Salvar Alterações</button>
        </form>

        <a href="index.php" class="button">Voltar</a>
    </div>
</body>
</html>
