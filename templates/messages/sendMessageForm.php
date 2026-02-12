<div class="messageFormPage">

    <div class="messageCard">


        <h2>Nowa wiadomość</h2>

        <div class="msgMeta">
            <p><strong>Ogłoszenie: </strong> <?= htmlspecialchars($listingDetails['title'])?></p>
            <p><strong>Odbiorca: </strong> <?= htmlspecialchars($listingDetails['author'])?></p>
        </div>

        <div class="authErrors">
            <?php
            foreach ($errors as $error) {
                echo "<p>" . htmlspecialchars($error) . "</p><br>";
            }
            ?>
        </div>

        <form method="post">

            <p><strong>Nowa wiadomość:</strong></p>
            <textarea name="messageContent" placeholder="Napisz wiadomość..." maxlength="200" required autofocus></textarea>
            <div class="msgActions">
                <button class="detailsBtn" type="submit">Wyślij wiadomość</button>
                <a class="cancelBtn" href="../controllers/listingsController.php?action=details&listingId=<?= htmlspecialchars($listingDetails['id'])?>">Anuluj</a>
            </div>
        </form>


    </div>
</div>
