<?php

requireLogin();
$categories = $category->getAllCategories();


if (isPost()) {


    $title = trim(filter_input(INPUT_POST, "title"));
    $categoryId = filter_input(INPUT_POST, "categoryId",FILTER_VALIDATE_INT);
    $location = trim(filter_input(INPUT_POST, "location"));
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT);
    $photoUrl = trim(filter_input(INPUT_POST, "photoUrl"));
    $description = trim(filter_input(INPUT_POST, "description"));

    validateLocation($location, $errors);
    validateTitle($title, $errors);
    validatePrice($price, $errors);
    validateDescription($description, $errors);

    if(!$category->existsById($categoryId)) $errors[] = "Nieprawidłowa kategoria";

    if (empty($errors)) {

        if(!file_exists($photoUrl)){
            $photoUrl = "/SerwisOgloszeniowy/public/no-image.jpg";
        }

        if ($listing->createListing($title, $description, $_SESSION['userId'], $categoryId, $location, $photoUrl, $price)) {
            header("Location: ../controllers/listingsController.php");
            exit;
        } else {
            $errors[] = "Nie udało się dodać ogłoszenia.";
        }
    }

}

$pageTitle = "Formularz ogłoszenia";
$view = __DIR__ . "/../../templates/listings/listingForm.php";

require __DIR__ . "/../../templates/layout.php";
