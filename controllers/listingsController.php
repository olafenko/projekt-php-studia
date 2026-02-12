
<!--kontroller przekierowywuje odpowiednio do plików obsługujących akcje związane z ogłoszeniami-->
<?php

session_start();

require_once __DIR__ . "/../includes/database.php";
require __DIR__ . "/../src/Listing.php";
require __DIR__ . "/../src/Category.php";
require __DIR__ . "/../src/Favourite.php";
require __DIR__ . "/../includes/helpers.php";

$pdo = connectWithDatabase();
$listing = new Listing($pdo);
$category = new Category($pdo);
$favourite = new Favourite($pdo);

$errors = [];

$action = $_GET['action'] ?? "all";

switch ($action) {

    case "all" :
    {
        require __DIR__ . "/../handlers/listings/allHandler.php";
        break;
    }

    case "details" :
    {
        require __DIR__ . "/../handlers/listings/detailsHandler.php";
        break;
    }

    case "add":
    {
        require __DIR__ . "/../handlers/listings/addHandler.php";
        break;
    }

    //case ?action=edit
    //jezeli wysłano formularz post wykonuje logike edytowania ogłoszenia
    //jezeli przyszedł zwykly get to wyswietla formularz
    case "edit" :
    {
        require __DIR__ . "/../handlers/listings/editHandler.php";
        break;
    }

    case "delete" :
    {
        require __DIR__ . "/../handlers/listings/deleteHandler.php";
        break;
    }

    default : {
        require __DIR__ . "/../handlers/listings/allHandler.php";
        break;
    }


}
