<div class="authContainer">

    <div class="formErrors">

        <?php
        foreach ($errors as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p><br>";
        }
        ?>
    </div>

    <div class="authCard">
        <h1>Logowanie</h1>
        <form method="post" action="authController.php?action=login">


            <div class="authInput">
                <label>Nazwa użytkownika: </label>
                <input type="text" name="username" required>
            </div>

            <div class="authInput">
                <label>Hasło: </label>
                <input type="password" name="password" required>
            </div>
            <button class="authBtn" type="submit">Zaloguj się</button>

        </form>


    </div>


</div>


