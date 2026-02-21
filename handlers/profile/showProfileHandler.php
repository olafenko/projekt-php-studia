<?php

//pobiera z geta id uzytkownika, jezeli chcemy wyswietlic profil kogos innego
$userId = filter_input(INPUT_GET,"userId",FILTER_VALIDATE_INT);

//jezeli jest puste to user id ustawiane jest na zalogowanego uzytkownika
if($userId === null){

    $userId = $_SESSION['userId'];
}

//walidacja niepoprawnego userId podanego w url
if($userId === false || $userId <=0){
    header("Location: ../controllers/listingsController.php");
    exit;
}

$userDetails = $user->findById($userId);

if(!$userDetails) {
    $errors[] = "Nie znaleziono profilu użytkownika";
}

$pageTitle = "Profil " . $userDetails['username'];
$view = __DIR__ . "/../../templates/profile/userProfile.php";

require __DIR__ . "/../../templates/layout.php";

