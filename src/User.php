<?php

// klasa odpowiedzialna za operacje na użytkownikach w bazie danych
class User {

    //prywatne pole polaczenia z baza danych
    private PDO $pdo;

    //konstruktor przyjmujacy jako parametr obiekt PDO  w celu wykonywania poleceń sql
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //Rejestracja - funkcja służąca do tworzenia nowego usera
    // w przypadku powodzenia zwraca true
    public function createUser($username,$password,$email){

        $passwordHash = password_hash($password,PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username,password,email) VALUES (:username,:password,:email)";

        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            ":username" => $username,
            ":password" => $passwordHash,
            ":email" => $email
        ]);

    }

    //funkcja szukająca czy user istnieje po jego nazwie lub emailu zwraca true jezeli istnieje lub false jezeli nie
    //funkcja służy m.in. do logowania się, aby najpierw znalezc czy user istnieje a potem sprawdzic poprawność hasła
    function existsByUsername($username)
    {
            $sql = "SELECT COUNT(*) FROM users WHERE username=:username";
            $statement = $this->pdo->prepare($sql);


            $statement->execute([
               ":username" =>$username
            ]);

            return $statement->fetchColumn() > 0;

    }

    function existsByEmail($email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email=:email AND isActive=1";
        $statement = $this->pdo->prepare($sql);


        $statement->execute([
            ":email" => $email
        ]);

        return $statement->fetchColumn() > 0;

    }

    //szuka uzytkownika po nazwie i zwraca jego rekord
    function findByUsername($username){

        $sql = "SELECT id,username,email,password FROM users WHERE username=:username AND isActive=1";
        $statement = $this->pdo->prepare($sql);


        $statement->execute([
            ":username" =>$username
        ]);

        return $statement->fetch();
    }


    //szuka uzytkownika po id i zwraca jego dane lub null
    function findById($userId){

        $sql = "SELECT username,email,phoneNumber,createdAt,avatarUrl,password FROM users WHERE id=:userId AND isActive=1";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ":userId" =>$userId
        ]);

        return $statement->fetch();
    }

    //edytowanie danych
    function editUserData($userId,$username,$email,$phoneNumber,$avatarUrl){

        $sql = "UPDATE users SET username=:username, email=:email, phoneNumber=:phoneNumber, avatarUrl=:avatarUrl WHERE isActive = 1 AND id=:userId";

        $statement = $this->pdo->prepare($sql);

        return $statement->execute([
            ":userId" => $userId,
            ":username" => $username,
            ":email" => $email,
            ":phoneNumber" => $phoneNumber,
            ":avatarUrl" => $avatarUrl

        ]);

    }

    //zmiana hasla
    function editPassword($userId,$password){

        $passwordHash = password_hash($password,PASSWORD_BCRYPT);

        $sql = "UPDATE users SET password=:password WHERE isActive = 1 AND id=:userId";

        $statement = $this->pdo->prepare($sql);

        return $statement->execute([
            ":userId" => $userId,
            ":password" => $passwordHash,

        ]);

    }

    //funkcja deaktywująca konto uzytkownika
    function deactivateUser($userId)
    {
        $sql = "UPDATE users SET isActive = 0 WHERE id=:userId";

        $statement = $this->pdo->prepare($sql);

        return $statement->execute([
            ":userId" => $userId
        ]);

    }



}
