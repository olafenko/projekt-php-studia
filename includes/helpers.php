

<!--tu przechowuje funkcje pomocnicze-->
<?php
function isPost (){

    return $_SERVER["REQUEST_METHOD"] === "POST";

}

function isGet (){

    return $_SERVER["REQUEST_METHOD"] === "GET";

}

//waldacja pustych pól
function fieldEmptyCheck($value,&$errors, $fieldName = ""){

    if(empty($value)){
        $errors[] = "Pole {$fieldName} nie może być puste.";
        return false;
    }

    return true;

}

//funkcja sprawdzajaca czy uzytkownik jest zalogowany, jak nie to przekierowuje na logowanie
function requireLogin(){

    if(!isset($_SESSION['userId'])){
        header('Location: http://localhost/SerwisOgloszeniowy/controllers/authController.php?action=login');
        exit;
    }

}


// funkcja do walidowania hasła przy rejestracji
function validatePassword($value,&$errors){

    $minLength = 8;
    $maxLength = 20;

    if(empty($value)){
        $errors[] = "Hasło nie może być puste.";
        return false;
    } else if (strlen(trim($value)) < $minLength) {
        $errors[] = "Hasło musi mieć minimum {$minLength} znaków.";
        return false;
    } else if (strlen(trim($value)) > $maxLength) {
        $errors[] = "Hasło musi mieć maksymalnie {$maxLength} znaków.";
        return false;
    }

    return true;


}

// funkcja do walidowania emaila przy rejestracji
function validateEmail($value,&$errors){

    if(empty($value)){
        $errors[] = "Email nie może być pusty.";
        return false;
    } else if (!filter_var($value,FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email musi być w formacie email@cos.com";
        return false;
    }

    return true;

}

//funkcja do walidowania nazwy uzytkownika przy rejestracji
function validateUsername($value,&$errors){

    $minLength = 5;
    $maxLength = 20;

    if(empty($value)){
        $errors[] = "Nazwa nie może być pusta.";
        return false;
    } else if (strlen(trim($value)) < $minLength) {
        $errors[] = "Nazwa musi mieć minimum {$minLength} znaków.";
        return false;
    } else if (strlen(trim($value)) > $maxLength) {
        $errors[] = "Nazwa musi mieć maksymalnie {$maxLength} znaków.";
        return false;
    } else if (!preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{4,19}$/',$value)){
        $errors[] = "Nazwa nie może zawierać znaków specjalnych.";
        return false;
    }

    return true;


}

//waliduje tytul w formularzu dodawania/edytowania ogloszenia
function validateTitle($value,&$errors){

    $minLength = 3;
    $maxLength = 100;

    if(empty($value)){
        $errors[] = "Tytuł nie może być pusty.";
        return false;
    } else if (strlen(trim($value)) < $minLength) {
        $errors[] = "Tytuł musi mieć minimum {$minLength} znaków.";
        return false;
    } else if (strlen(trim($value)) > $maxLength) {
        $errors[] = "Tytuł musi mieć maksymalnie {$maxLength} znaków.";
        return false;
    }

    return true;

}

//waliduje cene w formularzu dodawania/edytowania ogloszenia
function validatePrice($value,&$errors){

    if(empty($value)){
        $errors[] = "Cena nie może być pusta.";
        return false;
    } else if (!filter_var($value,FILTER_VALIDATE_FLOAT)) {
        $errors[] = "Cena musi być liczbą.";
        return false;
    } else if ($value < 0) {
        $errors[] = "Cena nie może być mniejsza niż 0.";
        return false;
    }

    return true;

}

function validateDescription($value, &$errors){

    if(strlen($value) > 200){
        $errors[] = "Maksymalna długość opisu wynosi 200 znaków.";
        return false;
    }

    return true;
}

function validateLocation($value, &$errors){

    $minLength = 2;
    $maxLength = 60;

    if(empty($value)){
        $errors[] = "Lokalizacja nie może być pusta.";
        return false;
    } else if (strlen(trim($value)) < $minLength) {
        $errors[] = "Lokalizacja musi mieć minimum {$minLength} znaków.";
        return false;
    } else if (strlen(trim($value)) > $maxLength) {
        $errors[] = "Lokalizacja musi mieć maksymalnie {$maxLength} znaków.";
        return false;
    }

    return true;
}

function validateCategory($value, &$errors){

    if(!filter_var($value,FILTER_VALIDATE_INT)){
        $errors[] = "Nieprawidłowa kategoria.";
        return false;
    }

    return true;
}

//waliduje zawartość wiadomosci
function validateMsgContent($value, &$errors){

    if(strlen($value) <= 0){
        $errors[] = "Wiadomość nie może być pusta";
        return false;
    } else if (strlen($value) > 200) {
        $errors[] = "Maksymalna długość wiadomości wynosi 200 znaków.";
        return false;
    }

    return true;

}




