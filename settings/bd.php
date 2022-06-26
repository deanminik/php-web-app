<?php
// https://www.w3schools.com/php/php_mysql_connect.asp 


class BD
{
    public static $instance = null;
    public static function createInstance()
    {
        if (!isset(self::$instance)) { //There is a cannection? No ok do this 


            $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:host=localhost;dbname=application', 'root', '', $options);
            echo "connected";
        }
        return self::$instance;
    }
}
