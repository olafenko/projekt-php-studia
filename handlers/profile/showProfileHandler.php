<?php

$userDetails = $user->findById($_SESSION['userId']);

if(!$userDetails) {
    $errors[] = "Nie znaleziono profilu użytkownika";
}

$pageTitle = "Twój profil";

$view = __DIR__ . "/../../templates/profile/userProfile.php";

require __DIR__ . "/../../templates/layout.php";

