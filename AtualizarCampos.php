<?php
require_once 'config/conexao.php';

function atualizarFuncionario(int $id, string $nome, string $email, string $cargo, float $salario): bool {
    $pdo = conectar();

    $sql = "UPDATE funcionarios 
            SET nome    = :nome,
                email   = :email,
                cargo   = :cargo,
                salario = :salario
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':id'      => $id,
        ':nome'    => $nome,
        ':email'   => $email,
        ':cargo'   => $cargo,
        ':salario' => $salario,
    ]);

    return $stmt->rowCount() > 0; // true se atualizou, false se não achou o ID
}

// --- Usando a função ---
try {
    $atualizado = atualizarFuncionario(
        id:      1,
        nome:    'Ana Lima Silva',
        email:   'ana.silva@empresa.com',
        cargo:   'Dev Sênior',
        salario: 7500.00
    );

    if ($atualizado) {
        echo "Funcionário atualizado com sucesso!";
    } else {
        echo "Nenhum funcionário encontrado com esse ID.";
    }

} catch (PDOException $e) {
    if ($e->getCode() === '23000') {
        echo "Erro: esse e-mail já pertence a outro funcionário.";
    } else {
        echo "Erro: " . $e->getMessage
