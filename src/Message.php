<?php

//klasa odpowiedzialna za wykonywane operacji na wiadomosciach w bazie danych
class Message {

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    //funkcja odpowiedzialna za wysyłanie wiadomosci
    function sendMessage($senderId,$receiverId,$listingId,$content){

        $sql = "INSERT INTO messages (senderId,receiverId,listingId,messageContent) VALUES (:senderId,:receiverId,:listingId,:content)";

        $statement = $this->pdo->prepare($sql);

        return $statement->execute([
           ":senderId" => $senderId,
           ":receiverId" => $receiverId,
           ":listingId" => $listingId,
           ":content" => $content
        ]);
    }

    //wyswietla wiadomosci danego użytkowanika
    function showUserMessages($userId) {

        $sql = "SELECT m.id, m.createdAt, m.isRead,
                u.username as senderName,
                l.title as listingTitle
                FROM messages m 
                JOIN users u ON m.senderId = u.id
                JOIN listings l ON m.listingId = l.id
                WHERE receiverId=:userId
                ORDER BY m.createdAt DESC";

        $statement = $this->pdo->prepare($sql);

         $statement->execute([
            ":userId" => $userId,
        ]);

         return $statement->fetchAll();
    }

    //wyswietla szczegóły wiadomosci i sprawdza czy nalezy ona do wlasciwego uzytkownika
    function showMessageDetails($messageId,$userId) {

        $sql = "SELECT m.*,
                u.username as senderName,
                l.title as listingTitle,
                l.id as listingId
                FROM messages m 
                JOIN users u ON m.senderId = u.id
                JOIN listings l ON m.listingId = l.id
                WHERE m.id=:messageId
                AND (m.receiverId=:userId OR m.senderId=:userId)";
        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":messageId" => $messageId,
            ":userId" => $userId
        ]);

        return $statement->fetch();

    }

    //oznacza wiadomosc jako przeczytana
    function markAsRead($messageId, $userId){

        $sql = "UPDATE messages SET isRead=1 WHERE id=:messageId AND receiverId=:userId";

        $statement = $this->pdo->prepare($sql);

        return $statement->execute([
           ":messageId" => $messageId,
           ":userId" => $userId
        ]);
    }

    //liczy ilosc nie przeczytanych wiadomosci dla danego uzytkownika
    function countUnRead($userId) {
        $sql = "SELECT COUNT(*) FROM messages WHERE isRead=0 AND receiverId=:userId";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":userId" => $userId
        ]);

        return $statement->fetchColumn();
    }











}