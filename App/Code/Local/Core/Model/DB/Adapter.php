<?php
class Core_Model_DB_Adapter
{
    public $connect = null;
    protected $_config = [

        "hostname" => "localhost",
        "dbname" => "catalog",
        "username" => "root",
        "password" => "",
        "port" => "3307"

    ];
    public function connect()
    {
        if ($this->connect == null) {
            $this->connect = mysqli_connect(
                $this->_config["hostname"],
                $this->_config["username"],
                $this->_config["password"],
                $this->_config["dbname"],
                $this->_config["port"]
            );
        }
        return $this->connect;
    }

    public function fetchAll($query)
    {
        $result = mysqli_query($this->connect(), $query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function fetchRow($query)
    {
        $result = mysqli_query($this->connect(), $query);
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
    }
    public function insert($query)
    {
        $result = mysqli_query($this->connect(), $query);
        while ($result) {
            return mysqli_insert_id($this->connect());
        }
        return false;
    }
    public function query($query): bool|mysqli_result
    {
        $result = mysqli_query($this->connect(), $query);
        return $result;
    }
    // public function delete($query)
    // {
    //     $result = mysqli_query($this->connect(), $query);
    //     return $result;
    // }
}
