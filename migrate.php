<?php

require_once __DIR__ . '/config/database.php';

echo "Iniciando processo de migração...\n";

try {
    $pdo = Database::connect();
    echo "Conexão com o banco de dados estabelecida.\n";

    $migrationsDir = __DIR__ . '/database/migrations';
    $migrationFiles = glob($migrationsDir . '/*.php');
    sort($migrationFiles); 

    $executedCount = 0;
    foreach ($migrationFiles as $file) {
        require_once $file;
        $functionName = 'up'; 

        if (function_exists($functionName)) {
            echo "Executando migration: " . basename($file) . "...\n";
            $functionName($pdo); 
            $executedCount++;
        } else {
            echo "Aviso: A função 'up' não foi encontrada em " . basename($file) . "\n";
        }
    }

    if ($executedCount > 0) {
        echo "\nMigração concluída! " . $executedCount . " migration(s) executada(s).\n";
    } else {
        echo "\nNenhuma migration encontrada para executar.\n";
    }

} catch (PDOException $e) {
    echo "\nErro na migração do banco de dados: " . $e->getMessage() . "\n";
    exit(1);
} catch (Exception $e) {
    echo "\nUm erro inesperado ocorreu: " . $e->getMessage() . "\n";
    exit(1);
}