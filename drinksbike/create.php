<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'drinks_bike';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $ingredientes = $_POST["ingredientes"];
    $descricao = $_POST["descricao"];
    $ano = $_POST["ano"];

    // Insere o novo drink no banco de dados
    $query = "INSERT INTO drinks (nome, categoria, ingredientes, descricao, ano) VALUES (:nome, :categoria, :ingredientes, :descricao, :ano)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':ingredientes', $ingredientes);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':ano', $ano);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao adicionar o drink.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Drink</title>
    <style>
        /* Estilos adicionais */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        label {
            margin-bottom: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Criar Novo Drink</h2>
        <form method="POST">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>

            <label for="categoria">Categoria</label>
            <input type="text" id="categoria" name="categoria" required>

            <label for="ingredientes">Ingredientes</label>
            <textarea id="ingredientes" name="ingredientes" required></textarea>

            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <label for="ano">Ano</label>
            <input type="number" id="ano" name="ano" required>

            <button type="submit" class="btn">Salvar Drink</button>
        </form>
    </div>
</body>
</html>
