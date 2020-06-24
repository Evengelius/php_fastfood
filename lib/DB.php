<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22/12/2016
 * Time: 20:01
 */

class DB
{
    private static $instance = null;

    public static function getInstance()
    {
        if(!self::$instance) {
            try{
                self::$instance = new PDO(DSN, USER, PASSWORD);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$instance;
            }
            catch (Exception $erreur){
                die ('Erreur de connexion :'.$erreur->getMessage());
            }
        }
    }
}