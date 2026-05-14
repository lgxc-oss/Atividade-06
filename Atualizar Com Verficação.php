<?php

function transferirCargo(int $id, string $novoCargo): string {
    $pdo = conectar();

    // Primeiro verifica se o funcionário existe
    $check = $pdo->prepare("SELECT id, cargo FROM funcionarios WHERE id = :id");
    $check->execute([':id' => $id]);
    $funcionario = $check->fetch();

    if (!$funcionario) {
        return "Funcionário não encontrado.";
    }

    $cargoAntigo = $funcionario['cargo'];

    // Agora faz o UPDATE
    $stmt = $pdo->prepare("UPDATE funcionarios SET cargo = :cargo WHERE id = :id");
    $stmt->execute([':cargo' => $novoCargo, ':id' => $id]);

    return "Cargo alterado de '{$cargoAntigo}' para '{$novoCargo}'.";
}

// --- Usando a função ---
echo transferirCargo(id: 1, novoCargo: 'Tech Lead');
// Saída: "Cargo alterado de 'Dev Sênior' para 'Tech Lead'."

?>
