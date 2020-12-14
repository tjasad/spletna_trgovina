<?php

require_once "DBInit.php";

class OrderDB
{

    public static function getAll()
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT order_id, costumer_id, total_price , order_status FROM Naročilo");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getOrdersByStatus($status)
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Naročilo WHERE order_status = :status ");
        $statement->bindParam(":status", $status, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get($id)
    {

        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Naročilo
            WHERE order_id  = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $book = $statement->fetch();

        if ($book != null) {
            return $book;
        } else {
            throw new InvalidArgumentException("No record with id $id");
        }
    }

    public static function get_all_articles_from_order($orderID)
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT a.article_id, a.article_name, a.article_price, a.article_description, a.article_status
            FROM Naročilo n, Kolicina k, Artikel a
            WHERE a.article_id = k.article_id AND k.order_id = n.order_id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $book = $statement->fetch();

        if ($book != null) {
            return $book;
        } else {
            throw new InvalidArgumentException("No record with id $id");
        }

    }

    public static function insert($order_id, $costumer_id, $total_price, $order_status)
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO Naročilo (order_id, costumer_id, total_price, order_status)
            VALUES (:order_id, :costumer_id, :total_price, :order_status)");
        $statement->bindParam(":order_id", $order_id);
        $statement->bindParam(":costumer_id", $costumer_id);
        $statement->bindParam(":total_price", $total_price);
        $statement->bindParam(":order_status", $order_status);
        $statement->execute();

    }

    public static function update($order_id, $costumer_id, $total_price, $order_status)
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Naročio SET costumer_id = :costumer_id, total_price = :total_price,
        order_status = :order_status WHERE order_id = :order_id");
        $statement->bindParam(":order_id", $order_id);
        $statement->bindParam(":costumer_id", $costumer_id);
        $statement->bindParam(":total_price", $total_price);
        $statement->bindParam(":order_status", $order_status);
        $statement->execute();
    }

    public static function delete($id)
    {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM Naročilo WHERE order_id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }


}
