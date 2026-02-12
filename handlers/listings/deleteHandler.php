<?php


requireLogin();


if (!isPost()) {

    header("Location: ../controllers/listingsController.php");
    exit;
}

$listingId = filter_input(INPUT_POST, 'listingId', FILTER_VALIDATE_INT);

if ($listingId && $listing->isOwner($listingId, $_SESSION['userId'])) {
    $listing->deleteListing($listingId);
}

header("Location: ../controllers/listingsController.php");
exit;

