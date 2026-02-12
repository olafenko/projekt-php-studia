<?php

requireLogin();

if(isPost()){

    $userId = $_SESSION['userId'];
    $listingId = filter_input(INPUT_POST,'listingId',FILTER_VALIDATE_INT);

    if(!$listingId){
        $errors[] = "Nie znaleziono ogłoszenia";
    }

    if($favourite->isFavourite($listingId,$userId)){
       $errors[] = "To ogłoszenie już jest w ulubionych!";

    }

    if(empty($errors)){
        $favourite->addFavourite($userId,$listingId);
        header("Location: ../controllers/listingsController.php");
        exit;
    }

}
