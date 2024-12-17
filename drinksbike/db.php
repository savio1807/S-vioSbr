<?php
$host = 'localhost'; // Ou o endereço do seu servidor de banco de dados
$dbname = 'drinks_bike'; // Nome do banco de dados
$username = 'root'; // Seu nome de usuário
$password = ''; // Sua senha

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Define o modo de erro do PDO para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>
