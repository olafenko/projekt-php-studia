<!--kontroller przekierowywuje odpowiednio do plików obsługujących akcje związane z wiadomościami-->
<?php

session_start();

require_once __DIR__ . "/../includes/database.php";
require __DIR__ . "/../src/Message.php";
require __DIR__ . "/../src/Listing.php";
require __DIR__ . "/../includes/helpers.php";

requireLogin();


$pdo = connectWithDatabase();
$message = new Message($pdo);
$listing = new Listing($pdo);


$errors = [];

$action = $_GET['action'] ?? "show";

switch ($action){

    case "show" : {

        require __DIR__ . "/../handlers/messages/showMessagesHandler.php";
        break;
    }

    case "send" : {

        require __DIR__ . "/../handlers/messages/sendMessageHandler.php";
        break;
    }

    case "details" : {

        require __DIR__ . "/../handlers/messages/messageDetailsHandler.php";
        break;
    }



}