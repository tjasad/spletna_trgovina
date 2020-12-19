<?php

require_once("model/ArticelDB.php");
require_once("controller/seminarskaController.php");
require_once("ViewHelper.php");

class ArticlesRESTController {

    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(ArticelDB::get( $id));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }

    public static function index() {
        //$prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
        //        . $_SERVER["REQUEST_URI"];
        echo ViewHelper::renderJSON(ArticelDB::getAll());
    }
    
}