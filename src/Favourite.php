<?php


class Favourite {


    private PDO $pdo;

    public function __construct(PDO $pdo)
    {

        $this->pdo = $pdo;

    }

    //dodaje do ulubionych
    function addFavourite($userId, $listingId)
    {

        $sql = "INSERT INTO favourites (userId,listingId) VALUES(:userId,:listingId)";

        $statement = $this->pdo->prepare($sql);

        return $statement->execute([
            ":userId" => $userId,
            ":listingId" => $listingId
        ]);

    }

    //zwraca ulubione konkretnego użytkownika
    function getFavourites($userId){

        $sql = "SELECT
        l.id AS listingId,
        l.title,
        l.price,
        l.photoUrl,
        l.location,
        u.username
        FROM favourites f 
        JOIN listings l ON f.listingId=l.id
        JOIN users u ON l.authorId=u.id
        WHERE  f.userId=:userId AND l.isActive = 1";


        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":userId" =>$userId
        ]);

        return $statement->fetchAll();


    }

    //usuwa ogłoszenie z ulubionych
    function removeFavourite($listingId,$userId){

        $sql = "DELETE FROM favourites WHERE listingId=:listingId AND userId=:userId";
        $statement = $this->pdo->prepare($sql);

        return  $statement->execute([
           ":listingId" =>$listingId,
            ":userId" => $userId
        ]);

    }

    //sprawdza czy ogloszenie jest w ulubionych danego uzytkownika
    function isFavourite($listingId,$userId) {

        $sql = "SELECT COUNT(*) FROM favourites WHERE userId=:userId AND listingId=:listingId";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":userId" => $userId,
            ":listingId" => $listingId
        ]);

        return $statement->fetchColumn() > 0;



    }





}
