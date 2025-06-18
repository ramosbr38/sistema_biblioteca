<?php
class Conexao {
    private static $conn;

    public static function getConexao() {
        if (!self::$conn) {
            $host = 'localhost';
            $port = '5432';
            $dbname = 'biblioteca';
            $user = 'postgres';
            $password = 'postgre';

            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

            try {
                self::$conn = new PDO($dsn, $user, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro ao conectar: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
