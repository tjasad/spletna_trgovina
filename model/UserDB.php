<?php

require_once "DBInit.php";

class UserDB {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT name, surname, street, house_number, post, post_number, email, role FROM Uporabnik");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getUsersByRole($role) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Uporabnik WHERE role = :role ");
        $statement->bindParam(":role", $role, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get($id) {

        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Uporabnik
            WHERE costumer_id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $book = $statement->fetch();

        if ($book != null) {
            return $book;
        } else {
            throw new InvalidArgumentException("No record with id $id");
        }
    }

    public static function insert($costumer_id,$name, $surname, $street, $house_number, $post, $post_number, $email,$password,$role) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO Uporabnik (costumer_id, name, surname, street, house_number,post,post_number,email,password,role)
            VALUES (:costumer_id, :name, :surname, :street, :house_number, :post, :post_number, :email, :password, :role)");
        $statement->bindParam(":costumer_id", $costumer_id);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":surname", $surname);
        $statement->bindParam(":street", $street);
        $statement->bindParam(":house_number", $house_number);
        $statement->bindParam(":post", $post);
        $statement->bindParam(":post_number", $post_number);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":role", $role);
        $statement->execute();
    }

    public static function update($costumer_id,$name, $surname, $street, $house_number, $post, $post_number, $email,$password,$role) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE Uporabnik SET name = :name, surname = :surname, street = :street,
        house_number = :house_number, post = :post, post_number = :post_number, email = :email, password = :password, role = :role WHERE costumer_id = :costumer_id");
        $statement->bindParam(":costumer_id", $costumer_id);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":surname", $surname);
        $statement->bindParam(":street", $street);
        $statement->bindParam(":house_number", $house_number);
        $statement->bindParam(":post", $post);
        $statement->bindParam(":post_number", $post_number);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":role", $role);
        $statement->execute();
    }

    public static function delete($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM Uporabnik WHERE costumer_id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }      
}