-- Selecione o banco de dados que você quer usar
CREATE DATABASE IF NOT EXISTS drinksbike;

-- Use o banco de dados criado
USE drinksbike;

-- Criação da tabela de drinks
CREATE TABLE IF NOT EXISTS drinks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    categoria ENUM('alcoólico', 'não alcoólico') NOT NULL,
    descricao TEXT,
    imagem VARCHAR(255)
);

-- Inserção de dados na tabela
INSERT INTO drinks (nome, categoria, descricao, imagem) VALUES
('Caipirinha', 'alcoólico', 'Drink brasileiro clássico com limão, cachaça, açúcar e gelo.', 'caipirinha.jpg'),
('Mojito', 'alcoólico', 'Drink refrescante com rum, hortelã, limão e açúcar.', 'mojito.jpg'),
('Suco de Laranja', 'não alcoólico', 'Suco natural e fresco de laranja.', 'suco_laranja.jpg'),
('Água Tônica', 'não alcoólico', 'Bebida refrescante com sabor amargo.', 'agua_tonica.jpg');

ALTER TABLE drinks ADD COLUMN categoria VARCHAR(50);


INSERT INTO drinks (nome, categoria) VALUES
('Caipirinha', 'alcoólico'),
('Mojito', 'alcoólico'),
('Suco de Laranja', 'não alcoólico'),
('Água de Coco', 'não alcoólico');

DESCRIBE drinks;

SELECT * FROM drinks;

SELECT id, nome, categoria FROM drinks;
