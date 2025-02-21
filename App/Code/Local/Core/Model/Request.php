<?php
class Core_Model_Request
{
    protected $_moduleName;
    protected $_controlleName;
    protected $_actionName;
    protected $_baseUrl = "http://localhost/PHP/MVC/";
    protected $_baseDirectory = "C:/xampp/htdocs/php/mvc/";

    public function __construct()
    {
        $uri = $this->getRequestUri();
        // print_r($uri);
        $uri = array_filter(explode("/", $uri));
        $this->_moduleName = isset($uri[0]) ? $uri[0] : "cms";
        $this->_controlleName = isset($uri[1]) ? $uri[1] : "index";
        $this->_actionName = isset($uri[2]) ? $uri[2] : "index";
    }
    public function getModuleName()
    {
        return $this->_moduleName;
    }
    public function getControllerName()
    {
        return $this->_controlleName;
    }
    public function getActionName()
    {
        return $this->_actionName;
    }
    public static function getparam($field)
    {
        if (isset($_POST[$field])) {
            // print_r($_POST);
            return $_POST[$field];
        } else {
            return '';
        }
    }
    public static function getQuery($field)
    {
        if (isset($_GET[$field])) {
            return $_GET[$field];
        } else {
            return '';
        }
    }
    public function getRequestUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_replace("/PHP/MVC/", "", $uri);
        // print_r($uri);
        return $uri;
    }
    public function getParams()
    {
        return $_POST;
    }
}
