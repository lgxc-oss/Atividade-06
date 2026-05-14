<?php
require_once 'config/conexao.php';

function criarFuncionario(string $nome, string $email, string $cargo, float $salario): int {
    $pdo = conectar();

    $sql = "INSERT INTO funcionarios (nome, email, cargo, salario)
            VALUES (:nome, :email, :cargo, :salario)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nome'    => $nome,
        ':email'   => $email,
        ':cargo'   => $cargo,
        ':salario' => $salario,
    ]);

    // Retorna o ID do registro recém-criado
    return (int) $pdo->lastInsertId();
}

// --- Usando a função ---
try {
    $id = criarFuncionario(
        nome:    'Ana Lima',
        email:   'ana.lima@empresa.com',
        cargo:   'Desenvolvedora',
        salario: 5800.00
    );

    echo "Funcionário cadastrado com sucesso! ID: $id";

} catch (PDOException $e) {
    // Email duplicado (UNIQUE)
    if ($e->getCode() === '23000') {
        echo "Erro: esse e-mail já está cadastrado.";
    } else {
        echo "Erro no banco: " . $e->getMessage();
    }
}
