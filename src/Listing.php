<?php

//klasa odpowiedzialna za wykonywanie operacji na ogłoszeniach w bazie danych
class Listing {

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //funkcja zwracająca wszystkie ogłoszenia domyslnie posortowane od najnowszych
    function getAllListings()
    {
        $sql = "SELECT l.id, l.title, l.photoUrl, l.price, l.createdAt, l.location,l.authorId,
                c.name AS category, u.username AS author
                FROM listings l
                JOIN categories c ON l.categoryId = c.id
                JOIN users u ON l.authorId = u.id
                WHERE l.isActive = 1 ORDER BY l.createdAt DESC";

        $result = $this->pdo->query($sql);

        return $result->fetchAll();

    }

    //zwraca dane konkretnego ogłoszenia znalezionego po id
    function getListingById($id)
    {

        $sql = "SELECT l.id,l.title,l.photoUrl,l.price,l.createdAt,l.location,l.description,l.authorId,
                c.name AS category,u.username AS author
                FROM listings l
                JOIN categories c ON l.categoryId = c.id
                JOIN users u ON l.authorId = u.id
                WHERE l.isActive = 1 AND l.id=:id";
        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":id" => $id
        ]);

        return $statement->fetch();

    }

    //funkcja tworząca nowe ogłoszenie, zwraca true jezeli sie dodało
    function createListing($title, $description, $authorId, $categoryId, $location, $photoUrl = "", $price = 0)
    {
        $sql = "INSERT INTO listings(title, description, photoUrl, categoryId, authorId, price, location)
                VALUES (:title,:description,:photoUrl,:categoryId,:authorId,:price,:location)";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":title" => $title,
            ":description" => $description,
            ":photoUrl" => $photoUrl,
            ":categoryId" => $categoryId,
            ":authorId" => $authorId,
            ":price" => $price,
            ":location" => $location
        ]);

        return $statement->rowCount() >0;


    }

    //funkcja edytująca instniejące ogłoszenie
    function editListing($id, $title, $description, $categoryId, $location, $photoUrl = "", $price = 0)
    {
        $sql = "UPDATE listings SET title=:title,description=:description,photoUrl=:photoUrl,categoryId=:categoryId,price=:price,location=:location
                    WHERE id=:id AND isActive = 1";

        $statement = $this->pdo->prepare($sql);

        return $statement->execute([
            ":id" => $id,
            ":title" => $title,
            ":description" => $description,
            ":photoUrl" => $photoUrl,
            ":categoryId" => $categoryId,
            ":price" => $price,
            ":location" => $location
        ]);

    }

    //zwraca dane kotaktowe autora ogłoszenia
    function getListingAuhthorDetails($listingId){

        $sql = "SELECT u.email, u.phoneNumber, l.authorId FROM listings l
                 JOIN users u ON l.authorId = u.id
                 WHERE l.id=:listingId";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":listingId" => $listingId
        ]);

        return $statement->fetch();
    }

    function searchListings($search){

        $sql = "SELECT l.id, l.title, l.photoUrl, l.price, l.createdAt, l.location,l.authorId,
                c.name AS category, u.username AS author
                FROM listings l
                JOIN categories c ON l.categoryId = c.id
                JOIN users u ON l.authorId = u.id
                WHERE l.isActive = 1 AND  l.title LIKE :search
                ORDER BY l.createdAt DESC";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":search" => "%" . $search . "%"
        ]);

        return $statement->fetchAll();

    }

    //zwraca wszystkie ogłoszenia danego uzytkownika
    function getUserListings($id)
    {

        $sql = "SELECT * FROM listings WHERE authorId=:id";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":id" => $id
        ]);

        return $statement->fetchAll();

    }



    //funkcja zwracająca ogłoszenia z danej kategorii
    function getListingsByCategory($categoryId)
    {

        $sql = "SELECT * FROM listings WHERE categoryId=:categoryId AND isActive=1";
        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":categoryId" => $categoryId
        ]);

        return $statement->fetchAll();


    }

    // funkcja usuwająca ogłoszenie po id
    function deleteListing($id){

        $sql = "UPDATE listings SET isActive=0 WHERE id=:id";
        $statement = $this->pdo->prepare($sql);

        return $statement->execute([
            ":id" => $id
        ]);

    }

    //funkcja sprawdzająca czy uzytkownik jest wlascicielem ogloszenia, jak znaleziono pasujący rekord to zwraca true
    function isOwner($listingId,$userId){

        $sql = "SELECT COUNT(*) FROM listings WHERE id=:listingId AND authorId=:userId AND isActive = 1";
        $statement = $this->pdo->prepare($sql);

         $statement->execute([
           ":listingId" => $listingId,
           ":userId" => $userId
        ]);

         return $statement->fetchColumn() > 0;

    }
}