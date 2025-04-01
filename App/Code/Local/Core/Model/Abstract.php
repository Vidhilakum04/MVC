<?php
class Core_Model_Abstract
{
    protected $_resourceClassName; //Holds the name of the resource class (database interaction layer).
    protected $_collectionClassName = ''; //Stores the name of the collection class for retrieving multiple records.
    protected $_data = null; //An array that stores data related to the model (key-value pairs of column names and their values).
    public function init() {}
    public function __construct()
    {
        $this->init(); //which can be overridden in child classes for custom initialization.

    }
    public function getResource()
    {
        return new $this->_resourceClassName(); //The resource class is responsible for interacting with the database.
    }
    public function __get($name) //When we try to access a property dynamically ($user->name), this method is triggered.
    {
        //It checks if the requested property exists in $_data and returns it.
        // If the property does not exist, it returns an empty string.
        return  isset($this->_data[$name]) ? $this->_data[$name] : "";
    }
    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }
    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }
    public function getData()
    {
        return $this->_data;
    }
    public function __call($method, $args)
    {
        $get = substr($method, 0, 3);
        if ($get == "get" && strpos($method, " ") === false) {
            $value = substr($method, 3);
            $field = $this->camelToSnake($value);
            return isset($this->_data[$field]) ? $this->_data[$field] : '';
        } else if ($get == "set" && strpos($method, " ") === false) {
            $value = substr($method, 3);
            $field = $this->camelToSnake($value);
            $this->_data[$field] = $args[0];
            return $this;
        }
        throw new Exception('invalid method');
    }
    function camelToSnake($input)
    {

        $snakeCase = preg_replace_callback(
            '/[A-Z]/',
            function ($matches) {
                return '_' . strtolower($matches[0]);
            },
            $input
        );

        return ltrim($snakeCase, '_');
    }
    public function load($value, $field = null)
    {
        $this->_data = $this->getResource()->load($value, $field); //Loads data from the database using getResource()->load()
        $this->_afterLoad();
        return $this;
    }
    protected function _afterLoad() {}
    public function getCollection()
    {
        $collection = new $this->_collectionClassName();
        $collection->setResource($this->getResource())
            ->setModel($this)
            ->select();

        return $collection;
    } //Creates a collection object to retrieve multiple records
    public function save()
    {
        $this->_beforeSave();
        $this->getResource()->save($this);
        $this->_afterSave();

        return $this;
    }
    protected function _beforeSave()
    {
        return $this;
    }
    protected function _afterSave()
    {
        return $this;
    }
    public function delete()
    {
        $this->getResource()->delete($this);

        return $this;
    }
}
