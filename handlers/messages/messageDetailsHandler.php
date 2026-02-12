<?php

requireLogin();

$userId = $_SESSION['userId'];

$messageId = filter_input(INPUT_GET,'messageId',FILTER_VALIDATE_INT);

if(!$messageId){
    header("Location: ../controllers/messagesController.php");
    exit;
}

$messageDetails = $message->getMessageDetails($messageId,$userId);

if(!$messageDetails){
    $errors[] = "Nie znaleziono wiadomości";
    header("Location: ../controllers/messagesController.php");
    exit;
}

$message->markAsRead($messageId,$userId);

$pageTitle = "Wiadomość od " . $messageDetails['senderName'];
$view = __DIR__ . "/../../templates/messages/messageDetails.php";

require __DIR__ . "/../../templates/layout.php";