<?php


class Category {

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //funckcja zwracajaca kategorie
    function getAllCategories()
    {

        $sql = "SELECT * FROM categories ORDER BY name ASC";

        $statement = $this->pdo->query($sql);

        return $statement->fetchAll();

    }

    //sprawdza czy kategoria istnieje po id
    function existsById($id){
        $sql = "SELECT COUNT(*) FROM categories WHERE id=:id";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":id" =>$id
        ]);

        return $statement->fetchColumn() > 0;
    }

    //szuka kategorie po id i zwraca jej rekord
    function getCategoryById($id){

        $sql = "SELECT * FROM categories WHERE id=:id";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ":id" =>$id
        ]);
        return $statement->fetch();

    }


}

