

<div class="userProfilePage">

    <form class="profileCard" method="post">
        <h2>Edytuj profil</h2>

        <div class="authErrors">
            <?php
            foreach ($errors as $error) {
                echo "<p>" . htmlspecialchars($error) . "</p><br>";
            }
            ?>
        </div>
        <div class="editProfileInput">
            <label>Nazwa użytkownika: </label>
            <input type="text" name="username" value="<?= htmlspecialchars($userDetails['username'])?>" required>
        </div>
        <div class="editProfileInput">
            <label>Email: </label>
            <input type="email" name="email" value="<?= htmlspecialchars($userDetails['email'])?>"  required>
        </div>
        <div class="editProfileInput">
            <label>Numer telefonu: </label>
            <input type="text" name="phoneNumber" maxlength="9" minlength="9" value=" <?= htmlspecialchars($userDetails['phoneNumber'])?>">
        </div>
        <div class="editProfileInput">
            <label>Awatar URL: </label>
            <input type="text" name="avatarUrl" value="<?= htmlspecialchars($userDetails['avatarUrl'])?>"  >
        </div>

        <div class="formActions">
            <input class="saveBtn" type="submit" value="Zapisz">
            <a class="cancelBtn" href="../controllers/profileController.php">Anuluj</a>
        </div>
    </form>

</div>


