<?php

class Mage
{
    public static function init()
    {

        $front = new Core_Controller_Front();
        $front->init();
    }
    public static function getModel($className)
    {
        $class = str_replace("/", "_Model_", $className);
        $class = ucwords($class, "_");
        // echo $class;
        return new $class();
    }
    public static function getBlock($className)
    {
        $class = str_replace("/", "_Block_", $className);
        $class = ucwords($class, "_");


        return new $class();
    }
    public static function getBasedirectory()
    {

        // protected $_baseUri = "http://localhost/PHP/MVC/";
        // protected $_baseDir = 'C:\xampp\htdocs\PHP\MVC';

        return  "C:/xampp/htdocs/PHP/MVC/";
    }
    public static function getBaseUrl()
    {
        return "http://localhost/PHP/MVC/";
    }
}
