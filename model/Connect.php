<?php

namespace Model; 

// on se contente de déclarer la connexion à la base de données
abstract class Connect {
    const HOST ="localhost";
    const BD ="cinema";
    const USER ="root";
    const PASS ="";

    public static function seConnecter() {
        try{
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
            
        } catch(\PDOException $ex) {
            return $ex->getMessage();
        }
    }
    

}

