

<div class="messageFormPage">


    <div class="messageCard">

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

        <div class="msgActions">
            <a class="msgBtn" href="../controllers/messagesController.php?action=send&listingId=<?=htmlspecialchars($messageDetails['listingId'])?>">Odpowiedz</a>
            <a class="cancelBtn" href="../controllers/messagesController.php">Wróć</a>
        </div>



    </div>

</div>

