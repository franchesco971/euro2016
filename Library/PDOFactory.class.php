<?php
    namespace Library;
    
    class PDOFactory
    {
        public static function getMysqlConnexion()
        {
            $db = new \PDO('mysql:host=localhost;dbname=euro2016', 'root', '');
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
            return $db;
        }
    }
?>