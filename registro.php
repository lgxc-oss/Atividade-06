<?php

function buscarPorId(int $id): array|false {
    $pdo = conectar();

    $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE id = :id");
    $stmt->execute([':id' => $id]);

    return $stmt->fetch(); // retorna só uma linha
}

// --- Usando a função ---
$funcionario = buscarPorId(1);

if ($funcionario === false) {
    echo "Funcionário não encontrado.";
} else {
    echo "Nome: {$funcionario['nome']}";
    echo "Email: {$funcionario['email']}";
    echo "Salário: R$ {$funcionario['salario']}";
}
