<?php

require_once "DBInit.php";

class ArticelDB
{

    public static function getAll()
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT article_id, article_name, article_price, article_description, article_status FROM Artikel");
        $statement->execute();
        #var_dump($statement->fetchAll());

        return $statement->fetchAll();
    }

    public static function getArticlesByStatus($status)
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Artikel WHERE article_status = :status ");
        $statement->bindParam(":status", $status, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get($id)
    {

        $db = DBInit::getInstance();


        $statement = $db->prepare("SELECT * FROM Artikel
            WHERE article_id  = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $book = $statement->fetch();

        if ($book != null) {
            return $book;
        } else {
            throw new InvalidArgumentException("No record with id $id");
        }
    }

    public static function insert($article_name, $article_price, $article_description, $article_status)
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO Artikel (article_name, article_price, article_description, article_status)
            VALUES (:article_name, :article_price, :article_description, :article_status)");
        #$statement->bindParam(":article_id", $article_id);
        $statement->bindParam(":article_name", $article_name);
        $statement->bindParam(":article_price", $article_price);
        $statement->bindParam(":article_description", $article_description);
        $statement->bindParam(":article_status", $article_status);
        $statement->execute();
    }

    public static function update($article_id, $article_name, $article_price, $article_description, $article_status)
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Artikel SET article_name = :article_name, article_price = :article_price,
        article_description = :article_description, article_status = :article_status WHERE article_id = :article_id");
        $statement->bindParam(":article_id", $article_id);
        $statement->bindParam(":article_name", $article_name);
        $statement->bindParam(":article_price", $article_price);
        $statement->bindParam(":article_description", $article_description);
        $statement->bindParam(":article_status", $article_status);
        $statement->execute();
    }

    public static function delete($id)
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM Artikel WHERE article_id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }


}
