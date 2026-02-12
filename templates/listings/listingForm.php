<?php
//sprawdza czy formularz jest edytującym istniejące ogłoszenie, jezeli nie to jest do tworzenia nowego
//jezeli jest formularzem edytowania to wypełnia pola wczesniejszymi danymi
$isEditing = !empty($listingDetails);

?>

<div class="listingFormPage">

    <div class="formCard">

        <h2><?= $isEditing ? "Edytowanie ogłoszenia" : "Dodawanie ogłoszenia" ?></h2>

        <div class="formErrors">

            <?php
            foreach ($errors as $error) {
                echo "<p>" . htmlspecialchars($error) . "</p><br>";
            }
            ?>
        </div>
        <!--//form wysyła request  do kontrollera, z parametrem w zaleznosci czy ogłoszenie jest edytowane czy tworzone nowe-->
        <form method="post" action="../controllers/listingsController.php?action=<?= $isEditing ? 'edit' : 'add' ?>">

            <div class="formInput">
                <label>Tytuł</label>
                <!--            jesli jest edytowane to wypełnia formularz starymi danymi-->
                <input type="text" name="title"
                       value="<?= $isEditing ? htmlspecialchars($listingDetails['title']) : '' ?>" required>
            </div>
            <div class="formInput">
                <label>Kategoria</label>
                <select name='categoryId' required>
                    <?php
                    foreach ($categories as $c) {
//                        w trybie edycji sprawdza ostatnią kategorie przy niej ustawia parametr selected
                        $isSelected = ($isEditing && $c['id'] === $listingDetails['categoryId']) ? "selected" : "";
                        echo "<option value='{$c['id']}' $isSelected>" . htmlspecialchars($c['name']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="formInput">
                <label>Lokalizacja</label>
                <input type="text" name="location"
                       value="<?= $isEditing ? htmlspecialchars($listingDetails['location']) : '' ?>" required>
            </div>

            <div class="formInput">
                <label>Cena</label>
                <input type="number" name="price" step="0.01"
                       value="<?= $isEditing ? htmlspecialchars($listingDetails['price']) : '' ?>">
            </div>

            <div class="formInput">
                <label>Zdjęcie (URL)</label>
                <input type="text" name="photoUrl"
                       value="<?= $isEditing ? htmlspecialchars($listingDetails['photoUrl']) : '' ?>">
            </div>

            <div class="formInput">
                <label>Opis</label>
                <textarea
                        name="description"><?= $isEditing ? htmlspecialchars($listingDetails['description']) : '' ?></textarea>
            </div>

            <?php
            //jezeli tryb edytowania to przekazuje ukryte pole z id zeby handler wiedzial ktore ogloszenie jest edytowane
            if ($isEditing) {
                echo "<input type='hidden' name='listingId' value='{$listingDetails['id']}'>";
            }

            ?>

            <div class="formActions">
                <input class="saveBtn" type="submit" value="Zapisz">
                <a class="cancelBtn" href="../controllers/listingsController.php">Anuluj</a>
            </div>

        </form>

    </div>


</div>







