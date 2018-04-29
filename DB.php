<?php
    function connectToDB($dbName)
    {
        $host = 'local_host';
        $db = '$dbName';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        
        
        $dsn = "mysql:host = $host; dbname = $db; charset = $charset";
        $opt = [
                PDO::ATTR_ERRMODE               => ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC,
                PDO::ATTR_EMMULATE_PREPARES     => false,
                ];
                
                $pdo = new PDO($dsn, $user, $pass, $opt);
                return $pdo;
    }
    
    
?>