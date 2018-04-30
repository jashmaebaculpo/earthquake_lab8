<?php
    function connectToDB($dbName)
    {
        $host = 'localhost';
        $db = $dbName;
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        
        //checking whether the URL contains "herokuapp" (using Heroku)
        if(strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $host = $url["host"];
            $db = substr($url["path"], 1);
            $user = $url["user"];
            $pass = $url["pass"];
        }
        
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
                PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                ];
                
        $pdo = new PDO($dsn, $user, $pass, $opt);
        return $pdo;
    }
    
    //mysql://bb4813181c1216:1fa2ba53@us-cdbr-iron-east-05.cleardb.net/heroku_3033736f05ca58d?reconnect=true
?>
