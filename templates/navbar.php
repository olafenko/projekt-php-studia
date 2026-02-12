<?php
$isLogged = isset($_SESSION['userId']);
?>


<nav class="mainNavbar">

    <div>
        <h1>
            <a href='listingsController.php?action=all'>Serwis ogłoszeniowy </a>
        </h1>
    </div>

    <div>
        <a href='listingsController.php?action=all'>Wszystkie ogłoszenia</a>

        <?php if ($isLogged) { ?>
            <a href='listingsController.php?action=add'> Dodaj ogłoszenie</a>
            <a href='favouritesController.php?action=show'>Ulubione</a>
            <a href='messagesController.php?action=show'>Wiadomości</a>
            <a href='profileController.php?action=show'>Konto</a>
            <a href='authController.php?action=logout'>Wyloguj</a>

        <?php } else { ?>
            <a href='authController.php?action=register'>Zarejestruj się</a>
            <a href='authController.php?action=login'>Logowanie</a>
        <?php } ?>


    </div>

</nav>
