<?php
require_once __DIR__ . '/../autoload.php';

$pdo = new PDO('sqlite::memory:');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$re = $pdo->exec('CREATE TABLE IF NOT EXISTS pessoas (nome text NOT NULL, idade integer NOT NULL, sexo text NOT NULL);');

$prepare = $pdo->prepare('insert into pessoas (nome,idade) VALUES (:nome, :idade);');
$nome = 'Se Vira nos 60';
$idade = 25;
$sexo = 'masculino';

$prepare->bindParam(':nome', $nome);
$prepare->bindParam(':idade', $idade);

$prepare->execute();
