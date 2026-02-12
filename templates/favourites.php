
<div align="center">
    <?php
    foreach ($errors as $error) {
        echo htmlspecialchars($error) . "<br>";
    }
    ?>
</div>

<div class="listingsWrapper">

    <div class='resultsCount'>
        <h3>Ulubione: <?=count($allFavourites) !== 0 ? count($allFavourites) : "Brak"?></h3>
    </div>

    <div class="listingsCards">

        <?php foreach ($allFavourites as $fav) { ?>

            <div class='listingCard'>
                <div class='listingCard-photo'>
                    <img src='<?= htmlspecialchars($fav['photoUrl']) ?: '/SerwisOgloszeniowy/public/no-image.jpg' ?>'>
                </div>
                <div class="listingCard-body">
                    <h3><?= htmlspecialchars($fav['title']) ?></h3>
                    <p>Lokalizacja: <?= htmlspecialchars($fav['location']) ?></p>
                    <p class="price">Cena: <?= htmlspecialchars($fav['price']) ?> zł</p>
                    <p class="metaData">Dodano przez: <?= htmlspecialchars($fav['username']) ?></p>
                </div>
                <div class="listingCard-actions">
                    <a class="detailsBtn"
                       href='../controllers/listingsController.php?action=details&listingId=<?= htmlspecialchars($fav['listingId']) ?>'>Pokaż
                        szczegóły</a>

                    <form method='post' action='../controllers/favouritesController.php?action=delete'>
                        <input type='hidden' name='listingId' value="<?= htmlspecialchars($fav['listingId'])?>">
                        <button type='submit' class="iconBtn delete">❌</button>
                    </form>
                </div>
            </div>


        <?php } ?>

    </div>
</div>




