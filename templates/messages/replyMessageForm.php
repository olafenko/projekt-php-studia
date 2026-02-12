<div class="replyMessageForm">

        <div class="oldMessageCard">
            <h2>Wiadomość</h2>

            <div class="msgMeta">
                <p><strong>Od: <?= htmlspecialchars($messageDetails['senderName'])?></strong></p>
                <p><strong>Ogłoszenie: <?= htmlspecialchars($messageDetails['listingTitle'])?></strong></p>
                <p><strong>Data: <?= htmlspecialchars($messageDetails['createdAt'])?></strong></p>

            </div>
            <p><strong>Treść:</strong></p>
            <div class="msgContent">
                <?= htmlspecialchars($messageDetails['messageContent'])?>
            </div>

        </div>

    <div class="messageCard">
        <h2>Odpowiedz</h2>

        <div class="msgMeta">
            <p><strong>Ogłoszenie: </strong> <?= htmlspecialchars($messageDetails['listingTitle'])?></p>
            <p><strong>Do: </strong> <?= htmlspecialchars($messageDetails['senderName'])?></p>
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
                <a class="cancelBtn" href="../controllers/listingsController.php?action=details&listingId=<?= htmlspecialchars($messageDetails['listingId'])?>">Anuluj</a>
            </div>
        </form>


    </div>
</div>
