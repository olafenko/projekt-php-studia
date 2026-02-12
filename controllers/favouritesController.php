<!--kontroller przekierowywuje odpowiednio do plików obsługujących akcje związane z ulubionymi ogłoszeniami-->
<?php

session_start();

require_once __DIR__ . "/../includes/database.php";
require __DIR__ . "/../src/Favourite.php";
require __DIR__ . "/../includes/helpers.php";

requireLogin();


$pdo = connectWithDatabase();
$favourite = new Favourite($pdo);


$errors = [];

$action = $_GET['action'] ?? "show";

switch ($action) {

    case "show" :
    {

        require __DIR__ . "/../handlers/favourites/showFavouritesHandler.php";
        break;
    }

    case "add" :
    {

        require __DIR__ . "/../handlers/favourites/addFavouriteHandler.php";
        break;
    }

    case "delete" :
    {

        require __DIR__ . "/../handlers/favourites/deleteFavouriteHandler.php";
        break;
    }


}