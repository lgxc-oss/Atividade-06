<?php


function softDelete(int $id): bool {
    $pdo = conectar();

    // Em vez de deletar, marca a data/hora da "exclusão"
    $stmt = $pdo->prepare(
        "UPDATE funcionarios SET deletado_em = NOW() WHERE id = :id"
    );

    $stmt->execute([':id' => $id]);

    return $stmt->rowCount() > 0;
}

// Buscar só os ATIVOS (não deletados)
function buscarAtivos(): array {
    $pdo = conectar();

    $stmt = $pdo->prepare(
        "SELECT * FROM funcionarios WHERE deletado_em IS NULL"
    );
    $stmt->execute();

    return $stmt->fetchAll();
}

// Restaurar um funcionário "deletado"
function restaurar(int $id): bool {
    $pdo = conectar();

    $stmt = $pdo->prepare(
        "UPDATE funcionarios SET deletado_em = NULL WHERE id = :id"
    );
    $stmt->execute([':id' => $id]);

    return $stmt->rowCount() > 0;
}

// --- Usando as funções ---
softDelete(id: 3);       // "deleta" o funcionário
restaurar(id: 3);        // restaura se necessário
$ativos = buscarAtivos(); // lista só os ativos
