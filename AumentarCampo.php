<?
function aumentarSalario(int $id, float $novoSalario): bool {
    $pdo = conectar();

    $stmt = $pdo->prepare(
        "UPDATE funcionarios SET salario = :salario WHERE id = :id"
    );

    $stmt->execute([
        ':salario' => $novoSalario,
        ':id'      => $id,
    ]);

    return $stmt->rowCount() > 0;
}

// --- Usando a função ---
$resultado = aumentarSalario(id: 1, novoSalario: 8000.00);

echo $resultado ? "Salário atualizado!" : "ID não encontrado.";
