<?php

//jezeli przychodzi formularz post to obsługuje go i przekierowuje odpowiednio po udanej akcji
if(isPost()){

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
        $username = filter_input(INPUT_POST,"username");
        $email = filter_input(INPUT_POST,"email");
        $password =filter_input(INPUT_POST,"password");

        validatePassword($password,$errors);
        validateEmail($email,$errors);
        validateUsername($username,$errors);

        if($user->existsByUsername($username)){
            $errors[] = "Nazwa użytkownika jest zajęta";
        }

        if($user->existsByEmail($email)){
            $errors[] = "Email jest zajęty";
        }

        if(empty($errors)){

            $user->createUser($username,$password,$email);

            header("Location:../controllers/authController.php");
            exit;
        }

    }

}

//jesli nie przychodzi POST to ustawia odpowiedni tytul strony i laduje odpowiedni widok
$pageTitle = "Logowanie";
$view = __DIR__ . "/../../templates/auth/register.php";

require __DIR__ . "/../../templates/layout.php";

