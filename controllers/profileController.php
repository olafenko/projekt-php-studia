<!--kontroller przekierowywuje odpowiednio do plików obsługujących akcje związane z profilem użytkownika-->
<?php

session_start();

require_once __DIR__ . "/../includes/database.php";
require __DIR__ . "/../src/User.php";
require __DIR__ . "/../src/Listing.php";
require __DIR__ . "/../includes/helpers.php";

requireLogin();

$pdo = connectWithDatabase();
$user = new User($pdo);
$listing = new Listing($pdo);
$errors = [];

$action = $_GET['action'] ?? "show";

switch ($action){


    case "show" : {
        require __DIR__ . "/../handlers/profile/showProfileHandler.php";
        break;
    }

    case "edit" : {
        require __DIR__ . "/../handlers/profile/editProfileHandler.php";
        break;
    }
    case "passwordChange" : {
        require __DIR__ . "/../handlers/profile/passwordChangeHandler.php";
        break;
    }

    case "delete" : {
        require __DIR__ . "/../handlers/profile/deleteProfileHandler.php";
        break;
    }


}
