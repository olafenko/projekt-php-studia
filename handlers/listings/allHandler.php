<?php

if(isset($_GET['searchFragment'])){
    $searchFragment = htmlspecialchars($_GET['searchFragment']);
} else $searchFragment =  "";


if(!empty($searchFragment)){
    $allListings = $listing->searchListings($searchFragment);
} else {
    $allListings = $listing->getAllListings();
}



$pageTitle = "Wszystkie ogłoszenia";
$view = __DIR__ . "/../../templates/listings/allListings.php";

require __DIR__ . "/../../templates/layout.php";
return;