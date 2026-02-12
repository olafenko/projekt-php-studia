<?php

//jezeli przychodzi formularz post to obsługuje go i przekierowuje odpowiednio po udanej akcji
if (isPost()) {

    if (isset($_POST['username']) && isset($_POST['password'])) {

        $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");

        fieldEmptyCheck($username, $errors, "Nazwa użytkownika");
        fieldEmptyCheck($password, $errors, "Hasło");

        if (empty($errors) && $userData = $user->findByUsername($username)) {


            if (password_verify($password, $userData['password'])) {

                $_SESSION['userId'] = $userData['id'];

                header("Location: ../index.php");
                exit;
            } else {
                $errors[] = "Niepoprawny login lub hasło.";
            }


        } else {
            $errors[] = "Niepoprawny login lub hasło.";
        }


    }

}
//jesli nie przychodzi POST to ustawia odpowiedni tytul strony i laduje odpowiedni widok
$pageTitle = "Logowanie";
$view = __DIR__ . "/../../templates/auth/login.php";

require __DIR__ . "/../../templates/layout.php";
