<?php
require_once 'config/conexao.php';

function deletarFuncionario(int $id): bool {
    $pdo = conectar();

    $stmt = $pdo->prepare("DELETE FROM funcionarios WHERE id = :id");
    $stmt->execute([':id' => $id]);

    return $stmt->rowCount() > 0; // true se deletou, false se não achou
}

// --- Usando a função ---
try {
    $deletado = deletarFuncionario(id: 1);

    if ($deletado) {
        echo "Funcionário removido com sucesso!";
    } else {
        echo "Nenhum funcionário encontrado com esse ID.";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
