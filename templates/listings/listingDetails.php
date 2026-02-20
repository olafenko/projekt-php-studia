<?php
//jak uzytkownik jest zalogowany i jego id z sesji zgadza sie z id ogloszenia to moze napisac wiadomosc do autora
$isUserLogged = isset($_SESSION['userId']);
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Serwis ogłoszeniowy</title>
</head>
<body>
<div align="center">
    <?php
    foreach ($errors as $error) {
        echo htmlspecialchars($error) . "<br>";
    }
    ?>
</div>
<div class="listingDetailsPage">

    <div class="detailsCard">

        <!--    LEWA CZESC STRONY-->
        <div class="detailsLeft">
            <div class="detailsPhoto">
                <img src="<?= htmlspecialchars($listingDetails['photoUrl']) ?>">
            </div>

            <div class="detailsInfo">
                <div class="detailsTitleAndPrice">
                    <h2><?= htmlspecialchars($listingDetails['title']) ?></h2>
                    <p class="detailsPrice"><?= htmlspecialchars($listingDetails['price']) ?> zł</p>
                </div>
                <p>Data dodania: <?= htmlspecialchars($listingDetails['createdAt']) ?></p>
                <p>Lokalizacja: <?= htmlspecialchars($listingDetails['location']) ?></p>
                <p>Kategoria: <?= htmlspecialchars($listingDetails['category']) ?></p>
                <div class="detailsDescription">
                    <p>Opis: <?= htmlspecialchars($listingDetails['description']) ?></p>
                </div>
            </div>
        </div>

        <!--    PRAWA CZESC STRONY-->
        <div class="detailsRight">
            <a href="../controllers/profileController.php?action=show&userId=<?=$listingDetails['authorId'] ?>">Autor ogłoszenia: <?= htmlspecialchars($listingDetails['author']) ?></a>
            <div class="contactBox">
                <h2>Kontakt </h2>
                <p><strong>Email: <?= htmlspecialchars($listingAuthorDetails['email']) ?></p>
                <p><strong>Nr tel. <?= htmlspecialchars($listingAuthorDetails['phoneNumber']) ?></p>
            </div>

            <?php if ($isUserLogged && $_SESSION['userId'] !== $listingDetails['authorId']) { ?>
                <a class="msgBtn" href="../controllers/messagesController.php?action=send&listingId=<?= htmlspecialchars($listingDetails['id'])?>">Napisz wiadomość</a>
            <?php } ?>

        </div>
    </div>


</div>

</body>
</html>