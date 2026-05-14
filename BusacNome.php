<?php

function buscarPorNome(string $nome): array {
    $pdo = conectar();

    $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE nome LIKE :nome");
    $stmt->execute([':nome' => "%$nome%"]);

    return $stmt->fetchAll();
}

// --- Usando a função ---
$resultado = buscarPorNome('Ana');

foreach ($resultado as $func) {
    echo "{$func['nome']} — {$func['cargo']} <br>";
}
