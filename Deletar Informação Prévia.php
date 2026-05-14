<?php

function deletarComConfirmacao(int $id): string {
    $pdo = conectar();

    // Primeiro busca o funcionário para guardar o nome
    $check = $pdo->prepare("SELECT nome FROM funcionarios WHERE id = :id");
    $check->execute([':id' => $id]);
    $funcionario = $check->fetch();

    if (!$funcionario) {
        return "Funcionário com ID $id não encontrado.";
    }

    $nome = $funcionario['nome']; // guarda o nome antes de deletar

    // Agora deleta
    $stmt = $pdo->prepare("DELETE FROM funcionarios WHERE id = :id");
    $stmt->execute([':id' => $id]);

    return "Funcionário '$nome' removido com sucesso!";
}

// --- Usando a função ---
echo deletarComConfirmacao(id: 2);
// Saída: "Funcionário 'Ana Lima Silva' removido com sucesso!"
