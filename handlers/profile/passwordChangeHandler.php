
<?php

requireLogin();

$userId = $_SESSION['userId'];
$userDetails = $user->findById($userId);

if (!$userDetails) {
    header("Location: ../index.php");
    exit;
}

if(isPost()){

    $currentPassword = filter_input(INPUT_POST,"oldPassword");
    $newPassword = filter_input(INPUT_POST,"newPassword");
    $newPasswordRepeat = filter_input(INPUT_POST,"newPasswordRepeat");

    fieldEmptyCheck($currentPassword,$errors,"Aktualne hasło");
    validatePassword($newPassword,$errors);

    if($newPassword !== $newPasswordRepeat){
        $errors[] = "Nowe hasła muszą być takie same!";
    }

    if(empty($errors)){

        if(!password_verify($currentPassword,$userDetails['password'])){
            $errors[] = "Stare hasło jest niepoprawne!";

        } else {
            if($user->editPassword($userId,$newPassword)){
                header("Location: ../controllers/profileController.php");
                exit;
            }

            $errors[] = "Nie udało się zmienić hasła";
        }

    }
}

$pageTitle = "Zmiana hasła";
$view = __DIR__ . "/../../templates/profile/changePassword.php";

require __DIR__ . "/../../templates/layout.php";
