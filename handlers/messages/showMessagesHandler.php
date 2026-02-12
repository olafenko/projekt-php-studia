<?php

requireLogin();

$userId = $_SESSION['userId'];



$allMessages = $message->showUserMessages($userId);
$unreadMessages = $message->countUnRead($userId);


$pageTitle = "Wiadomości (" . $unreadMessages . ")";
$view = __DIR__ . "/../../templates/messages/allMessages.php";

require __DIR__ . "/../../templates/layout.php";
