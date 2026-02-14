<?php


if(isset($_GET['searchFragment'])){
    $searchFragment = htmlspecialchars($_GET['searchFragment']);
} else $searchFragment =  "";


if(!empty($searchFragment)){
    $allListings = $listing->searchListings($searchFragment);
} else {
    $allListings = $listing->getAllListings();
}

if(isset($_SESSION['userId'])){
    $favourites  = $favourite->getFavourites($_SESSION['userId']);
    $allFavourites = array_column($favourites,'listingId');
}



$pageTitle = "Wszystkie ogłoszenia";
$view = __DIR__ . "/../../templates/listings/allListings.php";

require __DIR__ . "/../../templates/layout.php";
return;