<div class="authContainer">

    <div class="formErrors">

        <?php
        foreach ($errors as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p><br>";
        }
        ?>
    </div>
    <div class="authCard">
        <h1>Rejestracja</h1>
        <form method="post" action="authController.php?action=register">


            <div class="authInput">
                <label>Nazwa użytkownika: </label>
                <input type="text" name="username" required>
            </div>
            <div class="authInput">
                <label>Email: </label>
                <input type="email" name="email" required>
            </div>

            <div class="authInput">
                <label>Hasło: </label>
                <input type="password" name="password" required>
            </div>
            <button class="authBtn" type="submit">Zarejestruj się</button>

        </form>


    </div>


</div>


