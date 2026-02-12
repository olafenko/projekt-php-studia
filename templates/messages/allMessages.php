<div class="messagesPage">

    <h2>Wiadomości (<?= $unreadMessages ?>)</h2>

    <?php if (empty($allMessages)) { ?>
        <p>Brak wiadomości</p>
    <?php } else { ?>

        <div class="messagesList">

            <div class="messagesHeader">
                <span>Ogłoszenie</span>
                <span>Od</span>
                <span>Data</span>
            </div>
            <?php foreach ($allMessages as $msg) { ?>

                <a class="messageRow" href="../controllers/messagesController.php?action=details&messageId=<?= htmlspecialchars($msg['id']) ?>">
                    <?php if (!$msg['isRead']) { ?>
                        <p class="msgTitle unread"><?= htmlspecialchars($msg['listingTitle']) ?></p>
                    <?php } else { ?>
                        <p class="msgTitle"><?= htmlspecialchars($msg['listingTitle']) ?></p>
                    <?php } ?>
                    <p class="msgSender"><?= htmlspecialchars($msg['senderName']) ?></p>
                    <div class="msgDate">
                        <?= htmlspecialchars($msg['createdAt']) ?>
                    </div>
                </a>

            <?php } ?>
        </div>

    <?php } ?>
</div>
