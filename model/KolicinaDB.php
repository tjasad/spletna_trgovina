<?php

require_once "DBInit.php";

class KolicinaDB
{

    public static function insert($order_id, $article_id, $overal)
    {
        # var_dump($id_kolicina);
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO Kolicina (order_id, article_id, overal)
            VALUES (:order_id, :article_id, :overal)");
        #$statement->bindParam(":id_kolicina", $id_kolicina);
        $statement->bindParam(":order_id", $order_id);
        $statement->bindParam(":article_id", $article_id);
        $statement->bindParam(":overal", $overal);
        $statement->execute();
    }

    public static function getAll($id)
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Kolicina WHERE order_id = :id ");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}