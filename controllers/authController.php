
<!--kontroller przekierowywuje odpowiednio do plików obsługujących akcje związane z autentykacją uzytkownika-->
<?php
session_start();
require_once __DIR__ . "/../includes/database.php";
require __DIR__ . "/../src/User.php";
require __DIR__ . "/../includes/helpers.php";


$pdo = connectWithDatabase();
$user = new User($pdo);
$errors = [];

$action = $_GET['action'] ?? "login";


switch ($action){


    case "login" : {

        require __DIR__ . "/../handlers/auth/loginHandler.php";
        break;
    }

    case "register" : {

        require __DIR__ . "/../handlers/auth/registerHandler.php";
        break;
    }

    case "logout" : {

        require __DIR__ . "/../handlers/auth/logoutHandler.php";
        break;
    }



}