<?php

class Mage
{
    public static $registry = [];
    public static function init()
    {

        $front = new Core_Controller_Front();
        $front->init();
    }
    public static function getModel($className)
    {
        $class = str_replace("/", "_Model_", $className);
        $class = ucwords($class, "_");
        return new $class();
    }
    public static function getSingleton($className)
    {
        $class = str_replace("/", "_Model_", $className);
        $class = ucwords($class, "_");
        if (isset(self::$registry[$class])) {
            return self::$registry[$class];
        } else {
            return self::$registry[$class] = new $class;
        }
    }
    public static function getBlock($className)
    {
        $class = str_replace("/", "_Block_", $className);
        $class = ucwords($class, "_");


        return new $class();
    }
    public static function getBasedirectory()
    {
        return  "C:/xampp/htdocs/PHP/E-commerce/";
    }
    public static function getBaseUrl()
    {
        return "http://localhost/PHP/E-commerce/";
    }
    public static function getBlockSingleton($className)
    {
        $class = str_replace("/", "_Block_", $className);
        $class = ucwords($class, "_");
        if (isset(self::$registry[$class])) {
            return self::$registry[$class];
        } else {
            return self::$registry[$class] = new $class;
        }
    }

    public static function log($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
