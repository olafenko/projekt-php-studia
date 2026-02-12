<?php

requireLogin();


$currentUserId = $_SESSION['userId'];

$messageId = filter_input(INPUT_GET,"messageId",FILTER_VALIDATE_INT);

if(!$messageId){

    $errors[] = "Nie znaleziono wiadmości";
    header("Location: ../controllers/listingsController.php");
    exit;
}

if(!$messageDetails = $message->getMessageDetails($messageId,$currentUserId)){
    $errors[] = "Nie znaleziono danych wiadomości";
    header("Location: ../controllers/listingsController.php");
    exit;
}

if(isPost()){

    $receiverId = $messageDetails['senderId'];

    $listingId = $messageDetails['listingId'];

    $content = trim(filter_input(INPUT_POST,"messageContent"));

    validateMsgContent($content,$errors);

    if(empty($errors)){

        $message->sendMessage($currentUserId,$receiverId,$listingId,$content);

        header("Location:  ../controllers/messagesController.php");
        exit;
    }


}

$pageTitle = "Odpowiedz";
$view = __DIR__ . "/../../templates/messages/replyMessageForm.php";

require __DIR__ . "/../../templates/layout.php";

