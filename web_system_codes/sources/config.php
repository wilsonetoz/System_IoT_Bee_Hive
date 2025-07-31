<?php
    // Use getenv() para ler as variáveis de ambiente do Docker
    define('HOST', getenv('MYSQL_HOST') ?: 'db');
    define('USER', getenv('MYSQL_USER') ?: 'root');
    define('PASS', getenv('MYSQL_PASSWORD') ?: 'admin');
    define('DB', getenv('MYSQL_DATABASE') ?: 'bee_hive_db');
?>