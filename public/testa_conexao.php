<?php
require_once __DIR__ . '/../config/database.php';

$conn = Database::connect();

echo "Conexão com banco realizada com sucesso!";
