<?php
require_once 'conexao/Conexao.php';

try {
    $conexao = Conexao::getConexao();
    echo "✅ Conexão bem-sucedida com PostgreSQL!";
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage();
}