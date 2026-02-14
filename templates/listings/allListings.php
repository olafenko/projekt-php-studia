<?php
//jak uzytkownik jest zalogowany i jego id z sesji zgadza sie z id ogloszenia to moze je edytowac lub usunac
$isUserLogged = isset($_SESSION['userId']);
?>

<div align="center">
    <?php
    foreach ($errors as $error) {
        echo htmlspecialchars($error) . "<br>";
    }
    ?>
</div>

<div class="listingsPage">

         <form class="searchBar" method="get" action="../controllers/listingsController.php">
                <input type="text" name="searchFragment" placeholder="Wyszukaj po nazwie" value="<?= htmlspecialchars($_GET['searchFragment'] ?? '')?>">
                <button type="submit">Szukaj</button>
         </form>



    <div class='resultsCount'>
        <h3>Znalezione ogłoszenia: <?= count($allListings) ?></h3>
    </div>

    <div class="listingsCards">

        <?php foreach ($allListings as $listing) { ?>

            <div class='listingCard'>
                <div class='listingCard-photo'>
                    <img src='<?= htmlspecialchars($listing['photoUrl']) ?: '/SerwisOgloszeniowy/public/no-image.jpg' ?>'>
                </div>
                <div class="listingCard-body">
                    <h3><?= htmlspecialchars($listing['title']) ?></h3>
                    <p>Kategoria: <?= htmlspecialchars($listing['category']) ?></p>
                    <p>Lokalizacja: <?= htmlspecialchars($listing['location']) ?></p>
                    <p class="price">Cena: <?= htmlspecialchars($listing['price']) ?> zł</p>
                    <p class="metaData">Dodano przez: <?= htmlspecialchars($listing['author']) ?></p>
                    <p class="metaData">Data dodania: <?= htmlspecialchars($listing['createdAt']) ?></p>
                </div>
                <div class="listingCard-actions">
                    <a class="detailsBtn"
                       href='../controllers/listingsController.php?action=details&listingId=<?= htmlspecialchars($listing['id']) ?>'>Pokaż
                        szczegóły</a>
                    <?php if ($isUserLogged) { ?>

                        <?php if ($listing['authorId'] === $_SESSION['userId']) { ?>
                            <a class="editBtn"
                               href='../controllers/listingsController.php?action=edit&listingId=<?= htmlspecialchars($listing['id']) ?>'>Edytuj</a>
                            <form method='post' action='../controllers/listingsController.php?action=delete'>
                                <input type='hidden' name='listingId' value='<?= htmlspecialchars($listing['id']) ?>'>
                                <button type='submit' class="iconBtn delete">❌</button>
                            </form>
                        <?php } else if (!in_array($listing['id'],$allFavourites)){ ?>
                            <form method='post' action='../controllers/favouritesController.php?action=add'>
                                <input type='hidden' name='listingId' value='<?= htmlspecialchars($listing['id']) ?>'>
                                <button type='submit' class="iconBtn fav">❤</button>
                            </form>
                        <?php } else { ?>
                            <form method='post' action='../controllers/favouritesController.php?action=delete'>
                                <input type='hidden' name='listingId' value='<?= htmlspecialchars($listing['id']) ?>'>
                                <button type='submit' class="iconBtn inFavs">❤</button>
                            </form>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>


        <?php } ?>

    </div>
</div>



