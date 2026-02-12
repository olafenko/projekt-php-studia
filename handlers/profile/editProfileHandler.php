<?php

requireLogin();

$userId = $_SESSION['userId'];
$userDetails = $user->findById($userId);

if (!$userDetails) {
    header("Location: ../index.php");
    exit;
}


if (isPost()) {

    $username = filter_input(INPUT_POST, "username");
    $email = filter_input(INPUT_POST, "email");
    $phoneNumber = trim(filter_input(INPUT_POST, "phoneNumber"));
    $avatarUrl = trim(filter_input(INPUT_POST, "avatarUrl"));


    validateEmail($email, $errors);
    validateUsername($username, $errors);

    //jezeli istnieje juz taka nazwa u innego uzytkownika
    if($user->existsByUsername($username) && $userDetails['username'] !== $username){
        $errors[] = "Nazwa użytkownika jest zajęta";
    }

    //jezeli istnieje juz taki email u innego uzytkownika
    if($user->existsByEmail($email) && $userDetails['email'] !== $email){
        $errors[] = "Email jest zajęty";
    }

    if (empty($errors)) {

        if ($user->editUserData($userId, $username, $email, $phoneNumber, $avatarUrl)) {
            header("Location: ../controllers/profileController.php");
        } else {
            $errors[] = "Nie udało się edytować";
        }
    }
}

$pageTitle = "Edytowanie profilu";
$view = __DIR__ . "/../../templates/profile/editProfile.php";

require __DIR__ . "/../../templates/layout.php";
