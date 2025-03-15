<?php
class Core_Model_Request
{
    protected $_moduleName;
    protected $_controlleName;
    protected $_actionName;
    protected $_baseUrl = "http://localhost/PHP/E-commerce/";
    protected $_baseDirectory = "C:/xampp/htdocs/PHP/E-commerce/";

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
            return $_POST[$field];
        } else {
            return '';
        }
        // If the parameter exists in $_POST, it returns its value.
        // If the parameter is not found, it returns an empty string ("").
    }
    public static function getQuery($field = NULL)
    {
        if (is_null($field)) {
            return $_GET;
        } else {
            if (isset($_GET[$field])) {
                return $_GET[$field];
            } else {
                return '';
            }
        }
    }
    public function getRequestUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_replace("/PHP/E-commerce/", "", $uri);
        return $uri;
        //Retrieves the full request URI from $_SERVER['REQUEST_URI'].
        // Removes the base path ("/PHP/E-commerce/") to get a clean URI.
    }
    public function getParams() //Returns all POST parameters
    {
        return $_POST; //Can be used when multiple form fields are submitted.
    }
    public function isAjax()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            //request is ajax
            return true;
        } else {
            return false;
        }
    }
    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        } else {
            return false;
        }
    }
    public function isGet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return true;
        } else {
            return false;
        }
    }
}
