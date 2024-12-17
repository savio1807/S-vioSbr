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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui o drink do banco de dados
    $query = "DELETE FROM drinks WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao excluir o drink.";
    }
} else {
    echo "ID do drink não fornecido.";
}
?>
