<?php

// skrypt odpowiedzialny za polaczenie z baza danych
function connectWithDatabase(){

    // __DIR__ wskazuje na sciezke z której uruchaniany jest skrypt
    $dbConfig = require __DIR__ . "/../config/dbConfig.php";

    try {
        $pdo = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset=utf8mb4",$dbConfig['user'],$dbConfig['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e){
        die("Błąd połączenia: " . $e->getMessage());
    }


}




