<?php

requireLogin();
$categories = $category->getAllCategories();

if (isPost()) {

    $listingId = filter_input(INPUT_POST, 'listingId', FILTER_VALIDATE_INT);

    if (!$listingId){
        $errors[] = "Nieprawidłowe ID ogłoszenia.";
    } else {
        $listingDetails = $listing->getListingById($listingId);

        if(!$listingDetails){
            $errors[] = "Nie znaleziono ogłoszenia.";
        } else if (!$listing->isOwner($listingId, $_SESSION['userId'])){
            $errors[] = "Brak uprawnień.";
        }


    }
    if (empty($errors)){

        $title = trim(filter_input(INPUT_POST, "title"));
        $categoryId = filter_input(INPUT_POST, "categoryId", FILTER_VALIDATE_INT);
        $location = trim(filter_input(INPUT_POST, "location"));
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT);
        $photoUrl = "";
        if(!empty($_FILES['image']['name'])){
            $photoUrl = $imageUploader->uploadImage($_FILES['image'],$uploadErrors);
        }

        $description = trim(filter_input(INPUT_POST, "description"));

        validateCategory($categoryId,$errors);
        validateLocation($location, $errors);
        validateTitle($title, $errors);
        validatePrice($price, $errors);
        validateDescription($description, $errors);

        if(!$category->existsById($categoryId)) $errors[] = "Nie znaleziono kategorii";

        if (empty($errors)) {

            $listing->editListing($listingId, $title, $description, $categoryId, $location, $photoUrl, $price);
            header("Location: ../controllers/listingsController.php");
            exit;

        }

    }
} else {

    $listingId = filter_input(INPUT_GET, 'listingId', FILTER_VALIDATE_INT);
    $listingDetails = $listing->getListingById($listingId);
    if (!$listingId || !$listingDetails || !$listing->isOwner($listingId, $_SESSION['userId'])) {
        header("Location: ../controllers/listingsController.php");
        exit;
    }

    $pageTitle = "Formularz ogłoszenia";
    $view = __DIR__ . "/../../templates/listings/listingForm.php";

    require __DIR__ . "/../../templates/layout.php";
}