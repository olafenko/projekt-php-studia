<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?=$pageTitle ?? "Serwis Ogłoszeniowy"?></title>
    <link rel="stylesheet" href="/SerwisOgloszeniowy/public/style.css">
</head>
<body>

<?php require "navbar.php"?>

<main class="mainContainer">
    <?php require $view ?>
</main>


</body>
</html>
