<?php

require_once "DBInit.php";

class OceneDB
{

    public static function insert($costumer_id, $article_id, $rating)
    {
       
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO Ocene (costumer_id, article_id, rating)
            VALUES (:costumer_id, :article_id, :rating)");
        
        $statement->bindParam(":costumer_id", $costumer_id);
        $statement->bindParam(":article_id", $article_id);
        $statement->bindParam(":rating", $rating);
        $statement->execute();
    }

    public static function ocena_za_izdelek($article_id){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT rating FROM Ocene WHERE article_id = :article_id ");        
        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function ocena_uporabnika_za_izdelek($costumer_id, $article_id){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT rating FROM Ocene WHERE article_id = :article_id and costumer_id = :costumer_id ");        
        $statement->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $statement->bindParam(":costumer_id", $costumer_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
   
}