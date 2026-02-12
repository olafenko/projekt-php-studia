


<div class="userProfilePage">

    <form class="profileCard" method="post">
        <h2>Zmiana hasła</h2>

        <div class="authErrors">
            <?php
            foreach ($errors as $error) {
                echo "<p>" . htmlspecialchars($error) . "</p><br>";
            }
            ?>
        </div>
        <div class="editProfileInput">
            <label>Stare hasło: </label>
            <input type="password" name="oldPassword"  required>
        </div>
        <div class="editProfileInput">
            <label>Nowe hasło: </label>
            <input type="password" name="newPassword"  required>
        </div>
        <div class="editProfileInput">
            <label>Powtórz nowe hasło: </label>
            <input type="password" name="newPasswordRepeat">
        </div>

        <div class="formActions">
            <input class="saveBtn" type="submit" value="Zmień hasło">
            <a class="cancelBtn" href="../controllers/profileController.php">Anuluj</a>
        </div>
    </form>

</div>


