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

// Recebe parâmetro de busca
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Consulta com filtragem por nome
$query = "SELECT * FROM drinks WHERE nome LIKE :search";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':search', '%' . $search . '%');
$stmt->execute();

// Pega os resultados
$drinks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drinks Bike - Sua Jornada de Sabores</title>
    <style>
        body {
            margin: 0;
            font-family: 'Playfair Display', serif;
            background-color: #1a1a1a;
            color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav {
            background-color: #333;
            padding: 20px;
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        nav .logo {
            font-size: 1.8em;
            color: #d4af37;
        }

        nav form {
            margin-top: 10px;
        }

        nav input[type="text"], nav input[type="submit"] {
            padding: 10px;
            margin: 5px;
            border: none;
            border-radius: 5px;
        }

        nav input[type="submit"] {
            background-color: #d4af37;
            color: black;
            cursor: pointer;
        }

        nav input[type="submit"]:hover {
            background-color: #b0b0b0;
        }

        .container {
            margin: 140px auto 20px;
            padding: 20px;
            max-width: 800px;
            background-color: #2a2a2a;
            border-radius: 10px;
        }

        .container ul {
            list-style: none;
            padding: 0;
        }

        .container li {
            margin-bottom: 20px;
            padding: 10px;
            background: #333;
            border-radius: 5px;
        }

        .container hr {
            border: none;
            border-bottom: 1px solid #d4af37;
            margin: 10px 0;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #f5f5f5;
            border-top: 2px solid #d4af37;
        }

        #back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none; /* Escondido inicialmente */
            padding: 10px 15px;
            background-color: #d4af37;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        /* Estilo para o link "Adicionar Novo Drink" */
        a.btn-primary {
            color: #d4af37; /* Cor amarela */
            text-decoration: none; /* Remove o sublinhado */
        }

        a.btn-primary:hover {
            color: #b0b0b0; /* Cor de hover mais escura */
        }

        /* Estilo para o link "Deletar" */
        a.btn-danger {
            color: #d4af37; /* Cor amarela */
            text-decoration: none; /* Remove o sublinhado */
        }

        a.btn-danger:hover {
            color: #b0b0b0; /* Cor de hover mais escura */
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">Drinks Bike</div>
        <form method="GET" action="index.php">
            <input type="text" name="search" placeholder="Pesquisar drinks..." value="<?php echo htmlspecialchars($search); ?>">
            <input type="submit" value="Buscar">
        </form>
    </nav>

    <div class="container">
        <h2>Drinks Encontrados:</h2>

        <!-- Link para adicionar novo drink -->
        <a href="create.php" class="btn btn-primary mb-3">Adicionar Novo Drink</a>

        <ul>
            <?php
            if ($drinks) {
                foreach ($drinks as $drink) {
                    echo "<li>";
                    echo "<strong>Nome:</strong> " . htmlspecialchars($drink['nome']) . "<br>";
                    echo "<strong>Categoria:</strong> " . htmlspecialchars($drink['categoria']) . "<br>";
                    echo "<strong>Ingredientes:</strong> " . htmlspecialchars($drink['ingredientes']) . "<br>";
                    echo "<strong>Descrição:</strong> " . htmlspecialchars($drink['descricao']) . "<br>";
                    echo "<strong>Ano:</strong> " . htmlspecialchars($drink['ano']);
                    // Link para excluir o drink
                    echo " <a href='delete.php?id=" . $drink['id'] . "' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Deletar</a>";
                    echo "</li><hr>";
                }
            } else {
                echo "<li>Nenhum drink encontrado.</li>";
            }
            ?>
        </ul>
    </div>

    <footer>
        <p>© <?php echo date("Y"); ?> Drinks Bike. Todos os direitos reservados.</p>
    </footer>

    <button id="back-to-top">Voltar ao Topo</button>

    <!-- Vinculação do arquivo JavaScript -->
    <script src="script.js"></script>
</body>
</html>
