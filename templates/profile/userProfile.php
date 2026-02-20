<?php
//sprawdza czy uzytkownik zalogowany, jak tak to moze dokonywac akcji na swoim profilu
$isUserLogged = isset($_SESSION['userId']);
?>

<div class="userProfilePage">

    <div class="profileCard">
        <div class="profileCard-avatar">
            <img src="<?= htmlspecialchars($userDetails['avatarUrl']) ?: '/SerwisOgloszeniowy/public/no-image.jpg'?>">
        </div>
        <h2><?= htmlspecialchars($userDetails['username'])?></h2>
        <div class="profileMetaData">
            <p>Email: <?= htmlspecialchars($userDetails['email'])?></p>
            <p>Nr tel.: <?= htmlspecialchars($userDetails['phoneNumber'])?></p>
            <p>Konto założone: <?= htmlspecialchars($userDetails['createdAt'])?></p>

        </div>
<!--        //todo, jezeli uzytkownik wyswietla swoj profil to ma dostepne akcje na nim-->
        <?php if($isUserLogged && $_SESSION['userId'] === $userId) {?>
        <div class="profileActions">
            <a class="detailsBtn" href="../controllers/profileController.php?action=edit">Edytuj profil</a>
            <a class="passwordBtn" href="../controllers/profileController.php?action=passwordChange">Zmień hasło</a>

                <form method="post" action="../controllers/profileController.php?action=delete">
                    <button class="deleteBtn">Dezaktywuj konto ❌</button>
                </form>
        </div>
        <?php }?>

    </div>



</div>



