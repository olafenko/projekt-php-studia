<?php

requireLogin();

$userId = $_SESSION['userId'];

$allFavourites = $favourite->getFavourites($userId);


$pageTitle = "Ulubione";
$view = __DIR__ . "/../../templates/favourites.php";

require __DIR__ . "/../../templates/layout.php";
