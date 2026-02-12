<?php

requireLogin();

if (!isPost()) {

    $errors[] = "Nie udało się usunąć z ulubionych";
}

$listingId = filter_input(INPUT_POST, 'listingId', FILTER_VALIDATE_INT);

if ($listingId) {
    $favourite->removeFavourite($listingId,$_SESSION['userId']);
}

header("Location: ../controllers/favouritesController.php");
exit;