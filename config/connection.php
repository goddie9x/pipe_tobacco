<?php
include_once './config/database.php';

$connections = [];
foreach ($connectionInfo as $name => $connection) {
    if (!isset($connections[$name])) {
        try {
            $connections[$name] = new PDO($connection['driver'] . ':host=' . $connection['host'] . ';dbname=' . $connection['database'], $connection['username'], $connection['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $ex) {
            global $enviroment;
            if($enviroment == 'production') {
                echo '<h1>Error: 500 cannot connect to server </h1>';
                exit;
            } else {
                die($ex->getMessage());
            }
        }
    }
}