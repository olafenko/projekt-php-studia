<?php

requireLogin();


$senderId = $_SESSION['userId'];

$listingId = filter_input(INPUT_GET,"listingId",FILTER_VALIDATE_INT);

if(!$listingId){

    $errors[] = "Nie znaleziono ogłoszenia";
    header("Location: ../controllers/listingsController.php");
    exit;
}

if(!$listingDetails = $listing->getListingById($listingId)){
    $errors[] = "Nie znaleziono danych ogłoszenia";
    header("Location: ../controllers/listingsController.php");
    exit;
}

if(isPost()){

    $receiverId = $listingDetails['authorId'];

    $content = trim(filter_input(INPUT_POST,"messageContent"));

    validateMsgContent($content,$errors);

    if(empty($errors)){

        $message->sendMessage($senderId,$receiverId,$listingId,$content);

        header("Location:  ../controllers/messagesController.php");
        exit;
    }


}

$pageTitle = "Nowa wiadomość";
$view = __DIR__ . "/../../templates/messages/sendMessageForm.php";

require __DIR__ . "/../../templates/layout.php";

