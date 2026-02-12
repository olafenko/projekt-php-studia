<?php

$id = filter_input(INPUT_GET, 'listingId', FILTER_VALIDATE_INT);
$listingDetails = $listing->getListingById($id);
$listingAuthorDetails = $listing->getListingAuhthorDetails($id);
if (!$id || !$listingDetails || !$listingAuthorDetails) {
    header("Location: ../controllers/listingsController.php");
    exit;
}


$pageTitle = $listingDetails['title'];
$view = __DIR__ . "/../../templates/listings/listingDetails.php";

require __DIR__ . "/../../templates/layout.php";