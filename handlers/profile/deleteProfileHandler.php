<?php

if(!isPost()){
    header("Location: ../controllers/profileController.php");
    exit;
}

$userId = $_SESSION['userId'];
if($userId){
    $userListings = $listing->getUserListings($userId);
    foreach($userListings as $l) $listing->deleteListing($l['id']);
    $user->deactivateUser($userId);

    header("Location: ../controllers/authController.php?action=logout");
    exit;
}


