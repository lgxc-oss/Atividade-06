<?php
require_once 'config/conexao.php';

function buscarTodos(): array {
    $pdo = conectar();

    $stmt = $pdo->prepare("SELECT * FROM funcionarios ORDER BY nome ASC");
    $stmt->execute();

    return $stmt->fetchAll(); // retorna todos como array
}

// --- Usando a função ---
$funcionarios = buscarTodos();

if (empty($funcionarios)) {
    echo "Nenhum funcionário encontrado.";
} else {
    foreach ($funcionarios as $func) {
        echo "ID: {$func['id']} | Nome: {$func['nome']} | Cargo: {$func['cargo']}";
        echo "<br>";
    }
}
